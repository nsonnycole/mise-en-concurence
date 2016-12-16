<?php

namespace Flair\OrganismeBundle\Model;

use Flair\CoreBundle\Entity\Consultation;
use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Correspond aux informations de l'etape 2 de la creation d'une consultation.
 * C'est à dire les critères d'evaluation d'une demande.
 *
 * @Assert\Callback(
 *      methods = { "isPrixValide", "isDebutValide", "isFinValide", "areDateValide" }
 * )
 */
class ConsultationEtape2Model
{
    /**
     * @var integer Le bas de la fourchette de prix estimé.
     */
    private $prixMinimum;

    /**
     * @var integer Le haut de la fourchette de prix estimée.
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
     * @var \DateTime La date limite ne sert que pour la validation des autres dates.
     */
    private $dateLimite;

    /**
     * @var String L'experience requise.
     */
    private $experienceRequise;

    /**
     * @var Boolean Si oui ou non, une qualification particulière est demandée pour répondre
     */
    private $certificationRequise;

    /**
     * @var String La certification nécessaire pour répondre à la demande
     */
    private $certifications;

    /**
     * Initialisation de la valeur par defaut pour le champs qualification.
     */
    public function __construct()
    {
        $this->certificationRequise = false;
    }

    /**
     * Merge une consultation avec une ce modele.
     *
     * @param Consultation $consultation
     *
     * @return \Flair\CoreBundle\Entity\Consultation
     */
    public function merge(Consultation $consultation)
    {
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
        $this->setPrixMinimum($consultation->getPrixMinimum());
        $this->setPrixMaximum($consultation->getPrixMaximum());
        $this->setPeriodeDebut($consultation->getPeriodeDebut());
        $this->setDateDebut($consultation->getDateDebut());
        $this->setPeriodeLivraison($consultation->getPeriodeLivraison());
        $this->setDateLivraison($consultation->getDateLivraison());
        $this->setExperienceRequise($consultation->getExperienceRequise());
        $this->setCertificationRequise($consultation->getCertificationRequise());
        $this->setCertifications($consultation->getCertifications());
        $this->setDateLimite($consultation->getDateLimite());
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
     * @param mixed $prixMaximum
     */
    public function setPrixMaximum($prixMaximum)
    {
        $this->prixMaximum = $prixMaximum;
    }

    /**
     * @return mixed
     */
    public function getPrixMaximum()
    {
        return $this->prixMaximum;
    }

    /**
     * @param mixed $prixMinimum
     */
    public function setPrixMinimum($prixMinimum)
    {
        $this->prixMinimum = $prixMinimum;
    }

    /**
     * @return mixed
     */
    public function getPrixMinimum()
    {
        return $this->prixMinimum;
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
}
