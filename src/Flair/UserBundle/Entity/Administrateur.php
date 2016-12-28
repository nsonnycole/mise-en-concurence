<?php

namespace Flair\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente un administrateur.
 *
 * @ORM\Entity()
 * @ORM\Table(name = "administrateurs")
 */
class Administrateur extends AbstractUtilisateur
{
    /**
     * @var String Le nom de l'administrateur.
     *
     * @ORM\Column(name = "nom", type = "string")
     */
    private $nom;

    /**
     * @return String
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param String $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
}
