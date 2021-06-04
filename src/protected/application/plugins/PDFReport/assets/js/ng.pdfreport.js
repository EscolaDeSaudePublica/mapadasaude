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
                return $http.post(MapasCulturais.baseURL+'opportunity/createTiebreaker', postData);
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
        //BUSCA TODOS OS ITENS DE DESEMPATE PARA PREENCHER AS OPÇÕES DO SELECT
        PdfReportService.getTiebreaker().then(function(response){
            var opt = response.data;
            opt.forEach(element => {
                $scope.options.push({value: element.owner, label: element.value})
            });
        });

        $scope.change = function() {
            //CRIANDO A OPÇÃO EM ORDEM NO BANCO DA TABELA OPPORTUNITY META
            PdfReportService.createTiebreaker($scope.alter).then(function(response){ 
                if(response.status == 200) {
                    jQuery("#orderTiebreaker span").remove();
                    $scope.showOrderTiebreaker();
                }
            });
        }

        $scope.changeFilterReport = function() { 
            if($scope.filterReport == 3){
              document.getElementById("orderTiebreaker").setAttribute("class", "show-select");
              document.getElementById("selectTiebreaker").setAttribute("class", "show-select");
            }else{
                document.getElementById("orderTiebreaker").setAttribute("class", "hide-select");
                document.getElementById("selectTiebreaker").setAttribute("class", "hide-select");
            }
        }
        //MOSTRANDO A DIV COM AS OPÇÕES ESCOLHIDO PARA O DESEMPATE
        $scope.showOrderTiebreaker = function() {
            PdfReportService.getOrderTiebreaker(MapasCulturais.entity.id).then(function(response){
                if(response.data.length > 0) {
                    $scope.divOptions = true;
                    jQuery("#orderTiebreaker").removeClass('hide-select');
                    jQuery("#orderTiebreaker").addClass('show-select');
                }
                response.data.forEach(element => {
                    $scope.addOptionOrder(element.id, element.name);
                });
            });
        }

        $scope.showOrderTiebreaker();
        //adicionando os itens escolhido no select na página
        $scope.addOptionOrder = function(id, text) {
            var divtoappend=angular.element( document.querySelector('#orderTiebreaker'));
            divtoappend.append('<span id="spanTextOrder_'+id+'" class="badge_default margin-bottom-5">'+text+' <a href="#/tab=inscritos" class="closeCategoryProfessional" onclick="deleteTiebreaker('+id+')"><i class="fa fa-close"></i></a></span>');
        }
    }]);

})(angular);
//DELETA OPÇÃO DE ESCOLHA 
function deleteTiebreaker(id) {
    $("#spanTextOrder_"+id).remove();
    var postData = {
        id: id
    }
    $.ajax({
        type: "POST",
        url: MapasCulturais.baseURL+'opportunity/deleteMetaOpportunity',
        data: postData,
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
}