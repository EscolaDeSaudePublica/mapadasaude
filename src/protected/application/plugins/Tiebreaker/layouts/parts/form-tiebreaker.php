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
  <div class="panel-body">
    <ul class="list-group" ui-sortable="sortableOptions" ng-model="items">
        <li class="list-group-item" ng-repeat="item in items" class="attachment-list-item project-edit-mode attachment-list-item-type-date ui-sortable-handle" style="cursor: pointer;">
        <i class="fa fa-arrows-alt"></i> {{ item }}</li> 
    </ul>
  </div>
</div>
</p>