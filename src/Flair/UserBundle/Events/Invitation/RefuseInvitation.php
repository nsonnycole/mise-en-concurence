<?php

namespace Flair\UserBundle\Events\Invitation;

use Flair\UserBundle\Entity\Invitation;
use Symfony\Component\EventDispatcher\Event;

class RefuseInvitation extends Event
{
    /**
     * @var Invitation L'invitation à relancer.
     */
    private $invitation;

    /**
     * @param Invitation $invitation
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * @param \Flair\UserBundle\Entity\Invitation $invitation
     */
    public function setInvitation($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * @return \Flair\UserBundle\Entity\Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
