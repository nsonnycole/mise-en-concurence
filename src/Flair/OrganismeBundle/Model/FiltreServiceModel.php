<?php

namespace Flair\OrganismeBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;

class FiltreServiceModel
{
    /**
     * @var StatusOrganisme Le statut sur lequel filtrer.
     */
    private $statut;

    /**
     * Valeur par defaut.
     */
    public function __construct()
    {
        $this->exclusive = true;
    }

    /**
     * @param String statut Le statut du prestataire.
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return String statut Le statut du prestataire.
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
