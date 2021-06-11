<?php
namespace PDFReport;

use MapasCulturais\App;
use MapasCulturais\Entities\OpportunityMeta;
use DateTime;

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
            $this->json(['message' => 'Sucesso'],200);
        });

        $app->hook('GET(opportunity.orderTiebreaker)', function() use ($app) {
            $params = $app->router()->getCurrentRoute()->getParams();
            $idOp = $params['args'][2];

            $dql = "SELECT om.id, om.key, om.value
            FROM MapasCulturais\Entities\OpportunityMeta om
            WHERE om.owner = {$idOp}
            AND om.key = 'tiebreaker' ORDER BY om.id asc";
            $query = $app->em->createQuery($dql);
            $tiebreaker = $query->getResult();
            $nameTiebreaker = [];
            foreach ($tiebreaker as $key => $tiebreakers) {
                $id = $tiebreakers['value'];
                $dql = "SELECT cm.value
                FROM \Saude\Entities\CategoryMeta cm
                WHERE cm.owner = {$id} AND cm.key = 'criterio_desempate' ORDER BY cm.id asc";
                $query = $app->em->createQuery($dql);
                $nameTie = $query->getResult();
                
                array_push($nameTiebreaker, ['id' => $tiebreakers['id'], 'name' => $nameTie[0]['value']]);
            }
            $this->json($nameTiebreaker);
        });

        $app->hook('POST(opportunity.deleteMetaOpportunity)', function() use ($app) {
              $app->disableAccessControl();
            $opMeta = $app->repo('OpportunityMeta')->find($this->postData['id']);

            $opMeta->delete();
            $this->save();
            $app->em->flush();
        });

        $app->hook('POST(agent.birthData)', function() use($app) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            $id = $this->postData['id'];
            $birth = $this->postData['birthDate'];
            $age = $this->postData['age'];
            $major = 0;
            if($this->postData['age'] > 60){
                $major = 1;
            }
            dump($major);
            // die;
            // $dql = "UPDATE MapasCulturais\Entities\Agent a 
            // SET a.major60 = {$age} , a.birthDate = '{$birth}' WHERE a.id = {$id}";
            $bri = $app->em->getConnection()->fetchAll("UPDATE agent SET birthDate = '{$birth}', major60 = {$major} , age = {$age} WHERE id = {$id}");
            dump($bri);
            // dump($dql);
            // die;
            // $query      = $app->em->createQuery($dql);
            // $upStatus   = $query->getResult();
            // dump($upStatus);
        });
       
        $app->hook('GET(opportunity.getCriteria)', function() use($app) {
            $params = $app->router()->getCurrentRoute()->getParams();
            dump($params);
            $idOp = $params['args'][2];
            $criteria = $app->repo('EvaluationMethodConfigurationMeta')->findBy([
                'owner' => $idOp
            ]);
            //dump($criteria);
            $cri = json_decode($criteria[0]->value);
            //dump($cri);
            foreach ($criteria as $key => $value) {
                //dump($criteria[$key]);
                if($criteria[$key]->key == 'moment') {
                    dump($value->value);
                }
            }
            //$this->json($criteria);
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('pdf', 'PDFReport\Controllers\Pdf');
    }
}