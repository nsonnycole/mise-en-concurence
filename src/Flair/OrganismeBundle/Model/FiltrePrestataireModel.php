<?php

namespace Flair\OrganismeBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;

class FiltrePrestataireModel
{
    /**
     * @var CategoriePrestataire La categorie sur laquelle filtrer.
     */
    private $categorie;

    /**
     * Valeur par defaut.
     */
    public function __construct()
    {
        $this->exclusive = true;
    }

    /**
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire.
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
