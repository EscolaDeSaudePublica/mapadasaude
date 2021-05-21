<?php 
    $this->layout = 'nolayout'; 
    $contact = $app->view->jsObject['subscribers'];
    $nameOpportunity = $contact[0]->opportunity->name;
?>

<?php include_once('header.php'); ?>
<!-- <table>
<tr>
    <td>
        <br><br><br><br><br><br><br><br><br><br>
    </td>
</tr>
</table> -->
<div class="container">

    <table class="table table-striped table-bordered">
        <thead>
            <tr style="background-color: #009353;">
                <th class="td-classificacao" style="width:20%;border: 1px solid #716e6e; ">Inscrição</th>
                <th class="td-classificacao" style="width:40%; border: 1px solid #716e6e;">Nome</th>
                <th class="td-classificacao" style="width:40%; border: 1px solid #716e6e;">E-mail</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <?php foreach ($contact as $key => $value) {
                //$agent = $app->repo('Agent')->find($value->owner->id); 
        ?>
        <tr>
            <td class="td-classificacao" >
                <?php echo $value->number; ?>
            </td>
            <td class="td-classificacao " >
                <?php echo $value->owner->name; ?>
            </td>
            <td>
                <?php 
                    if(!isset($value->owner->metadata['emailPrivado']))
                    {
                        echo "";
                    }
                    else
                    {
                        echo $value->owner->metadata['emailPrivado'];
                    }
                ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php include_once('footer.php'); ?>