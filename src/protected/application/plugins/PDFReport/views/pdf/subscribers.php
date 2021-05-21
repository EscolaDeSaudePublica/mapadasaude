<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
?>

<div class="container">
    <?php include_once('header.php'); ?>
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
<?php include_once('footer.php'); ?>