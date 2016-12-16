<?php

namespace Flair\UserBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Flair\UserBundle\Validator\ExistingEmail;

/**
 * Demande de reset de mot de passe.
 */
class MotdepasseOublie
{
    /**
     * @var String L'adresse email de l'utilisateur.
     *
     * @Assert\NotBlank
     * @Assert\Email
     * @ExistingEmail
     */
    private $email;

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
}
