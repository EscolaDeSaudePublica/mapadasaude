<style>
    .disabled {
        pointer-events: none;
        cursor: default;
        color: #c3c3c3;
    }
</style>
<div ng-controller="TiebreakerController" class="registration-fieldset project-edit-mode">
    <h4>Critérios de desempate</h4>
    <span class="registration-help">Habilitação de ordem de desempate.</span>
    <p>
        <a ng-click="editbox.open('add-tiebreaker-criteria', $event)" class="btn btn-default" title="Abrir EditBox">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar desempate
        </a>
    </p>
    <div>
        <span>Ordem de desempate</span>
        <ul>
            <li ng-repeat="item in data.itensSections">{{item}}
                <a ng-click="removeItemSection(item)" class="btn remove-item" title="Remove esse item">
                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>

    <edit-box id="add-tiebreaker-criteria" position="right" title="Adicionar desempate" spinner-condition="data.processando" cancel-label="Fechar" on-open="" on-cancel="" on-submit="" close-on-cancel='true'>

            <label for="">Escolha o critério de desempate. {{data.itemSelect}}</label>
            <select name="selectTiebreakerCriteria" id="selectTiebreakerCriteria" ng-model="itemSelect" ng-change="changeTiebreaker(itemSelect)">
                <option value="" disabled selected>--Selecione--</option>
                <option value="averageSection">Média de uma seção</option>
                <option value="formAttachment">Comprovante de Jurado (anexo do formulário)</option>
                <option value="fieldForm">Campo do formulário</option>
            </select>
        <div ng-if="data.showOptionsCriteria">
        <small class="text-success" ng-if="data.textSuccess">Adicionado!</small>
            <ul>
                <?php
                foreach ($section as $key => $sections) : ?>
                    <li class="li-item"><?php echo $sections->name; ?>
                        <a ng-click="addSectionTiebreaker('<?php echo $sections->id; ?>','<?php echo $sections->name; ?>')" title="Adicionar esse item ao critério de desempate" id="<?php echo $sections->id; ?>" class="btn btn-plus-item">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
            
        </div>
     
   
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
     
    </edit-box>
</div>