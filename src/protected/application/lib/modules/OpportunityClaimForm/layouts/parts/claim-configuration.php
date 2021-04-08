<?php
use MapasCulturais\i;

if(!$this->isEditable()){
    return;
}

$owner_email = $opportunity->owner->emailPrivado ? $opportunity->owner->emailPrivado : $opportunity->owner->emailPublico;
?>
<div id="registration-claim-configuration" class="registration-fieldset project-edit-mode">
    <h4><?php i::_e("Formulário para recursos");?></h4>

    <!--<p>
        <span class="js-editable" data-edit="claimDisabled" data-original-title="<?php i::esc_attr_e('Formulário de recursos');?>" data-value="<?php echo $opportunity->claimDisabled ?>"></span>
    </p>
    -->

    <p>
        <span>
        <?php i::esc_attr_e('Formulário de recursos');?>
        </span>
        <br>
        <select id="resourceOptions" name="resourceOptions">
             <!-- 
                 <option value=""><?php i::_e('Selecione');?></option> 
            -->
            <option value="0"><?php i::_e('Habilitar formulário de Recurso');?></option>
            <option selected value="1"><?php i::_e('Desabilitar formulário de Recurso');?></option>
        </select>

        <div id="insertData">
        <form id="resourceFormData">
        <label for="data-inicial">Data de início </label><input type="text" class="date" name="data-init"><br>
        <label for="hora-inicial">hora </label><input type="text" class="time" name="hora-init"><br>
        <label for="data-final">Data final </label><input type="text" class="date" name="data-end"><br>
        <label for="hora-final">hora </label><input type="text" class="time" name="hora-end"><br>
        </form>
        <button class="btn btn-primary" id="buttonSendData">Salvar</button>
        </div>

    </p>
    <p>
        <span class="label"><?php i::_e("Email de destino dos recursos");?>: </span><br>
        <span class="js-editable" data-edit="claimEmail" data-original-title="<?php i::esc_attr_e('Email do destinatário');?>" data-emptytext="<?php echo $owner_email;?>"><?php echo $opportunity->claimEmail; ?></span>
    </p>
</div>
