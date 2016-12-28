<?php

namespace Flair\UserBundle\Events\Invitation;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Symfony\Component\EventDispatcher\Event;

/**
 * Contient les informations qui ont été acceptés.
 */
class InvitationAccepte extends Event
{
    /**
     * @var AbstractUtilisateur Le prestataire invité.
     */
    private $receiver;

    /**
     * @var AbstractUtilisateur L'organisme a l'origine de l'invitation.
     */
    private $sender;

    /**
     * Initialisation des informations.
     */
    public function __construct(AbstractUtilisateur $receiver, AbstractUtilisateur $sender)
    {
        $this->receiver = $receiver;
        $this->sender = $sender;
    }

    /**
     * @param \Flair\UserBundle\Entity\AbstractUtilisateur $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return \Flair\UserBundle\Entity\AbstractUtilisateur
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param \Flair\UserBundle\Entity\AbstractUtilisateur $prestataire
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return \Flair\UserBundle\Entity\AbstractUtilisateur
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
