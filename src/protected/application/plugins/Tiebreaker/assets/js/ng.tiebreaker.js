(function (angular) {
    "use strict";

    var module = angular.module('ng.tiebreaker', ['ngSanitize']);

    module.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        $httpProvider.defaults.transformRequest = function (data) {
            var result = angular.isObject(data) && String(data) !== '[object File]' ? $.param(data) : data;

            return result;
        };
    }]);

    module.factory('TiebreakerService', ['$http', function($http) {
        return {
            test: function() {
                
                console.log('TiebreakerService');
               
            }
        }
    }]);

    module.controller('TiebreakerController' , ['$scope', '$http', 'TiebreakerService', function($scope, $http, TiebreakerService){
        $scope.all = function() {
            TiebreakerService.test();
        }
        $scope.all();
        $scope.items = ["Idade igual ou superior a 60 (sessenta) anos", "Maior nota de determinado momento", "Tiver a maior idade, considerando ano, mês e dia", "Tiver exercido a função de jurado"];

        $scope.sortableOptions = {
            update: function(e, ui) { 
              console.log({e});
              console.log({ui});
            },
          axis: 'x'
        };
    }]);
})(angular);