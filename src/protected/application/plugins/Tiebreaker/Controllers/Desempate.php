<?php
namespace Tiebreaker\Controllers;

use DateTime;
use \MapasCulturais\App;

class Desempate extends \MapasCulturais\Controller{
    
    function POST_create() {
        dump($this->postData);
        //GRAVAR NA TABELA OPORTUNITY_META
    }
}