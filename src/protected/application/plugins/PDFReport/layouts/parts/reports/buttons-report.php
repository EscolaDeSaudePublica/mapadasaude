<!--botão de imprimir-->
<!-- <a class="btn btn-default" title="Imprimir Resultado Documental"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-text-o" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Tecnica"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-align-justify" aria-hidden="true"></i>
</a>
<a class="btn btn-default" title="Imprimir Resultado Simiples"  ng-click="editbox.open('report-evaluation-documental-options', $event)" rel="noopener noreferrer">
    <i class="fa fa-file-o" aria-hidden="true"></i>
</a> -->
<?php 
$entity = $this->controller->requestedEntity;
?>
<div>
    <hr>
    <form action="<?php echo $app->createUrl('pdf/gerarPdf'); ?>" method="POST" target="TargetWindow">
    <label class="label">Filtrar Relatório</label>
        
        <div id="divSelectTiebreaker" ng-controller="PdfReportController">
            <label for="">Tipo de relatório:</label>
            <select name="selectRel" id="selectRel" class="" style="margin-left: 10px;" ng-model="filterReport" ng-change="changeFilterReport()">
            <option value="" disabled selected> -- Selecione -- </option>
            <option value="1">Relação de Inscritos</option>
            <?php if($resource): ?>
                <option value="2">Resultados preliminares</option>
            <?php endif; ?>
            <option value="3">Resultados definitivos</option>
            <option value="4">Relação de contatos</option>
            
            </select>
            <br />
            <label for="">Critério de desempate:</label> <br>
               <select name="" id="selectTiebreaker" class="form-control show-select" ng-model="alter" ng-change="change()">
                    <option value="" disabled selected> -- Escolha seu critério de desempate -- </option>
                    <option ng-repeat="opt in options" value="{{opt.value}}">
                        {{opt.label}}
                </select>
                <div id="orderTiebreaker" class="show-select">
                    <label>Ordem de desempate: </label> <br />
                </div>
                <div id="infoMomentOpportunity">
                    <div style="margin-left: 5px; margin-bottom: 5px; border: 1px solid #c3c3c3; border-radius: 5px; padding-left: 5px;">
                        <span>Agora escolha o momento:</span>
                        <p>
                            <ul style="list-style-type: none; margin: 0; padding: 0;">
                                <li> 
                                    <input type="radio" name="moment" id="" checked> 
                                        <span  style="color: #676363;"> Coffee</span>
                                </li>
                                <li><input type="radio" name="moment" id=""> <span  style="color: #676363;"> Tea</span> </li>
                                <li><input type="radio" name="moment" id=""><span  style="color: #676363;"> Milk</span> </li>
                            </ul>
                        </p>
                    </div>
                </div>
        </div>
        </div>
        <input type="hidden" id="idopportunityReport" name="idopportunityReport" value="<?php echo $entity->id; ?>">
        <button type="submit">Gerar Relatório <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
    </form>

</div>
<div>

    <?php 
        
        $entity->id;
        $url = $app->createUrl('oportunidade/'.$entity->id);
        if(isset($_SESSION['error']))
        {
            echo '<hr><div class="alert danger">'.$_SESSION['error'].'<a href="'.$url.'" class="alignright"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
        }
        unset($_SESSION['error']);
    ?>
</div>