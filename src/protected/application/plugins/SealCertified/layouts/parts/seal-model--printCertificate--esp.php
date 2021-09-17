<?php 
    if($app->isEnabled('seals') && 
            $relation->seal->seal_model &&
            !$app->user->is('guest') &&
            (   $app->user->is('superAdmin') || 
                $app->user->is('admin') || 
                $app->user->profile->id == $relation->agent->id
            )
        ) {
            
            $this->part('seal-model--printCertificate', ['relation' => $relation]);
    }
?>
<a  id="btn-print-certificate" class="btn btn-default" 
    href="<?php echo $app->createUrl('seal','printsealrelation',[$relation->id]);?>"
    target="_blank">Imprimir Certificado da ESP
</a>
