<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    //Objeto Oportunidade
    $op = $app->view->jsObject['opp'];
    include_once('style.php');  
    //dump($op->ownerEntity->name);
    //
  
    // dump($op->avatar->transform('avatarMedium')->url);
?>

<div class="container">
    <?php //include_once('header.php'); ?>
    <table width="100%" style="height: 100px;">
        <thead>
            <tr class="">
                <td>                   
                    <img src="<?php echo PLUGINS_PATH.'PDFReport/assets/img/logo-saude.png'; ?>" style="float:left;"/>
                    <!-- <img src="<?php $this->asset('img/logo-saude.png') ?>"  class="pull-left" > -->

                </td>
                <td>
                <!-- <img src="<?php $this->asset('img/ESP-CE-ORGAO-SEC-INVERTIDA-WEB2_3.png') ?>" class="pull-right" alt=""> -->
                    <img src="<?php echo PLUGINS_PATH.'PDFReport/assets/img/ESP-CE-ORGAO-SEC-INVERTIDA-WEB2_3.png'; ?>"  style="float:right;"/>
                </td>
            </tr>
        </thead>
    </table>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
            <!-- <img src="<?php echo $op->avatar->url ?>" alt="" style="width: 80px; height: 80px;"> -->
             <img src="<?php echo $op->files['avatar']->path ?>"  style="width: 80px; height: 80px;">
            </div>
            <div class="col-md-10">
                <label for="" class="title-edital">Edital</label><br>
                <label class="sub-title-edital"><?php echo $op->ownerEntity->name; ?></label>
                <br>
                <label for="" class="title-edital">Oportunidade</label><br>
                <label class="sub-title-edital"><?php echo $op->name; ?></label>
            </div>
        </div>
       

    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
        </div>
        <div class="col-md-12">
            <br>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr class ="cert-background" style="background: #009353 !important; color:black">
                <th>Inscrição</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Enviado em</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sub as $key => $value) {
                $agent = $app->repo('Agent')->find($value->owner->id); ?>
            <tr>
                <td class="text-center"><?php echo $value->number; ?></td>
                <td><?php echo $agent->name; ?></td>
                <td><?php echo $value->category; ?></td>
                <td><?php ($value->sentTimestamp == null) ? "" : printf($value->sentTimestamp->format('d/m/Y')); ?></td>
                <td><?php
                    $status = '';
                        switch ($value->status) {
                            case 0:
                                $status = 'Rascunho';
                                break;
                            case 1:
                                $status = 'Pendente';
                                break;
                            case 2:
                                $status = 'Inválido';
                                break;
                            case 3:
                                $status = 'Não aprovado';
                                break;
                            case 8:
                                $status = 'Suplente';
                                break;
                            case 10:
                                $status = 'Selecionado';
                                break;
                        }
                    echo $status;
                    ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php //include_once('footer.php'); ?>