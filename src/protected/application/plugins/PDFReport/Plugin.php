<?php
namespace PDFReport;

use MapasCulturais\App;
use MapasCulturais\Entities\OpportunityMeta;

class Plugin extends \MapasCulturais\Plugin {
    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();

        
        $app->hook('template(opportunity.single.header-inscritos):end', function () use ($app) {

            //$app->view->enqueueScript('app', 'pdfreport', 'js/pdfreport.js');
            $app->view->enqueueScript('app', 'pdfreport', 'js/ng.pdfreport.js',['entity.module.opportunity']);
            $app->view->jsObject['angularAppDependencies'][] = 'ng.pdfreport';
            $entity = $this->controller->requestedEntity;
            $resource = false;
            //VERIFICANDO SE TEM A INDICAÇÃO DE RECURSO
            $isResource = array_key_exists('claimDisabled', $entity->metadata);
            //SE HOUVER O CAMPO FAZ O FOREACH
            if($isResource) {
                foreach ($entity->metadata as $key => $value) {
                    //SE O CAMPO EXISTIR E TIVER RECURSO HABILITADO
                    if($key == 'claimDisabled' && $value == 0) {
                        $resource = true;
                    }
                }
            }
            $this->part('reports/buttons-report',['resource' => $resource]);
        });

        $app->hook('GET(opportunity.getTiebreaker)', function() use ($app) {
            $dql =  "SELECT c.id, c.owner, c.value FROM \Saude\Entities\CategoryMeta c WHERE c.key = 'criterio_desempate' ORDER BY c.owner asc";
            $query = $app->em->createQuery($dql);
            $tiebreaker = $query->getResult();
            $this->json($tiebreaker);
        });

        $app->hook('POST(opportunity.createTiebreaker)', function() use ($app) {
            //dump($this->postData);
            $op = $app->repo('Opportunity')->find($this->postData['opportunity']);
            $opMeta = new OpportunityMeta;
            $opMeta->key = "tiebreaker";
            $opMeta->value = $this->postData['id'];
            $opMeta->owner = $op;
            $app->em->flush();
            $opMeta->save(true);
        });

        $app->hook('GET(opportunity.orderTiebreaker)', function() use ($app) {
            $params = $app->router()->getCurrentRoute()->getParams();
            $idOp = $params['args'][2];
            // $dql =  "SELECT om, cm 
            // FROM MapasCulturais\Entities\OpportunityMeta om
            // JOIN \Saude\Entities\CategoryMeta cm 
            // LEFT JOIN om.value = cm.owner where om.owner = {$idOp} and om.key = 'tiebreaker' and  ORDER BY om.id asc";

            $dql = "SELECT om.key, om.value
            FROM MapasCulturais\Entities\OpportunityMeta om
            WHERE om.owner = {$idOp}
            AND om.key = 'tiebreaker' ORDER BY om.id asc";
            $query = $app->em->createQuery($dql);
            $tiebreaker = $query->getResult();
            dump($tiebreaker);
            $nameTiebreaker = [];
            foreach ($tiebreaker as $key => $tiebreakers) {
                //dump($tiebreakers['value']);
                $id = $tiebreakers['value'];
                $dql = "SELECT cm.value
                FROM \Saude\Entities\CategoryMeta cm
                WHERE cm.owner = {$id} AND cm.key = 'criterio_desempate' ORDER BY cm.id asc";
                $query = $app->em->createQuery($dql);
                $nameTie = $query->getResult();
                //dump($nameTie[0]['value']);
                array_push($nameTiebreaker, $nameTie[0]['value']);
            }
            // dump($nameTiebreaker);
            // dump(json_encode($nameTiebreaker));
            $this->json($nameTiebreaker);
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('pdf', 'PDFReport\Controllers\Pdf');
    }
}