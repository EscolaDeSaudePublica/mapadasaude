<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
?>
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
    <table class="table table-striped table-bordered">
        <thead>
            <tr style="background-color: #009353; color:white">
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
                <th><?php echo $value->number; ?></th>
                <td><?php echo $agent->name; ?></td>
                <td><?php echo $value->category; ?></td>
                <td><?php echo $value->sentTimestamp->format('d/m/Y'); ?></td>
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
<?php 
    //die;
    ?>