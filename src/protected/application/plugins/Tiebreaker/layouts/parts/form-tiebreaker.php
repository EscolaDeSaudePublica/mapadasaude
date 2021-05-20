<?php
//$this->bodyProperties['ng-controller'] = "TiebreakerController";
?>
<p>
<hr>
</p>

<p>
<h4><?php \MapasCulturais\i::_e("Desempate");?></h4>
<p class="registration-help">
    Nesta sessão o administrador da oportunidade informa que será o critério de desempate para o edital.
</p>
<div class="panel panel-default" ng-controller="TiebreakerController">
  <div class="panel-heading">Critério de desempate</div>
  <span>{{list}}</span>
  <div class="panel-body">
    <ul ui-sortable="sortableOptions" class="list-group" ng-model="items">
        <li class="list-group-item" ng-repeat="item in items" style="cursor: pointer;">
        <i class="fa fa-arrows-alt"></i> {{ item.text }}</li> 
    </ul>
    <div class="footer">
      <div class="footer-button">
          <button type="button" class="btn btn-primary" style="margin-top: 5px;" ng-click="confirm()">
            <i class="fa fa-check"></i> Confirmar
          </button>
      </div>
    </div>
  </div>
</div>
</p>