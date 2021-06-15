<?php
namespace EvaluationMethodTechnical\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use MapasCulturais\App;

/**
 * SectionNoteEvaluation
 * 
 * @ORM\Entity
 * @ORM\Table(name="section_note_evaluation")
*/
class SectionNoteEvaluation extends \MapasCulturais\Entity{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="section_note_evaluation_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", nullable=true)
     */
    protected $result;
    
    /**
     * @var string
     *
     * @ORM\Column(name="evaluation_data", type="string", nullable=true)
     */
    protected $evaluationData;

    /**
     * @var \MapasCulturais\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    protected $user;//É O AVALIADOR

    /**
     * @var \MapasCulturais\Entities\Opportunity
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\Opportunity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="opportunity_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    protected $opportunity;

    /**
     * @var \MapasCulturais\Entities\Registration
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\Registration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registration_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    protected $registration;

    /**
     * @var \MapasCulturais\Entities\Agent
     *
     * @ORM\ManyToOne(targetEntity="MapasCulturais\Entities\Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agent_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    protected $agent;//É QUEM SE INSCREVEU NA OPORTUNIDADE

    static public function getOwner() {
       return "Section";
    }
}
?>