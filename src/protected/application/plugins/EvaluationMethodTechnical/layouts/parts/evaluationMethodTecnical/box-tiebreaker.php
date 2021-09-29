<style>
    .disabled {
        pointer-events: none;
        cursor: default;
        color: #c3c3c3;
    }
</style>
<?php
$fields = $configuration->opportunity->registrationFieldConfigurations;
?>
<div ng-controller="TiebreakerController">
    <div>
        <span>Ordem de desempate</span>
        <ul>
            <li ng-repeat="item in data.itensSections track by (item + $index)">{{item}}</li>
        </ul>
    </div>
    <edit-box id="add-tiebreaker-criteria" position="right" title="Adicionar desempate" 
    spinner-condition="data.processando" cancel-label="Fechar" 
    on-open="" on-cancel="" on-submit="" close-on-cancel='true'>
    <p>
        <label for="">Escolha o critério de desempate. {{data.itemSelect}}</label>
        <select name="selectTiebreakerCriteria" id="selectTiebreakerCriteria" ng-model="itemSelect" ng-change="changeTiebreaker(itemSelect)">
        <option value="" disabled selected>--Selecione--</option>    
        <option value="averageSection">Média de uma seção</option>
            <option value="formAttachment">Comprovante de Jurado (anexo do formulário)</option>
            <option value="fieldForm">Campo do formulário</option>
        </select>
    <div ng-if="data.showOptionsCriteria">
        <ul>
            <?php
            foreach ($section as $key => $sections) : ?>
                <li><?php echo $sections->name; ?>
                    <a ng-click="addSectionTiebreaker('<?php echo $sections->id; ?>','<?php echo $sections->name; ?>')" title="Adicionar esse item ao critério de desempate" id="<?php echo $sections->id; ?>">
                        <i class="fa fa-plus"></i>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
    </p>
    <p>
    <div ng-if="data.showDivFieldForm">
        <label for="">Qual o campo deseja usar como critério?</label>
        <select name="" id="" class="form-control" ng-model="itemField" ng-change="changeTiebreaker(itemField)">
            <option value="" disabled selected>--Escolha um campo--</option>
            <?php
            foreach ($fields as $key => $field) : ?>
                <option value="<?php echo $field->title; ?>"><?php echo $field->title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    </p>
    <p>
    <div ng-if="data.showDivOperator">
        <label for="">Comparação</label>
        <select name="" id="" class="form-control" ng-model="itemOperator" ng-change="changeOperator(itemOperator)">
            <option value="" disabled selected>Selecione</option>
            <option value="Maior que">Maior que</option>
            <option value="Maior ou igual que">Maior ou igual que</option>
            <option value="Menor que">Menor que </option>
            <option value="Menor ou igual que">Menor ou igual que</option>
            <option value="Igual a">Igual a</option>
            <option value="Diferente de">Diferente de</option>

        </select>
        <input type="text" class="form-control">
        <a ng-click="addFieldTiebreaker(data.itemField,itemOperator)">
            <i class="fa fa-plus"></i> Adicionar
        </a>
    </div>
    </p>
    </edit-box>
</div>