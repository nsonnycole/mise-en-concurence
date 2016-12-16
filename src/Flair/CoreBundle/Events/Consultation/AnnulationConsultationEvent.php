<?php

namespace Flair\CoreBundle\Events\Consultation;

use Flair\CoreBundle\Entity\Consultation;
use Symfony\Component\EventDispatcher\Event;

/**
 * La consultation a ete annulé.
 */
class AnnulationConsultationEvent extends Event
{
    /**+
     * @var Consultation La consultation qui a ete annulée.
     */
    private $consultation;

    /**
     * @param Consultation $consultation
     */
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Consultation $consultation
     */
    public function setConsultation($consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }
}
