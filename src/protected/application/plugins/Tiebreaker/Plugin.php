<?php
namespace Tiebreaker;

use MapasCulturais\App;

class Plugin extends \MapasCulturais\Plugin {
    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();
        $app->hook('template(opportunity.<<create|edit>>.tabs-content-tiebreaker):begin', function(){
            $this->part('form-tiebreaker');
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('desempate', 'Tiebreaker\Controllers\Tiebreaker');
    }
}