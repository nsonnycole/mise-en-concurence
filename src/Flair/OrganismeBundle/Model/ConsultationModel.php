<?php

namespace Flair\OrganismeBundle\Model;

use Flair\UserBundle\Entity\CategoriePrestataire;
use Flair\CoreBundle\Entity\Consultation;

use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Représente une consultation avec les règles de validation.
 *
 * @Assert\Callback(
 *      methods = { "isDateLimiteValide", "isPrixValide", "isDebutValide", "isFinValide", "areDateValide" }
 * )
 */
class ConsultationModel
{
    /**
     * @var string Le titre de la consultation.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $titre;

    /**
     * @var string A description for the request.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $description;

    /**
     * @var CategoriePrestataire Catégorie de niveau 1.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $categorieLevelOne;

    /**
     * @var CategoriePrestataire Catégorie de niveau 2.
     */
    private $categorieLevelTwo;

    /**
     * @var CategoriePrestataire Catégorie de niveau 3.
     */
    private $categorieLevelThree;

    /**
     * @var \DateTime La date de cloture de la mise en concurrence.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $dateLimite;

    /**
     * @var float The request min price.
     */
    private $prixMinimum;

    /**
     * @var float The request max price.
     */
    private $prixMaximum;

    /**
     * @var String La période de début de projet souhaité
     */
    private $periodeDebut;

    /**
     * @var String La date de livraison du projet souhaité.
     */
    private $periodeLivraison;

    /**
     * @var \DateTime La date de début de la prestatation.
     */
    private $dateDebut;

    /**
     * @var \DateTime La date de livrasion souhaitée.
     */
    private $dateLivraison;

    /**
     * @var String L'experience requise.
     */
    private $experienceRequise;

    /**
     * @var Boolean Si oui ou non, une qulification particulière est demandé pour répondre
     */
    private $certificationRequise;

    /**
     * @var String La certification nécessaire pour répondre à la demande
     */
    private $certifications;

    /**
     * Retourne la catégorie.
     *
     * @return CategoriePrestataire La catégorie de la consultation.
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
     * Fusion de l'objet avec le model.
     *
     * @param Consultation $consultation
     *
     * @return \Flair\CoreBundle\Entity\Consultation
     */
    public function merge(Consultation $consultation)
    {
        $consultation->setTitre($this->titre);
        $consultation->setDescription($this->description);
        $consultation->setDateLimite($this->getDateLimite());
        $consultation->setCategorie($this->getCategorie());
        $consultation->setPrixMinimum($this->getPrixMinimum());
        $consultation->setPrixMaximum($this->getPrixMaximum());
        $consultation->setPeriodeDebut($this->getPeriodeDebut());
        $consultation->setDateDebut($this->getDateDebut());
        $consultation->setPeriodeLivraison($this->getPeriodeLivraison());
        $consultation->setDateLivraison($this->getDateLivraison());
        $consultation->setExperienceRequise($this->getExperienceRequise());
        $consultation->setCertificationRequise($this->getCertificationRequise());
        $consultation->setCertifications($this->getCertifications());

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
        $this->setPrixMinimum($consultation->getPrixMinimum());
        $this->setPrixMaximum($consultation->getPrixMaximum());
        $this->setDateLimite($consultation->getDateLimite());
        $this->setCategorie($consultation->getCategorie());
        $this->setPeriodeDebut($consultation->getPeriodeDebut());
        $this->setDateDebut($consultation->getDateDebut());
        $this->setPeriodeLivraison($consultation->getPeriodeLivraison());
        $this->setDateLivraison($consultation->getDateLivraison());
        $this->setExperienceRequise($consultation->getExperienceRequise());
        $this->setCertificationRequise($consultation->getCertificationRequise());
        $this->setCertifications($consultation->getCertifications());
    }

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
     * Vérifie que si le prix min est saisie alors le prix max doit être saisie également.
     */
    public function isPrixValide(ExecutionContextInterface $context)
    {
        if ($this->prixMinimum != null || $this->prixMaximum != null) {
            if ($this->prixMinimum == null || $this->prixMaximum == null) {
                $context->addViolationAt(
                    'prixMinimum',
                    'Veuillez renseigner à la fois le prix minimum et le prix maximum',
                    array(),
                    null
                );
                return;
            }
        }

        if ($this->prixMinimum > $this->prixMaximum) {
            $context->addViolationAt(
                'prixMinimum',
                'Le prix minimum ne peut être supérieur au prix maximum',
                array(),
                null
            );
        }
    }

    /**
     * Vèrifie que la date de debut de projet est valide.
     */
    public function isDebutValide(ExecutionContextInterface $context)
    {
        if ($this->getPeriodeDebut() != null && $this->getPeriodeDebut() != DisponibiliteChoiceList::ASAP) {
            if ($this->dateDebut == null) {
                $context->addViolationAt('dateDebut', 'La date de début doit être renseignée', array(), null);
            } else {
                $date = $this->dateLimite->format('d/m/Y');

                if ($this->dateDebut < $this->dateLimite) {
                    $context->addViolationAt(
                        'dateDebut',
                        sprintf('La date de début doit être postérieure à la date limite de réponse (%s)', $date),
                        array(),
                        null
                    );
                }
            }
        }
    }

    /**
     * Vérifie que la date de fin est valide.
     */
    public function isFinValide(ExecutionContextInterface $context)
    {
        if ($this->getPeriodeLivraison() != null && $this->getPeriodeLivraison() != DisponibiliteChoiceList::ASAP) {
            if ($this->dateLivraison == null) {
                $context->addViolationAt('dateLivraison', 'La date de fin doit être renseignée', array(), null);
            } else {
                $message = sprintf(
                    'La date de livraison doit être postérieure à la date limite de réponse (%s)',
                    $this->dateLimite->format('d/m/Y')
                );

                if ($this->dateLivraison < $this->dateLimite) {
                    $context->addViolationAt('dateLivraison', $message, array(), null);
                }
            }
        }
    }
    /**
     * Verifie que la date de debut et la date de fin sont coherentes.
     */
    public function areDateValide(ExecutionContextInterface $context)
    {
        if ($this->getDateDebut() != null && $this->getDateLivraison() != null) {
            if ($this->getDateDebut() > $this->getDateLivraison()) {
                $context->addViolationAt(
                    'dateLivraison',
                    'La date de livraison ne peut être inférieure à la date de démarrage',
                    array(),
                    null
                );
            }
        }
    }

    /**
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorieLevelOne
     */
    public function setCategorieLevelOne($categorieLevelOne)
    {
        $this->categorieLevelOne = $categorieLevelOne;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire
     */
    public function getCategorieLevelOne()
    {
        return $this->categorieLevelOne;
    }

    /**
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorieLevelThree
     */
    public function setCategorieLevelThree($categorieLevelThree)
    {
        $this->categorieLevelThree = $categorieLevelThree;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire
     */
    public function getCategorieLevelThree()
    {
        return $this->categorieLevelThree;
    }

    /**
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorieLevelTwo
     */
    public function setCategorieLevelTwo($categorieLevelTwo)
    {
        $this->categorieLevelTwo = $categorieLevelTwo;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire
     */
    public function getCategorieLevelTwo()
    {
        return $this->categorieLevelTwo;
    }

    /**
     * @param \DateTime $dateLimite
     */
    public function setDateLimite($dateLimite)
    {
        $this->dateLimite = $dateLimite;
    }

    /**
     * @return \DateTime
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param float $prixMaximum
     */
    public function setPrixMaximum($prixMaximum)
    {
        $this->prixMaximum = $prixMaximum;
    }

    /**
     * @return float
     */
    public function getPrixMaximum()
    {
        return $this->prixMaximum;
    }

    /**
     * @param float $prixMinimum
     */
    public function setPrixMinimum($prixMinimum)
    {
        $this->prixMinimum = $prixMinimum;
    }

    /**
     * @return float
     */
    public function getPrixMinimum()
    {
        return $this->prixMinimum;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param boolean $certificationRequise
     */
    public function setCertificationRequise($certificationRequise)
    {
        $this->certificationRequise = $certificationRequise;
    }

    /**
     * @return boolean
     */
    public function getCertificationRequise()
    {
        return $this->certificationRequise;
    }

    /**
     * @param String $certifications
     */
    public function setCertifications($certifications)
    {
        $this->certifications = $certifications;
    }

    /**
     * @return String
     */
    public function getCertifications()
    {
        return $this->certifications;
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
     * @param \DateTime $dateLivraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    }

    /**
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * @param String $experienceRequise
     */
    public function setExperienceRequise($experienceRequise)
    {
        $this->experienceRequise = $experienceRequise;
    }

    /**
     * @return String
     */
    public function getExperienceRequise()
    {
        return $this->experienceRequise;
    }

    /**
     * @param String $periodeDebut
     */
    public function setPeriodeDebut($periodeDebut)
    {
        $this->periodeDebut = $periodeDebut;
    }

    /**
     * @return String
     */
    public function getPeriodeDebut()
    {
        return $this->periodeDebut;
    }

    /**
     * @param String $periodeLivraison
     */
    public function setPeriodeLivraison($periodeLivraison)
    {
        $this->periodeLivraison = $periodeLivraison;
    }

    /**
     * @return String
     */
    public function getPeriodeLivraison()
    {
        return $this->periodeLivraison;
    }
}
