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
            showOptionsCriteria : true,
            itensSections : [ ]
        };
        //mudando a div de acordo com a escolha do select
        $scope.changeTiebreaker = function(itemSelect) {
            console.log('item ' ,  itemSelect);
            if(itemSelect === 'averageSection') {
                $scope.data.showOptionsCriteria = true;
            }else{
                $scope.data.showOptionsCriteria = false;
            }
        }

        $scope.addSectionTiebreaker = function(idSection) {
            console.log(idSection);    
            var newName = {'Secao' : idSection};
            $scope.data.itensSections.push(newName);
            console.log(newName);
            console.log($scope.data.itensSections);
        }

    }]);
})(angular);