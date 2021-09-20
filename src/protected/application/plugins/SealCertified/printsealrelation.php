<?php
$plugin = $app->plugins['SealCertified'];
?>
<style>
    .img-header {
        flex: 1;
        width: 90%;
        margin: auto;
    }
</style>
<div class="center">
    <div  class="img-header">
    <img src="<?php $view->asset('img/meu-certificado--bg.jpg') ?>"/>
    </div>
    <div style="width: 80%; margin: auto;">
    <p style="margin-top: 35px; text-align: center; font-size: 10px;">
        <?php echo $relation->seal->shortDescription; ?>
    </p>
    </div>
   
    <div style="margin-top: 35px; text-align: center; width: 80%; margin: auto;">
       
        <?php echo $relation->seal->longDescription; ?>
        <p>
        <?php echo nl2br($msg) ?>
        </p>
    </div>
</div>
