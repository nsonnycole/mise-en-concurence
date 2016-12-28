<?php

namespace Flair\OrganismeBundle\Model;

use Flair\CoreBundle\Entity\Categorie;
use Flair\CoreBundle\Entity\Consultation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Modèle d'une consultation.
 *
 * @Assert\Callback( methods = { "isDateLimiteValide" } )
 */
class ConsultationEtape1Model
{
    /**
     * @var String Le titre de la consultation.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $titre;

    /**
     * @var String La description de la consultation.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $description;

    /**
     * @var \DateTime La date limite de la consultation.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $dateLimite;

    /**
     * @var Categorie La catégorie de niveau 1.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $categorieLevelOne;

    /**
     * @var Categorie La catégorie de niveau 2.
     */
    private $categorieLevelTwo;

    /**
     * @var Categorie La catégorie de niveau 3.
     */
    private $categorieLevelThree;

    /**
     * Vérifie si la date limite est bien supérieure à la date du jour.
     */
    public function isDateLimiteValide(ExecutionContextInterface $context)
    {
        $today = new \DateTime();
        $today->setTime(0, 0, 0);

        if ($this->dateLimite < $today) {
            $context->addViolationAt('dateLimite', 'La date limite doit être supérieure à la date du jour');
        }
    }

    /**
     * Setter de la categorie.
     */
    public function setCategorie($categorie)
    {
        if ($categorie->getParent() == null) {
            $this->categorieLevelOne = $categorie;
        } elseif ($categorie->getParent()->getParent() == null) {
            $this->categorieLevelOne = $categorie->getParent();
            $this->categorieLevelTwo = $categorie;
        } else {
            $this->categorieLevelThree = $categorie;
            $this->categorieLevelTwo = $categorie->getParent();
            $this->categorieLevelOne = $categorie->getParent()->getParent();
        }
    }

    /**
     * Retourne la catégorie.
     */
    public function getCategorie()
    {
        if ($this->categorieLevelThree != null) {
            return $this->getCategorieLevelThree();
        }

        if ($this->categorieLevelTwo != null) {
            return $this->getCategorieLevelTwo();
        }

        return $this->categorieLevelOne;
    }

    /**
     * Merge les propriétés de ce modèle avec un organisme existant.
     *
     * @param Consultation $consultation La consultation à mettre à jour
     *
     * @return \Flair\CoreBundle\Entity\Consultation
     */
    public function merge(Consultation $consultation)
    {
        $consultation->setTitre($this->titre);
        $consultation->setDescription($this->description);
        $consultation->setDateLimite($this->getDateLimite());
        $consultation->setCategorie($this->getCategorie());

        return $consultation;
    }

        /**
     * Initialise le modèle à partir d'une consultation.
     *
     * @param Consultation $consultation
     */
    public function initialize(Consultation $consultation)
    {
        $this->setTitre($consultation->getTitre());
        $this->setDescription($consultation->getDescription());
        $this->setDateLimite($consultation->getDateLimite());
        $this->setCategorie($consultation->getCategorie());
    }

    /**
     * Transforme l'object en Organisme.
     */
    public function toConsultation()
    {
        return $this->merge(new Consultation());
    }

    /**
     * @param mixed $categorieLevelOne
     */
    public function setCategorieLevelOne($categorieLevelOne)
    {
        $this->categorieLevelOne = $categorieLevelOne;
    }

    /**
     * @return mixed
     */
    public function getCategorieLevelOne()
    {
        return $this->categorieLevelOne;
    }

    /**
     * @param mixed $categorieLevelThree
     */
    public function setCategorieLevelThree($categorieLevelThree)
    {
        $this->categorieLevelThree = $categorieLevelThree;
    }

    /**
     * @return mixed
     */
    public function getCategorieLevelThree()
    {
        return $this->categorieLevelThree;
    }

    /**
     * @param mixed $categorieLevelTwo
     */
    public function setCategorieLevelTwo($categorieLevelTwo)
    {
        $this->categorieLevelTwo = $categorieLevelTwo;
    }

    /**
     * @return mixed
     */
    public function getCategorieLevelTwo()
    {
        return $this->categorieLevelTwo;
    }

    /**
     * @param mixed $dateLimite
     */
    public function setDateLimite($dateLimite)
    {
        $this->dateLimite = $dateLimite;
    }

    /**
     * @return mixed
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $prixMaximum
     */
    public function setPrixMaximum($prixMaximum)
    {
        $this->prixMaximum = $prixMaximum;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }
}
