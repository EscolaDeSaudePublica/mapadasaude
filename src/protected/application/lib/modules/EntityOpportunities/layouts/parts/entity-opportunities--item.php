<?php

use MapasCulturais\i;
use MapasCulturais\Entities\Opportunity;

/**
 * Adicionado essas dependências para o funcionamento do componente do angular para buscar o(s) agente(s)
 */
$this->bodyProperties['ng-app'] = "entity.app";
$this->bodyProperties['ng-controller'] = "EntityController";

$this->jsObject['angularAppDependencies'][] = 'entity.module.opportunity';
$this->jsObject['angularAppDependencies'][] = 'ui.sortable';

$this->addEntityToJs($opportunity);

$this->addOpportunityToJs($opportunity);

$this->addOpportunitySelectFieldsToJs($opportunity);

if ($this->isEditable()) {
    $this->addEntityTypesToJs($opportunity);
    $this->addTaxonoyTermsToJs('tag');
}

$this->includeAngularEntityAssets($opportunity);


$avatar = $opportunity->avatar ? $opportunity->avatar->transform('avatarSmall') : null;

$url = $this->isEditable() ? $opportunity->editUrl : $opportunity->singleUrl;
// $entity = $app->repo('ProjectOpportunity')->find();

?>
<article class="objeto card-info-opportunity" ng-controller="OpportunityController">

    <div class="card-info-header">
        <?php if ($avatar) : ?>
            <img src="<?php echo $avatar->url ?>" class="avatar-card-info-opportunity">
        <?php else : ?>
            <img src="<?php $this->asset('img/avatar--opportunity.png'); ?>" alt=""  class="avatar-card-info-opportunity" />
        <?php endif; ?>

        <span>
            <a href="<?php echo $url ?>"><?php echo $opportunity->name ?></a>
            <?php $this->part('singles/opportunity-about--registration-dates', ['entity' => $opportunity, 'disable_editable' => true]) ?>
        </span>
    </div>
    <div class="card-info-content">
        <?php //if ($opportunity->status == Opportunity::STATUS_DRAFT) : ?>
            <em><?php //i::_e('(Rascunho)') ?></em>
        <?php //endif; 
        $this->part('singles/opportunity-registrations--form', ['entity' => $opportunity]) 
        ?>

    </div>

    <!-- <div class="entity-opportunity--content pad-left-10">
       
        <div class="">
           
        </div>
        <?php //if ($opportunity->status == Opportunity::STATUS_DRAFT) : ?>
            <em><?php //i::_e('(Rascunho)') ?></em>
        <?php //endif; ?>
        <br>
        <div>
            <?php
            //$this->part('singles/opportunity-registrations--form', ['entity' => $opportunity]) ?>
        </div>
    </div> -->


</article>