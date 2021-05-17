<?php 
$this->layout = 'nolayout'; 
$sub = $app->view->jsObject['subscribers'];
$nameOpportunity = $sub[0]->opportunity->name;
$opp = $app->view->jsObject['opp'];

?>
<table class="table table-striped table-bordered">
    <thead>
    <tr style="background-color: #009353; color:black">
            <th>Classificação</th>
            <th class="space-tbody-15">Inscrição</th>
            <th>Nome</th>
            <th class="text-center space-tbody-10">Nota Def.</th>
    </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($sub as $key => $nameSub): ?>
            <tr>
                <td style="width: 10%" class="text-center">
                    <?php echo ($key+1); ?>
                </td>
                <td class="space-tbody-15">
                    <?php echo $nameSub->number; ?>
                </td>
                <td><?php echo $nameSub->owner->name; ?></td>
                <td class="text-center space-tbody-10"><?php echo $nameSub->consolidatedResult; ?></td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>
