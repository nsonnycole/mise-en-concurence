<?php

namespace Flair\CoreBundle\Events\Consultation;

use Flair\CoreBundle\Entity\Reponse;
use Symfony\Component\EventDispatcher\Event;

class NewReponseConsultationEvent extends Event
{
    /**
     * @var Reponse La reponse.
     */
    private $reponse;

    /**
     * Initialisation des variables.
     */
    public function __construct(Reponse $reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Reponse $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Reponse
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}
