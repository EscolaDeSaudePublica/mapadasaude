<?php
namespace Tiebreaker;

use MapasCulturais\App;

class Plugin extends \MapasCulturais\Plugin {
    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();
        $app->hook('template(opportunity.<<create|edit>>.tabs-content-tiebreaker):begin', function() use($app){
            $app->view->enqueueScript('app', 'tiebreaker', 'js/ng.tiebreaker.js',['entity.module.opportunity']);
            $app->view->jsObject['angularAppDependencies'][] = 'ng.tiebreaker';
            $this->part('form-tiebreaker');
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('desempate', 'Tiebreaker\Controllers\Desempate');
    }
}