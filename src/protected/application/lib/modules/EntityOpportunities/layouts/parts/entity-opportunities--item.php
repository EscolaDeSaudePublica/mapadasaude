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

if($this->isEditable()){
    $this->addEntityTypesToJs($opportunity);
    $this->addTaxonoyTermsToJs('tag');
}

$this->includeAngularEntityAssets($opportunity);


$avatar = $opportunity->avatar ? $opportunity->avatar->transform('avatarSmall') : null;
    
$url = $this->isEditable() ? $opportunity->editUrl : $opportunity->singleUrl;
// $entity = $app->repo('ProjectOpportunity')->find();

?>
<article class="objeto card-info-opportunity"  ng-controller="OpportunityController">
    <div style="width: 100%;">
        <div style="width: 10%; float:left;">
        <?php if($avatar): ?>
    <img src="<?php echo $avatar->url?>" class="avatar-card-info-opportunity">
    <?php else: ?>
        <img src="http://localhost/assets/img/avatar--opportunity.png"  class="avatar-card-info-opportunity"/>
    <?php endif; ?>
        </div>
        <div style="width: 90%;float:left;">
        <div class="entity-opportunity--content pad-left-10">
        <a href="<?php echo $url ?>"><?php echo $opportunity->name ?></a>
        <div class="">
            <?php $this->part('singles/opportunity-about--registration-dates', ['entity' => $opportunity, 'disable_editable' => true]) ?>
        </div>
        <?php if($opportunity->status == Opportunity::STATUS_DRAFT): ?>
        <em><?php i::_e('(Rascunho)') ?></em>
        <?php endif; ?>
        <br>
        <div>
            <?php
            
            $this->part('singles/opportunity-registrations--form', ['entity' => $opportunity]) ?>
        <!-- <button class="btn-access" style="float: left; margin-right: 12px;" title="Acessar inscrições">
            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a style="color: white;" href="<? echo $url; ?> "> Acessar Inscrição</a>
        </button> -->
       
        </div>
        
    </div>
        </div>
    </div>
    
    
    
</article>