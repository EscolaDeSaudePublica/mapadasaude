(function (angular) {
    "use strict";

    var module = angular.module('ng.evaluationMethod.technical', ['ngSanitize']);

    module.config(['$httpProvider', function ($httpProvider) {
            $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            $httpProvider.defaults.headers.patch['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            $httpProvider.defaults.transformRequest = function (data) {
                var result = angular.isObject(data) && String(data) !== '[object File]' ? $.param(data) : data;

                return result;
            };
        }]);

    module.factory('TechnicalEvaluationMethodService', ['$http', '$rootScope', function ($http, $rootScope) {
            return {
                serviceProperty: null,
                getEvaluationMethodConfigurationUrl: function () {
                    return MapasCulturais.createUrl('evaluationMethodConfiguration', 'single', [MapasCulturais.evaluationConfiguration.id]);
                },
                patchEvaluationMethodConfiguration: function (entity) {
                    entity = JSON.parse(angular.toJson(entity));
                    return $http.patch(this.getEvaluationMethodConfigurationUrl(), entity);
                }
            };
        }]);

    module.controller('TechnicalEvaluationMethodConfigurationController', ['$scope', '$rootScope', '$timeout', 'TechnicalEvaluationMethodService', 'EditBox', function ($scope, $rootScope, $timeout, TechnicalEvaluationMethodService, EditBox) {
            $scope.editbox = EditBox;

            var labels = MapasCulturais.gettext.technicalEvaluationMethod;
            
            if(MapasCulturais.evaluationConfiguration && MapasCulturais.evaluationConfiguration.criteria){
                MapasCulturais.evaluationConfiguration.criteria = MapasCulturais.evaluationConfiguration.criteria.map(function(e){
                    e.min = parseFloat(e.min);
                    e.max = parseFloat(e.max);
                    e.weight = parseFloat(e.weight);
                    return e;
                });
            }

            if(MapasCulturais.evaluationConfiguration && MapasCulturais.evaluationConfiguration.sections){
                MapasCulturais.evaluationConfiguration.sections = MapasCulturais.evaluationConfiguration.sections.map(function(e){
                    e.weight = parseFloat(e.weight);
                    return e;
                });
            }
            
            $scope.data = {
                sections: MapasCulturais.evaluationConfiguration.sections || [],
                criteria: MapasCulturais.evaluationConfiguration.criteria || [],
                quotas: MapasCulturais.evaluationConfiguration.quotas || [],
                enableViability: MapasCulturais.evaluationConfiguration.enableViability || false,
                registrationCategories: MapasCulturais.entity.registrationCategories,

                debounce: 2000
            };

            function sectionExists(name) {
                var exists = false;
                $scope.data.sections.forEach(function (s) {
                    if (s.name == name) {
                        exists = true;
                    }
                });

                return exists;
            }

            $scope.save = function(){
                var data = {
                    sections: $scope.data.sections,
                    criteria: [],
                    quotas: $scope.data.quotas,
                    enableViability: $scope.data.enableViability,
                };

                $scope.data.criteria.forEach(function (crit) {
                    for (var i in data.sections) {
                        var section = data.sections[i];
                        if (crit.sid == section.id) {
                            data.criteria.push(crit);
                        }
                    }
                });

                $timeout.cancel($scope.saveTimeout); 

                $scope.saveTimeout = $timeout(function() {
                    TechnicalEvaluationMethodService.patchEvaluationMethodConfiguration(data).success(function () {
                        MapasCulturais.Messages.success(labels.changesSaved);
                        $scope.data.sections = data.sections;
                        $scope.data.criteria = data.criteria;
                        $scope.data.enableViability = data.enableViability;
                    });
                }, $scope.data.debounce);
            };

            $scope.addSection = function(){
                var date = new Date;
                var new_id = 's-' + date.getTime();
                $scope.data.sections.push({id: new_id, name: '', weight: 0});

                $timeout(function(){
                    jQuery('#' + new_id + ' header input').focus();
                },1);
            };

            $scope.deleteSection = function(section){
                if(!confirm(labels.deleteSectionConfirmation)){
                    return;
                }
                var index = $scope.data.sections.indexOf(section);

                $scope.data.criteria = $scope.data.criteria.filter(function(cri){
                    if(cri.sid != section.id){
                        return cri;
                    }
                });

                $scope.data.sections.splice(index,1);

                $scope.save();
            }

            $scope.addCriterion = function(section){
                var date = new Date;
                var new_id = 'c-' + date.getTime();
                $scope.data.criteria.push({id: new_id, sid: section.id, title: null, min: 0, max: 10, weight:1});
                $scope.save();

                $timeout(function(){
                    jQuery('#' + new_id + ' .criterion-title input').focus();
                },1);
            }

            $scope.deleteCriterion = function(criterion){
                if(!confirm(labels.deleteCriterionConfirmation)){
                    return;
                }
                var index = $scope.data.criteria.indexOf(criterion);

                $scope.data.criteria.splice(index,1);

                $scope.save();
            }
        }]);

    module.controller('TechnicalEvaluationMethodFormController', ['$scope', '$rootScope', '$timeout', 'TechnicalEvaluationMethodService', function ($scope, $rootScope, $timeout, TechnicalEvaluationMethodService) {
            var labels = MapasCulturais.gettext.technicalEvaluationMethod;
            MapasCulturais.evaluationConfiguration.criteria = MapasCulturais.evaluationConfiguration.criteria.map(function(e){
                e.min = parseFloat(e.min);
                e.max = parseFloat(e.max);
                e.weight = parseFloat(e.weight);
                return e;
            });
            
            if(MapasCulturais.evaluation){
                for(var id in MapasCulturais.evaluation.evaluationData){
                    if(id != 'obs' && id != 'viability' && id != 'na'){
                        MapasCulturais.evaluation.evaluationData[id] = parseFloat(MapasCulturais.evaluation.evaluationData[id]);
                    }
                }
            }
            
            $scope.data = {
                sections: MapasCulturais.evaluationConfiguration.sections || [],
                criteria: MapasCulturais.evaluationConfiguration.criteria || [],
                enableViability: MapasCulturais.evaluationConfiguration.enableViability || false,
                registrationCategory: MapasCulturais.entity.object.category,
                empty: true
            };
  
            if(MapasCulturais.evaluation){
                $scope.evaluation =  MapasCulturais.evaluation.evaluationData;
                $scope.data.empty = false;
            } else {
                $scope.evaluation =  {};
            }
            
            //Condição que verifica se há campos, cadastrados no banco de dados, marcados como não se aplica.
            if($scope.evaluation.na != undefined){
                //Trecho de código que traz os campos que estão cadastrados no banco de dados como não se aplica.
                Object.keys($scope.evaluation.na).forEach(function (r,i) {
                //console.log($scope.data.criteria);
                setTimeout(() => {
                    document.getElementById(r).readonly = true;
                }, 2000);
                //console.log(r);
                })
            }

            //Função criada para o sistema deixar os campos disabled quando o avaliador marcar os critérios como não se aplica.
            $scope.disabledNa = function(v){
                if(v.checked){
                    $scope.evaluation[v.id] = 0;
                    document.getElementById(v.id).disabled = true;
                }else{
                    $scope.evaluation[v.id] = 0;
                    document.getElementById(v.id).disabled = false;
                }
            }
            
            $scope.maxSection = function(section){
                var total = 0;
                var criWeight = 0;

                for(var i in $scope.data.criteria){
                    var cri = $scope.data.criteria[i];
                    if(cri.sid == section.id){
                        criWeight += cri.weight;
                        total += cri.max * cri.weight;
                    }
                }

                if (section.weight > 0) {
                    return total;
                } else {
                    return total / criWeight;
                }
            };

            $scope.subtotalSection = function(section){
                var total = 0;
                var na = $scope.evaluation.na ?? [];
                var totalWeight = 0;
                if($scope.data.sections.length == 1){
                    for(var i in $scope.data.criteria){
                        var cri = $scope.data.criteria[i];
                        if((Object.keys(na) > 0 && na[cri.id]) || ($scope.evaluation[cri.id] == undefined) || Number.isNaN($scope.evaluation[cri.id])){
                            continue;
                        }
                        total += $scope.evaluation[cri.id] * cri.weight;
                        totalWeight += cri.weight;
                    }
                    
                    return total / totalWeight;
                };
                for(var i in $scope.data.criteria){
                    var cri = $scope.data.criteria[i];
                    if((cri.sid == section.id) && ($scope.evaluation[cri.id] != undefined) && !Number.isNaN($scope.evaluation[cri.id])){
                        total += $scope.evaluation[cri.id] * cri.weight;
                    }
                }
                return total;
            };

            $scope.total = function(){
                var total = 0;
                var totalWeight = 0;

                for(var sec in $scope.data.sections){
                    var section = $scope.data.sections[sec];

                    if (typeof section.categories != 'undefined' && section.categories.indexOf($scope.data.registrationCategory) == -1) {
                        continue;
                    }
                    
                    var subtotal = $scope.subtotalSection(section);
                    var sectionWeight = parseFloat(section.weight);
                    
                    if (sectionWeight > 0) {
                        totalWeight += sectionWeight;
                        subtotal = subtotal * sectionWeight;
                    }

                    total += subtotal;
                }

                if (totalWeight) {
                    total = total / totalWeight;
                }                

                return total.toFixed(2);
            };

            $scope.max = function(){
                var total = 0;
                var totalWeight = 0;
                var na = $scope.evaluation.na ?? [];
                
                if($scope.data.sections.length == 1){
                    for(var i in $scope.data.criteria){
                        var cri = $scope.data.criteria[i];
                        if(Object.keys(na) > 0 && na[cri.id]){
                            continue;
                        }
                        total += cri.max * cri.weight;
                        totalWeight += cri.weight;
                    }
                    return (total / totalWeight).toFixed(2);
                };

                for(var sec in $scope.data.sections){
                    var section = $scope.data.sections[sec];

                    if (typeof section.categories != 'undefined' && section.categories.indexOf($scope.data.registrationCategory) == -1) {
                        continue;
                    }

                    var subtotal = $scope.maxSection(section);

                    var sectionWeight = parseFloat(section.weight);

                    if (sectionWeight > 0) {
                        totalWeight += sectionWeight;
                        subtotal = subtotal * sectionWeight;
                    }

                    total += subtotal;
                }

                

                if (totalWeight > 0) {
                    total = total / totalWeight;
                }                

                return total.toFixed(2);
            };

            $scope.checkTotal = function(num) {
                if (isNaN(num))
                    return 0;

                return num.toFixed(1);
            };

            $scope.viabilityLabel = function(val) {
                if ($scope.data.enableViability) {
                    var label = "Inválida";
                    if ("valid" === val)
                        label = "Válida";

                    return label;
                }
            }

            
        }]);
})(angular);