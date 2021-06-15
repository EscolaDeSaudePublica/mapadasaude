<?php
namespace EvaluationMethodTechnical\Controllers;

use DateTime;
use \MapasCulturais\App;
use \EvaluationMethodTechnical\Entities\SectionNoteEvaluation;


class SectionNoteEvaluationController extends \MapasCulturais\Controller{

    function POST_createNoteCriteria() {
        dump($this->postData);
        $note = 0;
        if($this->postData['nota'] == 'NaN') {
            $note = 0;
        }else{
            $note = $this->postData['nota'];
        }
        
        $sec = new SectionNoteEvaluation;
        $sec->result = $note;
        $sec->evaluationData = $this->postData['sessao'];
        // dump($sec);
        
        // $evaluationData = [];
        // array_push($evaluationData, ['section' => $this->postData['sessao'] ]);
    }

}