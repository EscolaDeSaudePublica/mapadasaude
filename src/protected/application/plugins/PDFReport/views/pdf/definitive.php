<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]['nameopportunity'];
    $opp = $app->view->jsObject['opp'];
    $verifyResource = $this->verifyResource($this->postData['idopportunityReport']);
    $claimDisabled = $app->view->jsObject['claimDisabled'];
   
?>
<style>
.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.text-center {
    text-align: center;
}
</style>
<div class="container">
    <table width="100%" >
        <thead>
            <tr class="text-center">
                <td>
                    <img src="https://mapadasaude.dev.org.br/assets/img/logo_escola_estado.png" style="width: 400px;"/>
                </td>
            </tr>
            <tr class="text-center">
                <td>
                    <h4 style="margin-top: 15px;"><?php echo $app->view->jsObject['title']; ?></h4>
                </td>
            </tr>
            <tr class="text-center">
                <td><h5 style="margin-top: 10px;"><?php echo $nameOpportunity; ?></h5></td>
            </tr>
        </thead>
    </table>
    <?php 
        //REDIRECIONA PARA OPORTUNIDADE CASO NÃO HAJA CATEGORIA        
        $type = $opp->evaluationMethodConfiguration->type->id;
        //NAO TEM RECURSO OU DESABILITADO
        if(empty($claimDisabled) || $claimDisabled == 1) {
            // dump('dd');
            //   dump($claimDisabled);
            //   dump($type);
            //   dump($opp->registrationCategories);
            //   die;
            // nao tem categoria, tecnica e nao tem recurso 
            if($opp->registrationCategories == "" &&  $type == 'technical'){
                include_once('technical-no-category.php');
            }elseif($opp->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary'){
                include_once('simple-documentary-no-category.php');
            }
            // tem categoria, tecnica e nao tem recurso
            if($opp->registrationCategories !== "" &&  $type == 'technical' ){
                $preliminary = false;
                include_once('technical-category.php');
            }elseif($opp->registrationCategories !== "" &&  $type == 'simple' || $type == 'documentary'){
                include_once('simple-documentary-category.php');
            }
        }else 
        //SE TIVER RECURSO
        if($sub[0]->canUser('sendClaimMessage')){
           

            // if($opp->registrationCategories !== "" &&  $type == 'technical'){
            //     include_once('technical-category.php');
            // }
            
        }
        
        
        // if($opp->registrationCategories == "" && $type == 'technical'){
        //     include_once('defSimpleNoCat.php');
        // }
        // else{
        //     include_once('defSimpleWithCat.php');
        // }

    ?>
</div>
<?php //include_once('footer.php'); ?>
