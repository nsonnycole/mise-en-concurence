<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une consultation.
 *
 * @ORM\Entity(repositoryClass = "Flair\CoreBundle\Repository\ConsultationRepository")
 * @ORM\Table(name = "consultations")
 * @ORM\HasLifecycleCallbacks
 */
class Consultation
{
    /**
     * @const String La consultation est en brouillon.
     */
    const DRAFT = 0;

    /**
     * @const String La consultation est publiée. ie. envoyée aux prestataires.
     */
    const PUBLISHED = 1;

    /**
     * @const String Le prestataire a été selectionné.
     */
    const SELECTED = 2;

    /**
     * @const String La consultation a été démarrée par le prestataire.
     */
    const STARTED = 3;

    /**
     * @const String La consultation a été terminée par le prestataire.
     */
    const FINISHED = 4;

    /**
     * @const String La consultation a été cloturée.
     */
    const CLOSED = 5;

    /**
     * @const String La consultation a été annulée.
     */
    const CANCELLED = -1;

    /**
     * @var integer L'identifiant de la consultation.
     *
     * @ORM\Id
     * @ORM\Column(name = "id_consultation", type = "integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string Le titre de la consultation.
     *
     * @ORM\Column(type = "string")
     */
    private $titre;

    /**
     * @var string A description for the request.
     *
     * @ORM\Column(type = "text")
     */
    private $description;

    /**
     * @var Categorie La catégorie de la consultation.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\CategoriePrestataire")
     */
    private $categorie;

    /**
     * @var \DateTime La date de cloture de la mise en concurrence.
     *
     * @ORM\Column(
     *      type     = "datetime",
     *      name     = "date_limite",
     *      nullable = false
     * )
     */
    private $dateLimite;

    /**
     * @var integer The request min price.
     *
     * @ORM\Column(
     *      type     = "integer",
     *      name     = "prix_min",
     *      nullable = true
     * )
     */
    private $prixMinimum;

    /**
     * @var integer The request max price.
     *
     * @ORM\Column(
     *      type     = "integer",
     *      name     = "prix_max",
     *      nullable = true
     * )
     */
    private $prixMaximum;

    /**
     * @var String La periode de d2but souhaite pour le projet.
     *
     * @ORM\Column(
     *      name     = "periode_debut",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $periodeDebut;

    /**
     * @var \DateTime La date de debut pour le projet.
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
     * @var String L'experience requise pour cette consultation.
     *
     * @ORM\Column(
     *      name     = "experience_requises",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $experienceRequise;

    /**
     * @var Boolean Faut il une certification pour répondre à cette consultation.
     *
     * @ORM\Column(
     *      name = "certification_requise",
     *      type = "boolean"
     * )
     */
    private $certificationRequise;

    /**
     * @var String Les certifications requises.
     *
     * @ORM\Column(
     *      name     = "certifications",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $certifications;

    /**
     * @var Organisme L'organisme rattaché à cette demande de consultation.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\Organisme", inversedBy = "consultations")
     * @ORM\JoinColumn(name = "id_organisme", onDelete = "cascade")
     */
    private $organisme;

    /**
     * @var integer Statut de la consultation.
     *
     * @ORM\Column(type = "integer")
     */
    private $statut;

    /**
     * @var \DateTime La date de création de la demande.
     *
     * @ORM\Column(
     *      type = "datetime",
     *      name = "date_creation"
     * )
     */
    private $dateCreation;

    /**
     * @var \DateTime La dernière date de mise-à-jour.
     *
     * @ORM\Column(
     *      name = "date_update",
     *      type = "datetime"
     * )
     */
    private $dateUpdate;

    /**
     * @var ArrayCollection la liste des documents rattaches a cette consultation.
     *
     * @ORM\ManyToMany(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "persist" )
     * @ORM\JoinTable(name = "consultations_documents",
     *      joinColumns = {
     *          @ORM\JoinColumn(
     *              name = "id_consultation", referencedColumnName = "id_consultation", onDelete = "cascade")
     *          },
     *      inverseJoinColumns = {
     *          @ORM\JoinColumn(
     *              name = "id_document", referencedColumnName = "id_document" )
     *      }
     * )
     */
    private $documents;

    /**
     * @var ArrayCollection La liste des prestataires invités sur la consultation.
     *
     * @ORM\OneToMany(targetEntity = "Flair\CoreBundle\Entity\Reponse", mappedBy = "consultation", cascade = "all")
     */
    private $reponses;

    /**
     * @var Reponse La réponse qui a été selectionné.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Reponse")
     * @ORM\JoinColumn(name = "id_reponse_selectionne", referencedColumnName = "id_reponse", onDelete = "cascade")
     */
    private $reponseSelectionne;

    /**
     * Initialisation de la date de création et de dernière modification.
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->dateUpdate = new \DateTime();

        $this->certificationRequise = false;
        $this->reponses = new ArrayCollection();
    }

    /**
     * On change de statut si le nombre de prestataires est different de zéro.
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        if ($this->getStatut() == Consultation::DRAFT && count($this->reponses) > 0) {
            $this->setStatut(Consultation::PUBLISHED);
        }
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retourne vrai si il y a des questions sans réponses.
     */
    public function hasUnansweredQuestions()
    {
        foreach ($this->reponses as $reponse) {
            if ($reponse->hasUnansweredQuestions()) {
                return true;
            }
        }

        return false;
    }

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
     * @param \DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
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
     * @param \Doctrine\Common\Collections\ArrayCollection $reponses
     */
    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Reponse $reponseSelectionne
     */
    public function setReponseSelectionne($reponseSelectionne)
    {
        $this->reponseSelectionne = $reponseSelectionne;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Reponse
     */
    public function getReponseSelectionne()
    {
        return $this->reponseSelectionne;
    }

    public function getStringStatus()
    {
        switch($this->statut)
        {
            case self::DRAFT:
                return "Brouillon";

            case self::PUBLISHED:
                return "Publiée";

            case self::SELECTED:
                return "Selectionné";

            case self::STARTED:
                return "Démarrée";

            case self::FINISHED:
                return "Terminée";

            case self::CLOSED:
                return "Cloturée";

            case self::CANCELLED:
                return "Annulée";

            default:
                return "-";
        }
    }
}
