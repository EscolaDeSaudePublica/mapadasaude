<?php 
$sentDate = $entity->sentTimestamp; 
$hoje = new DateTime('now');
$canEdit = $this->getEndDateopportunity($entity->opportunity->registrationTo);

?>
<?php if ($sentDate) : ?>
    <div class="alert success">
        <?php \MapasCulturais\i::_e("Inscrição enviada no dia"); ?>
        <?php echo $sentDate->format(\MapasCulturais\i::__('d/m/Y à\s H:i:s')); ?>
    </div>
<?php endif; ?>

<?php $this->applyTemplateHook('registration-single-header', 'before'); ?>
<h3 class="registration-header">
    <?php $this->applyTemplateHook('registration-single-header', 'begin'); ?>
    <?php \MapasCulturais\i::_e("Formulário de Inscrição"); ?>
    <?php $this->applyTemplateHook('registration-single-header', 'end'); ?>
</h3>
<div class="registration-fieldset clearfix registration-div-info">

    <div class="alignleft">
        <h4><?php \MapasCulturais\i::_e("Número da Inscrição"); ?></h4>
        <?php echo $entity->number ?>
    </div>
    <div class="registration-btn-edit">
        <?php if(!$canEdit) : ?>
        <a href="#" class="btn btn-success" data-remodal-target="modal-edit-registration">
            Editar Inscrição
        </a>
        <?php endif; ?>

        <div class="remodal modal-border" data-remodal-id="modal-edit-registration">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h3>Você irá Editar sua inscrição</h3>
            <div>
                <h4 style="color: #F26822; font-weight: bold;">
                    Todas as alterações feitas serão automaticamente salvas 
                </h4>
            </div>
            <div>
                <p>
                    Ao confirmar essa ação, você irá alterar uma inscrição já enviada. Você conseguirá editar novamente os dados desta inscrição se fizer isso durante o período de incrições.
                </p>

            </div>
            <br>
            <div style="float: right;">
                <form action="<?php echo $app->createUrl('registration', 'alterStatusRegistration', [$entity->id]); ?>" method="post">
                <button data-remodal-action="cancel" class="btn btn-default" title="Desistir da edição" style="margin-right: 15px;"> Voltar</button>
                <button type="submit" class="btn btn-primary" rel='noopener noreferrer'>
                    <?php \MapasCulturais\i::_e("Confirmar"); ?>
                </button>
                </form>
            </div>
        </div>


    </div>
    <div class="alignright">
        <?php if ($entity->canUser('changeStatus')) : ?>
            <mc-select class="{{getStatusSlug(data.registration.status)}}" model="data.registration" data="data.registrationStatusesNames" getter="getRegistrationStatus" setter="setRegistrationStatus"></mc-select>
        <?php elseif ($opportunity->publishedRegistrations) : ?>
            <span class="status status-{{getStatusSlug(<?php echo $entity->status ?>)}}">{{getStatusNameById(<?php echo $entity->status ?>)}}</span>
        <?php endif; ?>

    </div>
</div>
<?php $this->applyTemplateHook('registration-single-header', 'after'); ?>






<?php if ($entity->projectName) : ?>
    <div class="registration-fieldset">
        <div class="label"><?php \MapasCulturais\i::_e("Nome do Projeto"); ?> </div>
        <h5> <?php echo $entity->projectName; ?> </h5>
    </div>
<?php endif; ?>