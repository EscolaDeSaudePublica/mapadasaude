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

        $scope.list = [];
        
        $scope.sortingLog = [];

        $scope.all();
        $scope.items = [
            {id: 1, text: "Idade igual ou superior a 60 (sessenta) anos"}, 
            {id: 2, text: "Maior nota de determinado momento"}, 
            {id: 3, text: "Tiver a maior idade, considerando ano, mês e dia"}, 
            {id: 4, text: "Tiver exercido a função de jurado"}
        ];
        console.log(typeof($scope.items));
        // $scope.items.sort(function (a, b) {
        //     return a.id > b.id;
        // });
        console.log($scope.items);
        $scope.sortableOptions = {
            
            update: function(e, ui) {
                console.log($scope.items[0].id)
                $scope.list = [];
                console.log(typeof($scope.items));
                
               
            }
        };
        $scope.order = [];

        $scope.confirm = function() {
            console.log($scope.items);
            var order = [0];
            for (var index in $scope.items) {
                var pos = $scope.items[index].id;

                console.log('Index = '+index+' Items = '+$scope.items[index].id);
                
                // $scope.items[index].i = index;
                // var item = $scope.items[index].id;
                // console.log({item})
                // console.log($scope.items[index].i+' = '+$scope.items[index].id);
                $scope.order.push({order: pos})
            }
            var dataConfirm = [];
            
            for (let index = 0; index < $scope.order.length; index++) {
                console.log($scope.order[index].order);
                dataConfirm.concat({
                    'id' : $scope.order[index].order
                })
                // dataConfirm.push({ 'id' : $scope.order[index].order})
            }
            console.log(dataConfirm);
            $http.post(MapasCulturais.baseURL+'desempate/create', dataConfirm);
        }
        // $scope.update = function(e, ui) {
        //     var logEntry = tmpList.map(function(i){
        //       return i.value;
        //     }).join(', ');
        //     $scope.sortingLog.push('Update: ' + logEntry);
        //   };
        // $scope.stop = function(e, ui) {
        // // this callback has the changed model
        //     console.log(tmpList);
        //     var logEntry = tmpList.map(function(i){
        //         return i.value;
        //     }).join(', ');
        
        // $scope.sortingLog.push('Stop: ' + logEntry);
       
        // };
    }]);
})(angular);