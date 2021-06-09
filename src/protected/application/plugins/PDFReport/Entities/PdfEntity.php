<?php
namespace PDFReport\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use MapasCulturais\App;
use MapasCulturais\Entities\Opportunity;

/**
 * PdfEntity
*/
class PdfEntity extends \MapasCulturais\Entity{

    //RETORNA A ORDEM QUE ESTÁ NO BANCO
    public static function getOrderTiebreaker($opportunity) {
        $app = App::i();
        // $all = $app->em->getConnection()->fetchAll("SELECT * FROM resources r WHERE r.opportunity_id = {$opportunity} ");
        // return $all;
        $opMeta = $app->repo('OpportunityMeta')->findBy([
            'owner' => $opportunity,
            'key'   => 'tiebreaker'
        ]);
        $tiebreaker = [];
        foreach ($opMeta as $key => $tie) {
            array_push($tiebreaker, $tie->value);
        }
        $orderBy = '';
        foreach ($tiebreaker as $key => $value) {
            if($value == 1) {
                $orderBy .= ' idade > 60, ';
            }
            if($value == 2) {
                $orderBy .= ' nota > momento, ';
            }
            if($value == 3) {
                $orderBy .= ' dataDeNascimento, ';
            }
            if($value == 4) {
                $orderBy .= ' jurado, ';
            }
        }
        return $orderBy;
        // return $tiebreaker;
        // $comma_separated = implode(",", $tiebreaker);
        // echo $comma_separated;
        // echo "SELECT value FROM category_meta cm WHERE cm.object_id in ({$comma_separated}) AND key = 'criterio_desempate'";
        // $all = $app->em->getConnection()->fetchAll("SELECT value FROM category_meta cm WHERE cm.object_id in ({$tiebreaker}) ");
        // dump($all);
    }

    public static function getDefinitive($id) {
        $app = App::i();
        $definitive = $app->em->getConnection()->fetchAll("select distinct r.id, op.published_registrations, r.category, r.consolidated_result, r.agent_id, a.name as nome, 
        (SELECT ag.value FROM agent_meta ag where ag.key = 'dataDeNascimento' and a.id = ag.object_id) as datanascimento,
        (SELECT ag.value FROM agent_meta ag where ag.key = 'idade' and a.id = ag.object_id) as idade
        FROM registration r 
        INNER JOIN agent a 
            ON r.agent_id = a.id
        INNER JOIN agent_meta am
            ON r.agent_id = am.object_id
        INNER JOIN opportunity op
            ON r.opportunity_id = op.id
            WHERE r.opportunity_id = {$id} AND r.status = 10 AND op.published_registrations = false
        order by r.category asc , r.consolidated_result desc");
        return $definitive;
    }

}