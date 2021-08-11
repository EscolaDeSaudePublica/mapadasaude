<?php 
// Para ocultar a aba oportunidade
if($entity instanceof \MapasCulturais\Entities\Project) {
    $entity->useOpportunityTab = 'false';
}else {
    $entity->useOpportunityTab = null;
}

if($entity->opportunities && ($entity->useOpportunityTab !== 'false')): ?>
    <li><a href="#entity-opportunities" rel='noopener noreferrer'><?php echo $entity->opportunityTabName ? $entity->opportunityTabName : \MapasCulturais\i::__("Oportunidades");?></a></li>
<?php endif; ?>