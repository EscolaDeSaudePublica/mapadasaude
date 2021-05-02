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
?>
<div>
    <hr>
    <form action="<?php echo $app->createUrl('pdf/gerarPdf'); ?>" method="POST" target="TargetWindow">
    <label class="label">Filtrar Relatório</label>
        <select name="selectRel" id="selectRel" class="" style="margin-left: 10px;">
            <option value="0">--Selecione--</option>
            <option value="1">Relação de Inscritos</option>
            <?php if($resource): ?>
                <option value="2">Resultados preliminares</option>
            <?php endif; ?>
            <option value="3">Resultados definitivos</option>
            <option value="4">Relação de contatos</option>
        </select>
        <input type="hidden" id="idopportunityReport" name="idopportunityReport">
        <button type="submit">Gerar Relatório <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
    </form>
</div>
<div>

    <?php 
        $entity = $this->controller->requestedEntity;
        $url = $app->createUrl('oportunidade/'.$entity->id);
        if(isset($_SESSION['error']))
        {
            echo '<hr><div class="alert danger">'.$_SESSION['error'].'<a href="'.$url.'" class="alignright"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
        }
        unset($_SESSION['error']);
    ?>
</div>