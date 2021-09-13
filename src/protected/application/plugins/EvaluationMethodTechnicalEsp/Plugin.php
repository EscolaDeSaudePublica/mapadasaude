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

        $app->hook('template(registration.view.technical--evaluation-form-info):end', function () use ($plugin) {
            /** @var \MapasCulturais\Theme $this */
            $this->part('evaluation-method-technical-esp/technical--evaluation-form-info');
        });


        $app->hook('app.plugin.getEvaluationResultCalc:before', function ($evaluation, &$total) use ($app, $plugin) {
            $total = 0.00;

            $cfg = $evaluation->getEvaluationMethodConfiguration();
            $qtdWeightTotal = 0;
            foreach ($cfg->sections as $section) {
                $qtdWeightTotal += $section->weight;
                $totalSection = 0.00;
                foreach($cfg->criteria as $cri) {
                    if ($section->id == $cri->sid) {
                        $key = $cri->id;
                        if(!isset($evaluation->evaluationData->$key)){
                            return null;
                        } else {
                            $val = floatval($evaluation->evaluationData->$key);
                            $totalSection += is_numeric($val) ? floatval($cri->weight) * floatval($val) : 0;
                        }
                    }
                }

                $total  += floatval($totalSection) * floatval($section->weight);
            }

            $total = $total / $qtdWeightTotal;
        });
    }


}
