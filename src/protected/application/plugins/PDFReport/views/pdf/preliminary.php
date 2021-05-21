<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
    $claimDisabled = $app->view->jsObject['claimDisabled'];
?>
<div class="container">
    <?php include_once('header.php'); ?>
    <?php 
        //REDIRECIONA PARA OPORTUNIDADE CASO NÃO HAJA CATEGORIA        
        $type = $opp->evaluationMethodConfiguration->type->id;
        //QUANDO NÃO TIVER RECURSO OU ESTIVER DESABILITADO
        if($opp->registrationCategories == "" &&  $type == 'technical'){
            include_once('technical-no-category.php');
        }elseif($opp->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('simple-documentary-no-category.php');
        }

        if($opp->registrationCategories !== "" &&  $type == 'technical'){
            $preliminary = true;
            include_once('technical-category.php');
        }elseif($opp->registrationCategories !== "" &&  $type == 'simple'|| $type == 'documentary'){
            include_once('simple-documentary-category.php');
        }
    ?>
</div>
<?php include_once('footer.php'); ?>