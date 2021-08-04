<?php 
use MapasCulturais\i;
use MapasCulturais\Entities\Opportunity;

$avatar = $opportunity->avatar ? $opportunity->avatar->transform('avatarSmall') : null;
    
$url = $this->isEditable() ? $opportunity->editUrl : $opportunity->singleUrl;
// $entity = $app->repo('ProjectOpportunity')->find();

?>
<article class="objeto has-avatar" style="background: #E8E8E8;border-radius: 8px;height: 200px;">
    <?php if($avatar): ?>
    <img src="<?php echo $avatar->url?>" style="background: white; border-radius: 50px; padding: 3px;">
    <?php else: ?>
        <img src="http://localhost/assets/img/avatar--opportunity.png" style="background: white; border-radius: 50px; padding: 3px;"/>
    <?php endif; ?>
    
    <div class="entity-opportunity--content ">
        <a href="<?php echo $url ?>"><?php echo $opportunity->name ?></a>
        <div class="">
            <?php $this->part('singles/opportunity-about--registration-dates', ['entity' => $opportunity, 'disable_editable' => true]) ?>
        </div>
        <?php if($opportunity->status == Opportunity::STATUS_DRAFT): ?>
        <em><?php i::_e('(Rascunho)') ?></em>
        <?php endif; ?>
        <br>
        <div class="objeto-meta">
        <?php if ($app->auth->isUserAuthenticated()): ?>
            <?php $this->part('singles/opportunity-registrations--form', ['entity' => $opportunity]) ?>
        <!-- <button class="btn-access" style="float: left; margin-right: 12px;" title="Acessar inscrições">
            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            <a style="color: white;" href="<? echo $url; ?> "> Acessar Inscrição</a>
        </button> -->
        <?php endif; ?>
        </div>
        
    </div>
</article>