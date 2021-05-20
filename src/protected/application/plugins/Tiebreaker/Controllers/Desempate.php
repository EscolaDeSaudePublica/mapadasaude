<?php
namespace Tiebreaker\Controllers;

use DateTime;
use \MapasCulturais\App;

class Desempate extends \MapasCulturais\Controller{
    
    function POST_create() {
        dump($this->postData);
    }
}