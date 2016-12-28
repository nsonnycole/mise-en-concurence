<?php

namespace Flair\OrganismeBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Flair\CoreBundle\Entity\Consultation;

/**
 * Represente la liste de prestataire.
 */
class PublicationModel
{
    /**
     * @var ArrayCollection La liste de prestataires a qui il faut envoyer la consultation.
     */
    private $prestataires;

    /**
     * @var ArrayCollection La liste de prestataires invités.
     */
    private $invitations;

    /**
     * @var Consultation La consultation sur laquelle on veut inviter les pretataires.
     */
    private $consultation;

    /**
     * @var FiltrePrestataireDiffusionModel Le filtre a appliquer si présent.
     */
    private $filtre;

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $prestataires
     */
    public function setPrestataires($prestataires)
    {
        $this->prestataires = $prestataires;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPrestataires()
    {
        return $this->prestataires;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $invitations
     */
    public function setInvitations($invitations)
    {
        $this->invitations = $invitations;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getInvitations()
    {
        return $this->invitations;
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
     * @param \Flair\OrganismeBundle\Model\FiltrePrestataireDiffusionModel $filtre
     */
    public function setFiltre($filtre)
    {
        $this->filtre = $filtre;
    }

    /**
     * @return \Flair\OrganismeBundle\Model\FiltrePrestataireDiffusionModel
     */
    public function getFiltre()
    {
        return $this->filtre;
    }
}
