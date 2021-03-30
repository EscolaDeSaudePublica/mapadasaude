<?php
    use MapasCulturais\i;
    $app = \MapasCulturais\App::i();
    $user = $app->user;
    $baseUrl = $app->_config['base.url'];
    ?>
<div class="opportunity-claim-box">
    <a class="btn btn-primary" href=" <?php echo $baseUrl.'/painel/inscricoes/?id='.$registration->id.'#'.$registration->id;?>">
        Ir para página de recurso.
    </a>

</div>

<form class="form-opportunity-claim js-opportunity-claim-form" ng-show="form[<?php echo $registration->id?>]" ng-controller="OpportunityClaimController">
    <p>
        <?php i::_e("Mensagem");?>:<br />
        <textarea ng-model="data.message" type="text" rows="5" cols="30" name="message"></textarea>
    </p>
    <p>
        <button class="js-submit-button opportunity-claim-form"
            ng-click="
            send(<?php echo $registration->id?>);
            form[<?php echo $registration->id?>] = false;
            "
            >
        <?php i::_e("Enviar");?>
        </button>
    </p>
</form>