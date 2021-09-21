<?php
namespace SealCertified;
use \MapasCulturais\App;

class Plugin extends \SealModelTab\SealModelTemplatePlugin
{
    function __construct($config = []) {
      $config += [
         'logo-site' => 'img/logo-saude.png'
      ];
      parent::__construct($config);
   }

    function getModelData(){
        return [
            'label'=> 'Declaração ESP',
            'name' => 'SealCertified',
            'css' => 'seal-certified--styles.css',
            'background' => 'meu-certificado--bg.jpg',
            'preview' => 'seal-certified--preview.jpg'
        ];
    }

}