<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represente une reponse a une consultation.
 *
 * @ORM\Entity(repositoryClass = "Flair\CoreBundle\Repository\ReponseRepository")
 * @ORM\Table(name = "reponses")
 */
class Reponse
{
    /**
     * @const integer No answered status
     */
    const WAITING = 1;

    /**
     * @const integer Le prestataire a rédigé un brouillon.
     */
    const DRAFT = 2;

    /**
     * @const integer La reponse est finale et sera transmise à l'organisme.
     */
    const ANSWERED = 4;

    /**
     * @const integer Le prestataire decline la consultation.
     */
    const DECLINE = -1;

    /**
     * @var integer L'identifiant de la reponse.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      name = "id_reponse",
     *      type = "integer"
     * )
     */
    private $id;

    /**
     * @var Consultation La consultation a laquelle correspond cette réponse.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Consultation", inversedBy = "reponses")
     * @ORM\JoinColumn(name = "id_consultation", referencedColumnName = "id_consultation", onDelete = "cascade")
     */
    private $consultation;

    /**
     * @var Prestataire Le prestataire correspondant.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\Prestataire", inversedBy = "reponses")
     * @ORM\JoinColumn(name = "id_prestataire", referencedColumnName = "id", onDelete = "cascade")
     */
    private $prestataire;

    /**
     * @var \DateTime La date de reponse du prestataire.
     *
     * @ORM\Column(
     *      name     = "date_reponse",
     *      type     = "datetime",
     *      nullable = true
     * )
     */
    private $dateReponse;

    /**
     * @var String La date de debut du prestataire.
     *
     * @ORM\Column(
     *      name     = "periode_debut",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $periodeDebut;

    /**
     * @var \DateTime la date de debut du prestataire.
     *
     * @ORM\Column(
     *      name     = "date_debut",
     *      type     = "datetime",
     *      nullable = true
     * )
     */
    private $dateDebut;

    /**
     * @var String La periode de livraison.
     *
     * @ORM\Column(
     *      name     = "periode_livraison",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $periodeLivraison;

    /**
     * @var \DateTime La date de livraison.
     *
     * @ORM\Column(
     *      name     = "date_livraison",
     *      type     = "datetime",
     *      nullable = true
     * )
     */
    private $dateLivraison;

    /**
     * @var boolean Dispose de la certification requise.
     *
     * @ORM\Column(
     *      name     = "certification_presente",
     *      type     = "boolean",
     *      nullable = true
     * )
     */
    private $certificationRequise;

    /**
     * @var String
     *
     * @ORM\Column(
     *      name     = "certification",
     *      type     = "string",
     *      length   = 255,
     *      nullable = true
     * )
     */
    private $certification;

    /**
     * @var integer Le montant de la reponse.
     *
     * @ORM\Column(
     *      name     = "montant_ht",
     *      type     = "integer",
     *      nullable = true
     * )
     *
     * @Assert\NotBlank(groups = "with_documents")
     */
    private $montantHt;

    /**
     * @var integer Le montant TTC de la prestation.
     *
     * @ORM\Column(
     *      name = "montant_ttc",
     *      type = "integer",
     *      nullable = true
     * )
     *
     * @Assert\NotBlank(groups = "with_documents")
     */
    private $montantTtc;

    /**
     * @var boolean Si oui ou non, le prestataire uploade des documents.
     *
     * @ORM\Column(
     *      name     = "has_devis",
     *      type     = "boolean",
     *      nullable = true
     * )
     */
    private $hasDocuments;

    /**
     * @var Document Le document si c'est un devis perso.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "all")
     * @ORM\JoinColumn(name = "id_devis", referencedColumnName = "id_document")
     *
     * @Assert\NotBlank(groups = "with_documents")
     * @Assert\NotNull(groups = "with_documents")
     */
    private $devisDocument;

    /**
     * @var ArrayCollection La liste des documents.
     *
     * @ORM\ManyToMany(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "all")
     * @ORM\JoinTable(
     *      name = "reponses_documents",
     *      joinColumns = {
     *          @ORM\JoinColumn(name = "id_reponse", referencedColumnName = "id_reponse", onDelete = "cascade")
     *      },
     *      inverseJoinColumns = {
     *          @ORM\JoinColumn(name = "id_document", referencedColumnName = "id_document")
     *      }
     * )
     */
    private $documents;

    /**
     * @var ArrayCollection La liste des elements du devis saisis en lignes.
     *
     * @ORM\OneToMany(targetEntity = "Flair\CoreBundle\Entity\LigneDevis", mappedBy = "reponse", cascade = "all")
     *
     * @Assert\Valid
     * @Assert\Count(
     *      min    = 1,
     *      groups = "no_documents"
     * )
     */
    private $lignesDevis;

    /**
     * @var ArrayCollection La liste des questions posés par les prestataires.
     *
     * @ORM\OneToMany(targetEntity = "Flair\CoreBundle\Entity\Question", mappedBy = "reponse", cascade = { "all" })
     */
    private $questions;

    /**
     * @var integer Le statut de la reponse.
     *
     * @ORM\Column(
     *      name = "statut",
     *      type = "integer"
     * )
     */
    private $statut;

    /**
     * @var integer La réponse du prestataire.
     *
     * @ORM\Column(
     *      name = "reponse",
     *      type = "string",
     *      nullable = true
     * )
     */
    private $reponse;

    /**
     * Constructeur pour l'initialisation de la reponse.
     */
    public function __construct()
    {
        $this->statut = Reponse::WAITING;
        $this->documents = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->lignesDevis = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * REtourne vrai si il y a des questions sans réponses.
     */
    public function hasUnansweredQuestions()
    {
        foreach ($this->questions as $question) {
            if ($question->isUnanswered()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Ajoute une ligne de devis en prenant bien soin d'initialiser la relation.
     */
    public function addLignesDevi(LigneDevis $ligne)
    {
        $ligne->setReponse($this);
        $this->lignesDevis->add($ligne);
    }

    /**
     * Suppression d'une ligne du devis avec suppression.
     */
    public function removeLignesDevi(LigneDevis $ligne)
    {
        $this->lignesDevis->removeElement($ligne);
        $ligne->setReponse(null);
    }

    /**
     * @param \Flair\CoreBundle\Entity\Consultation $consultation
     */
    public function setConsultation($consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
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

    /**
     * @param int $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param \DateTime $dateReponse
     */
    public function setDateReponse($dateReponse)
    {
        $this->dateReponse = $dateReponse;
    }

    /**
     * @return \DateTime
     */
    public function getDateReponse()
    {
        return $this->dateReponse;
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
     * @param int $montantHt
     */
    public function setMontantHt($montantHt)
    {
        $this->montantHt = $montantHt;
    }

    /**
     * @return int
     */
    public function getMontantHt()
    {
        if ($this->hasDocuments) {
            return $this->montantHt;
        }

        $montantHt = 0;
        foreach ($this->lignesDevis as $ligneDevis) {
            $montantHt = $montantHt + ($ligneDevis->getPrixUnitaire() * $ligneDevis->getQuantite());
        }

        return $montantHt;
    }

    /**
     * @param int $montantTtc
     */
    public function setMontantTtc($montantTtc)
    {
        $this->montantTtc = $montantTtc;
    }

    /**
     * @return int
     */
    public function getMontantTtc()
    {
        $montant = 0;
        
        foreach ($this->lignesDevis as $ligneDevis) {
            $montant = $montant + ($ligneDevis->getPrixUnitaire() * $ligneDevis->getQuantite() * $ligneDevis->getTva());
        }

        return ($montant == 0) ? $this->montantTtc : $montant;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $devisDocument
     */
    public function setDevisDocument($devisDocument)
    {
        $this->devisDocument = $devisDocument;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Document
     */
    public function getDevisDocument()
    {
        return $this->devisDocument;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param boolean $hasDocuments
     */
    public function setHasDocuments($hasDocuments)
    {
        $this->hasDocuments = $hasDocuments;
    }

    /**
     * @return boolean
     */
    public function getHasDocuments()
    {
        return $this->hasDocuments;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $lignesDevis
     */
    public function setLignesDevis($lignesDevis)
    {
        $this->lignesDevis = $lignesDevis;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getLignesDevis()
    {
        return $this->lignesDevis;
    }

    /**
     * @param String $certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }

    /**
     * @return String
     */
    public function getCertification()
    {
        return $this->certification;
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
     * @param string $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    public function getStringStatus()
    {
        switch($this->statut)
        {
            case self::WAITING:
                return "En attente";

            case self::DRAFT:
                return "Brouillon";

            case self::ANSWERED:
                return "Réponse finale";

            case self::DECLINE:
                return "Declinée";

            default:
                return "-";
        }
    }
}
