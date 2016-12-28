<?php

namespace Flair\UserBundle\Events\Security;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Symfony\Component\EventDispatcher\Event;

/**
 * Un reset du mot depasse a été demandé.
 */
class MotdepasseOublieEvent extends Event
{
    /**
     * @var AbstractUtilisateur L'utilisateur.
     */
    private $utilisateur;

    /**
     * Injection de l'utilisateur.
     */
    public function __construct($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @param \Flair\UserBundle\Entity\AbstractUtilisateur $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @return \Flair\UserBundle\Entity\AbstractUtilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
