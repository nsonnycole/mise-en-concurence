<?php

namespace Flair\UserBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model pour le changement de mot de passe.
 */
class Motdepasse
{
    /**
     * @var String Le nouveau mot de passe.
     *
     * @Assert\NotBlank
     */
    private $motdepasse;

    /**
     * @param String $motdepasse
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

    /**
     * @return String
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }
}
