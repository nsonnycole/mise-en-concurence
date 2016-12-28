<?php

namespace Flair\CoreBundle\Events\Consultation;

use Flair\CoreBundle\Entity\Consultation;

use Symfony\Component\EventDispatcher\Event;

class ReponseSelectedEvent extends Event
{
    /**
     * @var Consultation La réponse.
     */
    private $consultation;

    /**
     * Injection de la réponse.
     */
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Reponse $consultation
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
