<?php

namespace Flair\OrganismeBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;

/**
 * Filtre sur les consultations.
 */
class FiltreConsultationModel
{
    /**
     * @var CategoriePrestataire La catégorie de la consultation.
     */
    private $categorie;

    /**
     * @var \DateTime La date de début.
     */
    private $dateDebut;

    /**
     * @var \DateTime La date de fin.
     */
    private $dateFin;

    /**
     * @var String La liste des statuts.
     */
    private $statut;

    /**
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param String $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return String
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
