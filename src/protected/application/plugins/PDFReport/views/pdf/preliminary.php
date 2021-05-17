<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
    $claimDisabled = $app->view->jsObject['claimDisabled'];
?>
<script>
$(document).ready(function () {
    window.print();
});
</script>
<div class="container">
    <?php include_once('header.php'); ?>
    <table width="100%">
        <tr class="text-center">
            <td>
                <h4><?php echo $app->view->jsObject['title']; ?></h4>
            </td>
        </tr>
        <tr class="text-center">
            <td><?php echo $nameOpportunity; ?></td>
        </tr>
    </table>
    <br>
    <?php 
        //REDIRECIONA PARA OPORTUNIDADE CASO NÃO HAJA CATEGORIA        
        $type = $opp->evaluationMethodConfiguration->type->id;
        //QUANDO NÃO TIVER RECURSO OU ESTIVER DESABILITADO
        if($opp->registrationCategories == "" &&  $type == 'technical'){
            include_once('preliminary/technical-no-category.php');
        }elseif($opp->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('preliminary/simple-documentary-no-category.php');
        }

        if($opp->registrationCategories !== "" &&  $type == 'technical'){
            $preliminary = true;
            include_once('technical-category.php');
        }elseif($opp->registrationCategories !== "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('preliminary/simple-documentary-category.php');
        }
    ?>
</div>
<?php 
   // die;
    ?>