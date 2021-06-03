(function (angular) {
    "use strict";
    var module = angular.module('ng.pdfreport', ['ngSanitize']);

    module.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        $httpProvider.defaults.transformRequest = function (data) {
            var result = angular.isObject(data) && String(data) !== '[object File]' ? $.param(data) : data;

            return result;
        };
    }]);

    module.factory('PdfReportService', ['$http', function($http) {
        return {
            test: function() {
                
                console.log('TiebreakerService');
               
            },
            getTiebreaker: function() {
                return $http.get(MapasCulturais.baseURL+'opportunity/getTiebreaker').then(function(data){
                    return data;
                });
            },
            createTiebreaker: function(data) {
                var postData = {
                    id: data,
                    opportunity: MapasCulturais.entity.id
                }
                $http.post(MapasCulturais.baseURL+'opportunity/createTiebreaker', postData);
            },
            getOrderTiebreaker: function(id) {
                return $http.get(MapasCulturais.baseURL+'opportunity/orderTiebreaker/'+id);
            }
        }
    }]);

    module.controller('PdfReportController' , ['$scope', '$http', 'PdfReportService', function($scope, $http, PdfReportService){
        $scope.options = [];
        $scope.alter = "";
        $scope.filterReport = "";
        $scope.divOptions = false;
        PdfReportService.getTiebreaker().then(function(response){
            console.log(response);
            var opt = response.data;
            opt.forEach(element => {
                //console.log(element);
                $scope.options.push({value: element.owner, label: element.value})
            });
        });

        $scope.change = function() {
            console.log('change');
            console.log($scope.alter);
            PdfReportService.createTiebreaker($scope.alter);
           
        }

        $scope.changeFilterReport = function() { 
            console.log('changeFilterReport');
            console.log($scope.filterReport);
            if($scope.filterReport == 3){
              document.getElementById("orderTiebreaker").setAttribute("class", "show-select");
              document.getElementById("selectTiebreaker").setAttribute("class", "show-select");
            }else{
                document.getElementById("orderTiebreaker").setAttribute("class", "hide-select");
                document.getElementById("selectTiebreaker").setAttribute("class", "hide-select");
            }
        }

        PdfReportService.getOrderTiebreaker(MapasCulturais.entity.id).then(function(response){
            // if(response.data.length > 0) {
            //     $scope.addOptionOrder();
            // }
            response.data.forEach(element => {
                $scope.addOptionOrder(element);
            });
        });

        $scope.addOptionOrder = function(text) {
            document.getElementById("orderTiebreaker").append(
            '<span class="badge_default margin-bottom-5">'+text+' <a href="#" class="closeCategoryProfessional" onclick="deleteSpecialty(teste)"><i class="fa fa-close"></i></a></span><br />');
        }
    }]);

})(angular);