<?php

namespace Flair\CoreBundle\Events\Consultation;

use Flair\CoreBundle\Entity\Consultation;
use Flair\UserBundle\Entity\Prestataire;
use Flair\CoreBundle\Entity\Reponse;
use Symfony\Component\EventDispatcher\Event;

/**
 * Les information de la diffusion.
 */
class DiffusionConsultationEvent extends Event
{
    /**
     * @var Consultation La consultation sur laquelle a ete invité le prestataire.
     */
    private $consultation;

    /**
     * @var Prestataire La prestataire qui a été invité.
     */
    private $prestataire;

    /**
     * @var Reponse La reponse du prestataire.
     */
    private $reponse;

    /**
     *
     */
    public function __construct(Consultation $consultation, Prestataire $prestataire, Reponse $reponse)
    {
        $this->consultation = $consultation;
        $this->prestataire = $prestataire;
        $this->reponse = $reponse;
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

    /**
     * @param \Flair\UserBundle\Entity\Prestataire $prestataire
     */
    public function setPrestataire($prestataire)
    {
        $this->prestataire = $prestataire;
    }

    /**
     * @return \Flair\UserBundle\Entity\Prestataire
     */
    public function getPrestataire()
    {
        return $this->prestataire;
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
