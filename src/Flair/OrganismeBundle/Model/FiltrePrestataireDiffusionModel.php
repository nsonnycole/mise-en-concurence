<?php

namespace Flair\OrganismeBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;

class FiltrePrestataireDiffusionModel
{
    /**
     * @var CategoriePrestataire La categorie sur laquelle filtrer.
     */
    private $categorie;

    /**
     * @var boolean Si oui ou non, le prestataire doit etre un prestataire de l'utilisateur.
     */
    private $exclusive;

    /**
     * @var String La liste des statuts.
     */
    private $statut;

    /**
     * @var Tag tags les tags sur lesquels filtrer.
     */
    private $tags;

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
     * @param boolean $exclusive
     */
    public function setExclusive($exclusive)
    {
        $this->exclusive = $exclusive;
    }

    /**
     * @return boolean
     */
    public function getExclusive()
    {
        return $this->exclusive;
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
     * @param Tag $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return Tag
     */
    public function getTags()
    {
        return $this->tags;
    }
        /**
     * @var PerimetreIntervention
     */
    private $perimetreIntervention;

    /**
     * @param \Flair\CoreBundle\Entity\PerimetreIntervention $perimetreIntervention
     */
    public function setPerimetreIntervention($perimetreIntervention)
    {
        $this->perimetreIntervention = $perimetreIntervention;
    }

    /**
     * @return \Flair\CoreBundle\Entity\PerimetreIntervention
     */
    public function getPerimetreIntervention()
    {
        return $this->perimetreIntervention;
    } 

    /**
     * @var ape
     */
    private $ape;

    /**
     * @param \Flair\UserBundle\Entity\Prestataire $ape
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
    }

    /**
     * @return \Flair\CoreBundle\Entity\PerimetreIntervention
     */
    public function getApe()
    {
        return $this->ape;
    } 
}
