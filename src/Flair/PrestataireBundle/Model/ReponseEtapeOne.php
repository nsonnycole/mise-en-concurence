<?php

namespace Flair\PrestataireBundle\Model;

use Flair\CoreBundle\Entity\Reponse;
use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * L'etape zero de la reponse.
 *
 * @Assert\Callback(
 *      methods = { "isDebutValide", "isLivraisonValide" }
 * )
 */
class ReponseEtapeOne
{
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
     * @var String La réponse.
     */
    private $reponse;

    /**
     * @var String La réponse.
     */
    private $certifications;

    /**
     * Merge une reponse avec une ce modele.
     *
     * @param Reponse $reponse
     *
     * @return \Flair\CoreBundle\Entity\Reponse
     */
    public function merge(Reponse $reponse)
    {
        $reponse->setPeriodeDebut($this->getPeriodeDebut());
        $reponse->setDateDebut($this->getDateDebut());
        $reponse->setPeriodeLivraison($this->getPeriodeLivraison());
        $reponse->setDateLivraison($this->getDateLivraison());
        $reponse->setReponse($this->getReponse());
        $reponse->setCertification($this->getCertifications());

        return $reponse;
    }

    /**
     * Initialise le modèle à partir d'une reponse.
     *
     * @param Reponse $reponse
     */
    public function initialize(Reponse $reponse)
    {
        $this->setPeriodeDebut($reponse->getPeriodeDebut());
        $this->setDateDebut($reponse->getDateDebut());
        $this->setPeriodeLivraison($reponse->getPeriodeLivraison());
        $this->setDateLivraison($reponse->getDateLivraison());
        $this->setReponse($reponse->getReponse());
        $this->setCertifications($reponse->getCertification());
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
     * @param String $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return String
     */
    public function getReponse()
    {
        return $this->reponse;
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
     * @param string $dateLivraison
     */
    public function setCertifications($certifications)
    {
        $this->certifications = $certifications;
    }

    /**
     * @return string
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * Vèrifie que la date de debut de projet est valide.
     */
    public function isDebutValide(ExecutionContextInterface $context)
    {
        if ($this->getPeriodeDebut() != null && $this->getPeriodeDebut() != DisponibiliteChoiceList::ASAP) {
            if ($this->dateDebut == null) {
                $context->addViolationAt('dateDebut', 'La date de début doit être renseignée', array(), null);
                return;
            }
            $today = new \DateTime();
            $today = date_modify($today, '-1 day');
            if ($this->dateDebut < $today) {
                $context->addViolationAt(
                    'dateDebut',
                    'La date de début ne peut pas être inférieure à la date du jour',
                    array(),
                    null
                );
            }
        }
    }

    /**
     * Vérifie que la date de fin est valide.
     */
    public function isLivraisonValide(ExecutionContextInterface $context)
    {
        if ($this->getPeriodeLivraison() != null && $this->getPeriodeLivraison() != DisponibiliteChoiceList::ASAP) {
            if ($this->dateLivraison == null) {
                $context->addViolationAt('dateLivraison', 'La date de livraison doit être renseignée', array(), null);
                return;
            }
            $today = new \DateTime();
            $today = date_modify($today, '-1 day');
            if ($this->dateLivraison < $today || $this->dateLivraison < $this->getDateDebut()) {
                $context->addViolationAt(
                    'dateLivraison',
                    'La date de livraison doit être supérieure à la date de clôture et supérieure ou égale à la date de démarrage',
                    array(),
                    null
                );
            }
        }
    }
}

