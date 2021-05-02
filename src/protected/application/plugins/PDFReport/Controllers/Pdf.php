<?php
namespace PDFReport\Controllers;
use \MapasCulturais\App;
use Dompdf\Dompdf;

class Pdf extends \MapasCulturais\Controller{

    function POST_gerarPdf() {
        $domPdf = new Dompdf(array('enable_remote' => true));
        // dump($this->postData);
        // dump($domPdf);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $app = App::i();
        if($this->postData['selectRel'] != 1) {
            
        }
        $regs       = "";
        $title      = "";
        $opp        = "";
        $template   = "";
        //NULO PARA CASOS DE NÃO TER RECURSO
        $claimDisabled = null;
        switch ($this->postData['selectRel']) {
            case 0:
                $_SESSION['error'] = "Ops! Você deve selecionar uma opção.";
                $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport'].'#/tab=inscritos'), 401);
                break;
            case 1:
                $regs = $this->oportunityRegistrationAproved($this->postData['idopportunityReport'], 'ALL');
                $title      = 'Relatório de inscritos na oportunidade';
                $template   = 'pdf/subscribers';
                break;
            case 2:
                //BUSCANDO TODOS OS REGISTROS
                $regs = $this->oportunityRegistrationAproved($this->postData['idopportunityReport'], 10);
                if(empty($regs['regs'])){
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                $verifyResource = $this->verifyResource($this->postData['idopportunityReport']);
                    
                //SE TIVER RECURSO, RECEBE O VALOR QUE ESTÁ NA TABELA
                if(isset($verifyResource[0])){
                    $claimDisabled = $verifyResource[0]->value;
                }
               
                $title      = 'Resultado Preliminar do Certame';
                $template   = 'pdf/preliminary';
                break;
            case 3:
                //ESSE CASE, VERIFICA SE OS RECURSOS E A OPORTUNIDADE
                $id = $this->postData['idopportunityReport'];
                //SELECT AOS RECURSOS
                $dql = "SELECT r
                FROM 
                Saude\Entities\Resources r
                WHERE r.opportunityId = {$id}";
                $query = $app->em->createQuery($dql);
                $resource = $query->getResult();
                $countPublish = 0;//INICIANDO VARIAVEL COM 0
                foreach ($resource as $key => $value) {
                    if($value->replyPublish == 1 && $value->opportunityId->publishedRegistrations == 1) {
                        $countPublish++;//SE ENTRAR INCREMENTA A VARIAVEL
                    }else{
                        $countPublish = 0;
                    }
                }
                //SE OS DOIS VALORES BATEREM, ENTÃO GERA O PDF
                //O PDF SOMENTE SERÁ GERADO NA EVENTUALIDADE DA AOPORTUNIDADE ESTÁ PUBLICADA E OS RECURSOS TBM ESTIVEREM PUBLICADOS
                if($countPublish == count($resource) && $countPublish > 0 && count($resource) > 0) {
                    $regs = $this->oportunityRegistrationAproved($this->postData['idopportunityReport'], 10);
                    
                    $title      = 'Resultado Definitivo do Certame';
                    $template   = 'pdf/definitive';

                }elseif($countPublish == count($resource) && $countPublish == 0 && count($resource) == 0){
                    //SE NÃO, VOLTA PARA A PÁGINA DA OPORTUNIDADE COM AVISO
                    //$app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                    $regs = $this->oportunityRegistrationAproved($this->postData['idopportunityReport'], 10);
                
                    if(empty($regs['regs'])) {
                        $_SESSION['error'] = "Ops! Você deve publicar a oportunidade para esse relatório";
                        $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport'].'#/tab=inscritos'), 401);
                    }
                    //VERIFICANDO SE TEM RECURSO
                    $verifyResource = $this->verifyResource($this->postData['idopportunityReport']);
                    
                    //SE TIVER RECURSO, RECEBE O VALOR QUE ESTÁ NA TABELA
                    if(isset($verifyResource[0])){
                        $claimDisabled = $verifyResource[0]->value;
                    }
                   
                    // dump(isset($regs['regs'][0]));
                    // dump($regs['regs']);
                    // dump($verifyResource);
                    //die;
                    //EM CASOS DE TER INSCRIÇÃO MAS NÃO TEM RECURSO OU ESTÁ DESABILITADO
                    if(isset($regs['regs'][0]) && empty($verifyResource) || $claimDisabled == 1 ){
                        $title      = 'Resultado Definitivo do Certame';
                        $template   = 'pdf/definitive';
                    }
                    else 
                    //CASO ESTEJA PUBLICADO E NÃO TEM RECURSO
                    // if($regs['regs'] > 0 && empty($verifyResource) ){
                    //     dump($verifyResource);
                    //     die;
                    //     $title      = 'Resultado Definitivo do Certame';
                    //     $template   = 'pdf/definitive';
                        
                    // }else
                    {
                        $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport'].'#/tab=inscritos'), 401);
                    }
                   
                }
                break;
            case 4:
                $regs = $this->oportunityRegistrationAproved($this->postData['idopportunityReport'], 10);
                if(empty($regs['regs'])){
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                $title      = 'Relatório de contato';
                $template   = 'pdf/contact';
                break;
            default:
                $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                break;
        }
        // dump(getType($regs));
        $app->view->jsObject['opp'] = $regs['opp'];
        $app->view->jsObject['subscribers'] = $regs['regs'];
        $app->view->jsObject['title'] = $title;
        $app->view->jsObject['claimDisabled'] = $claimDisabled;

        $content = $app->view->fetch($template);
        //$content = $app->render('pdf/layout', array('report' => $report)); 
        $domPdf->loadHtml($content);
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();
        // Output the generated PDF to Browser
        //$domPdf->stream();
        $domPdf->stream("dompdf_out.pdf", array("Attachment" => false));
        exit(0);
    }

    /**
     * Busca a oportunidade e todos os aprovados da inscrição 
     *
     * @param [integer] $idopportunity
     * @return void array
     */
    function oportunityRegistrationAproved($idopportunity, $status) 
    {
        $app = App::i();
        $opp = $app->repo('Opportunity')->find($idopportunity);
        
        if($status == 10) {
            $dql = "SELECT r
                    FROM 
                    MapasCulturais\Entities\Registration r
                    WHERE r.opportunity = {$idopportunity}
                    AND r.status = 10 ORDER BY r.consolidatedResult DESC";
            $query = $app->em->createQuery($dql);
            $regs = $query->getResult();
        }else{
            $regs = $app->repo('Registration')->findBy(
                [
                'opportunity' => $idopportunity
                ]
            );
        }
        
        return ['opp' => $opp, 'regs' => $regs];
    }

    function verifyResource($idOportunidade) {
        $app = App::i();
        $opp = $app->repo('OpportunityMeta')->findBy(['owner'=>$idOportunidade,'key'=>'claimDisabled']);
        return $opp;
    }

}