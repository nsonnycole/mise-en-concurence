<?php

namespace Flair\PrestataireBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;

/**
 * Represente les filtres possibles sur les propositions.
 */
class FiltrePropositionModel
{
    /**
     * @var Organisme Le nom de l'organisme.
     */
    private $organisme;

    /**
     * @var \DateTime La date de debut.
     */
    private $dateDebut;

    /**
     * @var \DateTime La date de fin.
     */
    private $dateFin;

    /**
     * @var integer Le seuil bas du montant de la consultation.
     */
    private $montantMin;

    /**
     * @var integer Le seuil haut du montant de la consultation.
     */
    private $montantMax;

    /**
     * @var String Le statut de la réponse.
     */
    private $statut;

    /**
     * @var Prestataire Le prestataire.
     */
    private $prestataire;

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
     * @param int $montantMax
     */
    public function setMontantMax($montantMax)
    {
        $this->montantMax = $montantMax;
    }

    /**
     * @return int
     */
    public function getMontantMax()
    {
        return $this->montantMax;
    }

    /**
     * @param int $montantMin
     */
    public function setMontantMin($montantMin)
    {
        $this->montantMin = $montantMin;
    }

    /**
     * @return int
     */
    public function getMontantMin()
    {
        return $this->montantMin;
    }

    /**
     * @param \Flair\UserBundle\Entity\Organisme $organisme
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;
    }

    /**
     * @return \Flair\UserBundle\Entity\Organisme
     */
    public function getOrganisme()
    {
        return $this->organisme;
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

    /**
     * @param \Flair\UserBundle\Entity\Prestataire $prestataire
     */
    public function setPrestataire($prestataire)
    {
        $this->prestataire = $prestataire;
    }

    /**
     * @return \Flair\UserBundle\Entity\Prestataire
     */
    public function getPrestataire()
    {
        return $this->prestataire;
    }
}
