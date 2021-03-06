<?php

namespace Flair\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente un prestataire.
 *
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\PrestataireRepository")
 * @ORM\Table(name = "prestataires")
 */
class Prestataire extends AbstractUtilisateur
{
    /**
     * @var String Le nom de l'entreprise.
     *
     * @ORM\Column(
     *      name = "nom",
     *      type = "string"
     * )
     */
    private $nom;

    /**
     * @var String La TVA intracommunautaire.
     *
     * @ORM\Column(
     *      name = "tva_intracommunautaire",
     *      type = "string",
     *      nullable = true
     * )
     */
    private $tvaIntracommunautaire;

    /**
     * @var String La présentation de l'entreprise.
     *
     * @ORM\Column(
     *      name = "presentation",
     *      type = "string",
     *      nullable = true
     * )
     */
    private $presentation;

    /**
     * @var String commentaires limitées à une dizaine de 
     * lignes afin d'y inscrire les principales références.
     *
     * @ORM\Column(
     *      name = "refs",
     *      type = "string",
     *      nullable = true
     * )
     */
    private $refs;

    /**
     * @var String le numéro SIRET..
     *
     * @ORM\Column(
     *      name = "siret",
     *      type = "string",
     *      nullable = true
     * )
     */
    private $siret;

    /**
     * @var String Le code APE
     *
     * @ORM\Column(name = "ape", type = "string", nullable = true)
     */
    private $ape;

    /**
     * @var String L'adresse postale.
     *
     * @ORM\Column(name = "adresse", type = "string")
     */
    private $adresse;

    /**
     * @var String Le complément d'adresse.
     *
     * @ORM\Column(name="complement_adresse", type="string", nullable = true)
     */
    private $complementAdresse;

    /**
     * @var \DateTime La date de création du prestataire.
     *
     * @ORM\Column(
     *      name = "date_creation",
     *      type = "datetime"
     * )
     */
    private $dateCreation;

    /**
     * @var CategoriePrestataire La catégorie de spécialisation du prestataire.
     *
     * @ORM\ManyToMany(targetEntity="CategoriePrestataire")
     * @ORM\JoinTable(name = "liste_categories_prestataires",
     *      joinColumns={@ORM\JoinColumn(name="presta_id", referencedColumnName="id", onDelete = "cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="cat_presta_id", referencedColumnName="id", onDelete = "cascade")}
     * )
     */
    private $categories;

    /**
     * @var String la ville de l'organisme.
     *
     * @ORM\Column(
     *      name     = "ville",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $ville;

    /**
     * @var String Le code postal de l'organisme.
     *
     * @ORM\Column(
     *      name     = "code_postal",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $codePostal;

    /**
     * @var String Le perimetre d'intervention du prestataire.
     *
     * @ORM\Column(
     *      name   = "perimetre_intervention",
     *      type   = "string",
     *      length = 80
     * )
     */
    private $perimetreIntervention;

    /**
     * @var String Le numéro de téléphone.
     *
     * @ORM\Column(
     *      name     = "telephone",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $telephone;

    /**
     * @var String Le numéro de mobile.
     *
     * @ORM\Column(
     *      name     = "mobile",
     *      type     = "string",
     *      nullable = true
     * )
     */
    private $mobile;

    /**
     * @var String Les tags (mots clés pour le moteur de recherche).
     *
     * @ORM\ManyToMany(targetEntity="Flair\CoreBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    /**
     * @var String Le prénom du contact.
     *
     * @ORM\Column(name = "prenom_contact", type = "string", nullable = true)
     */
    private $prenomContact;

    /**
     * @var String Le nom du contact.
     *
     * @ORM\Column(name = "nom_contact", type = "string", nullable = true)
     */
    private $nomContact;

    /**
     * @var Document La déclaration ussraf.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "persist")
     * @ORM\JoinColumn(name = "id_urssaf", referencedColumnName = "id_document")
     */
    private $urssaf;

    /**
     * @var Document La declaration d'impots.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "persist")
     * @ORM\JoinColumn(name = "id_impots", referencedColumnName = "id_document")
     */
    private $impots;

    /**
     * @var Document Un extrait KBIS.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Document", cascade = "persist")
     * @ORM\JoinColumn(name = "id_kbis", referencedColumnName = "id_document")
     */
    private $kbis;

    /**
     * @var Document Un document présentant l'entreprise.
     *
     * @ORM\ManyToOne(targetEntity = "Flair\CoreBundle\Entity\Document", cascade={"persist"})
     * @ORM\JoinColumn(name = "id_presentation_doc", referencedColumnName = "id_document")
     */
    private $presentationDoc;

    /**
     * @var ArrayCollection Liste des organismes.
     *
     * @ORM\ManyToMany(targetEntity = "Flair\UserBundle\Entity\Organisme", mappedBy = "prestataires")
     */
    private $organismes;

    /**
     * @var ArrayCollection La liste des reponses du prestataire.
     *
     * @ORM\OneToMany(targetEntity = "Flair\CoreBundle\Entity\Reponse", mappedBy = "prestataire")
     */
    private $reponses;

    /**
     * @var Entreprise Les infos de l'entreprise
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\Entreprise", cascade = { "persist" })
     */
    private $entreprise;

    /**
     * Constructeur pour l'initialisation des variables complexes.
     */
    public function __construct()
    {
        parent::__construct();

        $this->organismes = new ArrayCollection();
        $this->reponses = new ArrayCollection();
        $this->tags = new ArrayCollection();    
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Retourne le nom complet du contact.
     *
     * @return string|void
     */
    public function getNomComplet()
    {
        return $this->getPrenomContact() . ' ' . $this->getNomContact();
    }


    /**
     * @param String $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return String
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $organismes
     */
    public function setOrganismes($organismes)
    {
        $this->organismes = $organismes;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrganismes()
    {
        return $this->organismes;
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
     * @param String $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return String
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param String $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return String
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param String $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @return String
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param String $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return String
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param String $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return String
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param String $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @param String $perimetreIntervention
     */
    public function setPerimetreIntervention($perimetreIntervention)
    {
        $this->perimetreIntervention = $perimetreIntervention;
    }

    /**
     * @return String
     */
    public function getPerimetreIntervention()
    {
        return $this->perimetreIntervention;
    }

    /**
     * @return String
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategoriePrestataire
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function getCategorie()
    {
        $stringCategorie = "";

        foreach($this->categories as $categorie) {
            $stringCategorie .= " " . $categorie->getFullName() . " -";
        }

        return rtrim($stringCategorie, '-');
    }

    /**
     * @param String $nomContact
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;
    }

    /**
     * @return String
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * @param String $prenomContact
     */
    public function setPrenomContact($prenomContact)
    {
        $this->prenomContact = $prenomContact;
    }

    /**
     * @return String
     */
    public function getPrenomContact()
    {
        return $this->prenomContact;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $impots
     */
    public function setImpots($impots)
    {
        $this->impots = $impots;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Document
     */
    public function getImpots()
    {
        return $this->impots;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $kbis
     */
    public function setKbis($kbis)
    {
        $this->kbis = $kbis;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Document
     */
    public function getKbis()
    {
        return $this->kbis;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $urssaf
     */
    public function setUrssaf($urssaf)
    {
        $this->urssaf = $urssaf;
    }

   /**
    * @return \Flair\CoreBundle\Entity\Document
    */
    public function getUrssaf()
    {
        return $this->urssaf;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Document
     */
    public function getPresentationDoc()
    {
        return $this->presentationDoc;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Document $presentationDoc
     */
    public function setPresentationDoc($presentationDoc)
    {
        $this->presentationDoc = $presentationDoc;
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
     * Add tag
     *
     * @param \Flair\CoreBundle\Entity\Tag $tag
     * @return Prestataire
     */
    public function addTag(\Flair\CoreBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Flair\CoreBundle\Entity\Tag $tag
     */
    public function removeTag(\Flair\CoreBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param String $siren
     */
    public function setSiren($siren)
    {
        $entreprise = $this->getEntreprise();

        if (is_null($entreprise))
        {
            $entreprise = new Entreprise();
            $entreprise->setSiren($siren);
            $this->setEntreprise($entreprise);
        }

        $this->entreprise->setSiren($siren);
    }

    /**
     * @return String
     */
    public function getSiren()
    {
        return $this->entreprise->getSiren();
    }

        /**
     * @param String $ape
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
    }

    /**
     * @return String
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Récupère le complément d'adresse.
     *
     * @return String;
     */
    public function getComplementAdresse()
    {
        return $this->complementAdresse;
    }

    /**
     * Set le complément d'adresse.
     *
     * @param String $complementAdresse
     */
    public function setComplementAdresse($complementAdresse)
    {
        $this->complementAdresse = $complementAdresse;
    }

    /**
     * Récupère la tva intracommunataire.
     * 
     * @return String.
     */
    public function getTvaIntracommunataire()
    {
        return $this->tvaIntracommunautaire;
    }

    /**
     * Set la tva intracommunataire.
     *
     * @param String $tva
     */
    public function setTvaIntracommunautaire($tva)
    {
        $this->tvaIntracommunautaire = $tva;
    }

    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
    }

    public function getRefs()
    {
        return $this->refs;
    }

    public function setRefs($refs)
    {
        $this->refs = $refs;
    }

    public function getCompletion()
    {
        $checkValues = array('resetToken', 'resetDate');
        $fields = get_object_vars($this);
        $totalFields = count($fields);
        $completedFields = 0;

        foreach ($fields as $attr => $value) {
            if (!is_null($value)) {
                $completedFields++;
            }
        }

        return ceil((100 * $completedFields) / ($totalFields - sizeof($checkValues)));
    }

    /**
     * @return Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * @param Entreprise $entreprise
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
    }

    /**
     * Get tvaIntracommunautaire
     *
     * @return string 
     */
    public function getTvaIntracommunautaire()
    {
        return $this->tvaIntracommunautaire;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Add categorie
     *
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorie
     * @return Prestataire
     */
    public function addCategorie(\Flair\UserBundle\Entity\CategoriePrestataire $categorie)
    {
        $this->categories[] = $categorie;

        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \Flair\UserBundle\Entity\CategoriePrestataire $categorie
     */
    public function removeCategorie(\Flair\UserBundle\Entity\CategoriePrestataire $categorie)
    {
        $this->categories->removeElement($categorie);
    }

    /**
     * Add organismes
     *
     * @param \Flair\UserBundle\Entity\Organisme $organismes
     * @return Prestataire
     */
    public function addOrganisme(\Flair\UserBundle\Entity\Organisme $organismes)
    {
        $this->organismes[] = $organismes;

        return $this;
    }

    /**
     * Remove organismes
     *
     * @param \Flair\UserBundle\Entity\Organisme $organismes
     */
    public function removeOrganisme(\Flair\UserBundle\Entity\Organisme $organismes)
    {
        $this->organismes->removeElement($organismes);
    }

    /**
     * Add reponses
     *
     * @param \Flair\CoreBundle\Entity\Reponse $reponses
     * @return Prestataire
     */
    public function addReponse(\Flair\CoreBundle\Entity\Reponse $reponses)
    {
        $this->reponses[] = $reponses;

        return $this;
    }

    /**
     * Remove reponses
     *
     * @param \Flair\CoreBundle\Entity\Reponse $reponses
     */
    public function removeReponse(\Flair\CoreBundle\Entity\Reponse $reponses)
    {
        $this->reponses->removeElement($reponses);
    }
}
