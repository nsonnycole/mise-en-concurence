<?php

namespace Flair\UserBundle\Events\Inscription;

use Symfony\Component\EventDispatcher\Event;

/**
 * Confirmation de l'email.
 */
class ConfirmationEmail extends Event
{
    /**
     * @var String Le token pour valider.
     */
    private $token;

    /**
     * @var String L'adresse e-mail de l'utilisateur,
     */
    private $email;

    /**
     * Initialisation des informations.
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param String $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return String
     */
    public function getToken()
    {
        return $this->token;
    }
}
