<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    // dump($sub);
    // dump($opp->registrationCategories);
    $nameOpportunity = $sub[0]['nameopportunity'];
    $opp = $app->view->jsObject['opp'];
    
    ?>
<style>
    .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    }
    .table {
        background-color: transparent;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        border-collapse: collapse;
    }
    .activeTr{
    /* background-color: #c3c3c3; */
    /* border: 1px solid black; */
        margin-top: 10px;
        color: saddlebrown;
        border-radius: 5px;
    }
    .th-right{
        float: left;
        margin-left: 5px;
        color:#3C3939;
    /* width: 300%; */
    }
    .td-classificacao {
    width: 10%;  
    /* border-bottom: 1px solid black */
    }
    .space-tbody-15 {
    width: 20%;
    }
    .space-tbody-10 {
    width: 15%;
    }
    tr.border_bottom td {
    border-bottom: 1px solid black;
    }
    .border-right-white {
    border-right: 1px solid #ffffff;
    }
    .table-border {
        border: 1px solid #716e6e;
    }
</style>
</style>
<div class="container">
    <?php 
        foreach ($opp->registrationCategories as $key => $nameCat) :?>
    <table class="table">
        <thead>
            <tr class="activeTr">
                <th colspan="4" style="border: 1px solid #716e6e; background: #E8E2E2;">
                    <label class="">
                    <?php echo $nameCat; ?>
                    </label>
                </th>
                <br>
            </tr>
            <tr style="background-color: #009353; color:white;">
                <th style="width: 10%;" class="text-center border-right-white ">
                    Classifi.
                </th>
                <th class="space-tbody-15 td-classificacao border-right-white " style="width: 20%;">
                    Inscrição
                </th>
                <th class="td-classificacao border-right-white" style="width: 50%;">
                    Nome
                </th>
                <?php if($preliminary) : ?>
                <th class="text-center space-tbody-10 td-classificacao border-right-white" style="width: 10%;">Nota</th>
                <?php 
                endif;
                    if($preliminary == false) :
                ?>
                <th class="text-center space-tbody-10 td-classificacao border-right-white " style="width: 10%;">Nota Def.</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                $isExist = false;
                $classification = 0;
                //LOOP NOS CANDIDATOS
                foreach ($sub as $key => $nameSub):
                    //SE AS CATEGORIAS FOREM IGUAIS, IMPRIME AS INFORMAÇÕES
                    if(strtoupper($nameCat) == strtoupper($nameSub['category'])):
                ?>
            <tr class="border_bottom">
                <td class="text-center td-classificacao">
                    <?php 
                        //A CADA LOOP A CLASSIFICAÇÃO RECEBE, ELE MESMO +1
                            $classification = ($classification + 1);
                            echo $classification;
                        ?>
                <td class="space-tbody-15 td-classificacao text-center">
                    <?php echo $nameSub['id']; ?>
                </td>
                <td class="td-classificacao" >
                    <span style="margin-left: 5px;">
                        <?php echo $nameSub['nome']; ?>
                    </span>
                </td>
                <td class="text-center space-tbody-10 td-classificacao">
                    <?php 
                        if($preliminary){
                            echo $nameSub['preliminaryResult'];
                        }else{
                            echo $nameSub['consolidated_result'];
                        }; 
                    ?>
                </td>
            </tr>
            <?php
                //EXCLUINDO O INDICE DO ARRAY PARA O PROXIMO LOOP
                unset($sub[$key]);
                    endif;
                    //SE NÃO EXISTIR REGISTRO NO INDICE DO ARRAY ENTÃO ALTERA PARA TRUE
                    if(!isset($nameSub->id)):
                        $isExist = true;
                    endif;
                endforeach;
                //SE FOR FALSO - IMPRIME A INFORMAÇÃO
                if(!$isExist) :?>
            <tr>
                <td colspan="4"><?php \MapasCulturais\i::_e("Não houve candidato selecionado nessa categoria");?></td>
            </tr>
            <?php    
                endif;
                ?>
        </tbody>
    </table>
    <?php endforeach; ?>
</div>
<?php 
    //die;
    ?>