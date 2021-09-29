(function (angular) {
    var module = angular.module('tiebreaker', ['ngSanitize']);
    // modifica as requisições POST para que sejam lidas corretamente pelo Slim
    module.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.common['X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $httpProvider.defaults.transformRequest = function (data) {
            var result = angular.isObject(data) && String(data) !== '[object File]' ? $.param(data) : data;

            return result;
        };
    }]);

    // Seriço que executa no servidor as requisições HTTP
    module.factory('TiebreakerService', ['$http', function ($http) {
        return {};
    }]);

    // Controlador da interface
    module.controller('TiebreakerController', ['$scope', 'TiebreakerService', function ($scope, ItemService) {
        $scope.data = {
            select : true,
            itemSelect : '',
            itemField: '',
            itemOperator: '',
            showOptionsCriteria : false,
            showDivFieldForm : false,
            showDivOperator : false,
            itensSections : [ ],
            itensFields : [ ],
            countClickSection : 0,
            disabled : ''
        };
        //mudando a div de acordo com a escolha do select
        $scope.changeTiebreaker = function(itemSelect) {
            console.log('item ' ,  itemSelect);
            if(itemSelect === 'averageSection') {
                $scope.data.showOptionsCriteria = true;
                $scope.data.showDivFieldForm = false;
                $scope.data.showDivOperator = false;
            }else {
                $scope.data.showOptionsCriteria = false;
            }
            if(itemSelect === 'fieldForm') {
                var id = MapasCulturais.entity.id;
                $scope.data.showDivFieldForm = true;
                $scope.data.showDivOperator = true;
                
                //$scope.data.itemField = true;
            }
            if(itemSelect != 'averageSection' || itemSelect != 'fieldForm') {
                $scope.data.itemField = itemSelect;
            }
        }

        $scope.addSectionTiebreaker = function(idSection, nameSection) {
            console.log(idSection);    
            $scope.data.countClickSection = 1;
            if($scope.data.countClickSection > 0) {
                $scope.data.disabled = 'disabled';
            }
            console.log({nameSection});
            $scope.data.itensSections.push(nameSection);
            console.log($scope.data.itensSections);
        }        
        
        $scope.addFieldTiebreaker = function(idField, nameField) {
           console.log({idField})
           var newReg = idField + ' '+nameField+' 60';
           $scope.data.itensSections.push(newReg);
        }

        $scope.changeOperator = function(operator) {
            console.log(operator)
            console.log($scope.data.itemField)
            var newReg = operator + ' '+$scope.data.itemField;
            console.log(newReg);
            // $scope.data.itensSections.push(nameField);
        }

    }]);
})(angular);