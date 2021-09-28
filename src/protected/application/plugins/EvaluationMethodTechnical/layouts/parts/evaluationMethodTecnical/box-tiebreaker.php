<div ng-controller="TiebreakerController">
<p>
            <label for="">Escolha o critério de desempate. {{data.itemSelect}}</label>
            <select name="selectTiebreakerCriteria" id="selectTiebreakerCriteria" ng-model="itemSelect" ng-change="changeTiebreaker(itemSelect)">
                <option value="averageSection">Média de uma seção</option>
                <option value="formAttachment">Comprovante de Jurado (anexo do formulário)</option>
                <option value="fieldForm">Campo do formulário</option>
            </select>
        </p>
        <span>showOptionsCriteria {{data.showOptionsCriteria}}</span>
        <div  ng-if="data.showOptionsCriteria">
         
            <ul>
                <?php
                    foreach ($section as $key => $sections) {
                        echo '<li>'.$sections->name.' <a ng-click="addSectionTiebreaker('.$sections->id.')" title="Adicionar esse item ao critério de desempate" > <i class="fa fa-plus"></i> </a></li>';
                    }               
                ?>
                
            </ul>
        </div>
        <div>
            <span>Seções adicionadas</span>
            <ul>
                <li ng-repeat="item in data.itensSections">{{item.Secao}}</li>
            </ul>
        </div>
    <edit-box 
        id="add-tiebreaker-criteria" position="right" title="Adicionar desempate"
        spinner-condition="data.processando" cancel-label="Fechar" 
        submit-label="Adicionar" on-open="" on-cancel="" on-submit="" close-on-cancel='true'>
       
    </edit-box>
</div>