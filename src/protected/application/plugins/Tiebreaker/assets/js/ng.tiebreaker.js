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
               
            },
            sendOrder: function (postData) {
                return $http.post(MapasCulturais.baseURL+'desempate/create', postData).
                        success(function (data, status) {
                            console.log(data)
                            console.log(status)
                        }).
                        error(function (error, status) {
                            console.log(error)
                            console.log(status)
                        });
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
           
            
            // console.log(dataConfirm);
            var logEntry = $scope.items.map(function(i){
                return i.id;
            }).join(', ');
            //var string = 'hello, world, test, test2, rummy, words';
            var arr = logEntry.split(', '); // split string on comma space
            console.log( arr );
            console.log( typeof(arr) );
            console.log( arr.length );
            var dataConfirm = [];
            // for (let index = 0; index < $scope.items.length; index++) {
            //     console.log($scope.items[index].id);
            //     dataConfirm[index] = $scope.items[index].id
            // }
            console.log($scope.items[0].id);
            var arrdata = {
                'primeiro'  : $scope.items[0].id,
                'segundo'   : $scope.items[1].id,
                'terceiro'  : $scope.items[2].id,
                'quarto'    : $scope.items[3].id
            };
            console.log( typeof(arrdata) )
            console.log( arrdata )
            TiebreakerService.sendOrder(arrdata).then(function(response){
                console.log(response);
            })
            //$http.post(MapasCulturais.baseURL+'desempate/create', postData);
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