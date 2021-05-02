<?php
namespace PDFReport;

use MapasCulturais\App;

class Plugin extends \MapasCulturais\Plugin {
    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();

        //
        $app->hook('template(opportunity.single.header-inscritos):end', function () use ($app) {
            $app->view->enqueueScript('app', 'pdfreport', 'js/pdfreport.js');
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
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('pdf', 'PDFReport\Controllers\Pdf');
    }
}