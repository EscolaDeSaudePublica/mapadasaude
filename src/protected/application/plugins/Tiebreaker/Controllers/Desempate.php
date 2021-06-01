<?php
namespace Tiebreaker\Controllers;

use DateTime;
use \MapasCulturais\App;
use MapasCulturais\Entities\OpportunityMeta;
/**
 * DEFINIÇÃO DA ORDEM
 * 1 - Idade igual ou superior a 60 (sessenta) anos;
 * 2 - Maior nota de determinado momento;
 * 3 - Tiver a maior idade, considerando ano, mês e dia;
 * 4 - Tiver exercido a função de jurado.
 */
class Desempate extends \MapasCulturais\Controller{
    
    function POST_create() {
        // dump($this->postData);
        $app = App::i();
        //GRAVAR NA TABELA OPORTUNITY_META
        $entity = $app->repo('Opportunity')->find($this->postData['owner']);
        foreach ($this->postData as $key => $value) {
            $order = new OpportunityMeta;
            $order->key = $key;
            $order->value = $value;
            $order->owner = $entity;
            $app->em->persist($order);
            $app->em->flush();
        }
        $this->json(['message' => 'Desempate registrado', 'type' => 'success'], 200);
    }

    function GET_getNameTiebreaker() {
        
    }
}