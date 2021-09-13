if(MapasCulturais.evaluationConfiguration && MapasCulturais.evaluationConfiguration.sections){
    MapasCulturais.evaluationConfiguration.sections = MapasCulturais.evaluationConfiguration.sections.map(function(e){
        e.weight = parseFloat(e.weight);
        return e;
    });
}