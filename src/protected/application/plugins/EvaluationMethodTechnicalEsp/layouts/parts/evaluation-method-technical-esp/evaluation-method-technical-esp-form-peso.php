

<input ng-model="section.weight" type="number" placeholder="<?php \MapasCulturais\i::_e('informe o peso da secão') ?>" class="section-name edit" ng-change="save({sections: data.sections})" ng-model-options='{ debounce: data.debounce }'>