<?php

namespace EvaluationMethodTechnicalEsp;

use MapasCulturais\App;

class Plugin extends \MapasCulturais\Plugin {
    function __construct(array $config = []) {
        parent::__construct($config);
    }

    public function register() {
        
    }

    public function _init() {
        $app = App::i();
        $plugin = $this;

        
        $app->hook('template(opportunity.edit.technical--configuration-form-header-form):end', function () use ($plugin) {
            /** @var \MapasCulturais\Theme $this */

            $this->enqueueScript('app', 'technicalesp-form-peso', 'js/ng.evaluationMethod.technicalesp.js');

            $this->part('evaluation-method-technical-esp/evaluation-method-technical-esp-form-peso');
        });

    }


}
