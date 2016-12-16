<?php

namespace Flair\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente un organisme.
 *
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\OrganismeRepository")
 * @ORM\Table(name = "organismes")
 */
class Organisme extends AbstractUtilisateur
{
    /**
     * @var String Le nom de l'organisme.
     *
     * @ORM\Column(name = "nom", type = "string")
     */
    private $nom;

    /**
     * @var String Le numéro SIRET
     *
     * @ORM\Column(name = "siret", type = "string", length = 14, nullable = true)
     */
    private $siret;

    /**
     * @var String Le code APE
     *
     * @ORM\Column(name = "ape", type = "string", nullable = true)
     */
    private $ape;

    /**
     * @var String Le code RNA pour les associations
     *
     * @ORM\Column(name = "rna", type = "string", nullable = true)
     */
    private $rna;

    /**
     * @var String L'adresse postale.
     *
     * @ORM\Column(name = "adresse", type = "string", nullable = true)
     */
    private $adresse;

    /**
     * @var String Le code postal.
     *
     * @ORM\Column(name = "code_postal", type = "string", length = 50, nullable = true)
     */
    private $codePostal;

    /**
     * @var String Le complément d'adresse.
     *
     * @ORM\Column(name="complement_adresse", type="string", nullable = true)
     */
    private $complementAdresse;

    /**
     * @var String La ville.
     *
     * @ORM\Column(name = "ville", type = "string", nullable = true)
     */
    private $ville;

    /**
     * @var String Le numéro de téléphone.
     *
     * @ORM\Column(name = "telephone", type = "string", length = 15, nullable = true)
     */
    private $telephone;

    /**
     * @var String le numéro de téléphone mobile.
     *
     * @ORM\Column(name = "mobile", type = "string", length = 15, nullable = true)
     */
    private $mobile;

    /**
     * @var CategorieOrganisme La catégorie de l'organisme.
     *
     * @ORM\ManyToOne(
     *     targetEntity = "Flair\UserBundle\Entity\CategorieOrganisme",
     *     cascade      = { "persist" }
     * )
     */
    private $categorie;

    /**
     * @ORM\Column(name = "autreCategorie", type = "string", nullable = true)
     */
    private $autreCategorie;

    /**
     * @var String Le prénom du contact.
     *
     * @ORM\Column(name = "prenom_contact", type = "string", nullable = true)
     */
    private $prenomContact;

    /**
     * @var String Le nom du contact.
     *1
     * @ORM\Column(name = "nom_contact", type = "string", nullable = true)
     */
    private $nomContact;

    /**
     * @var ArrayCollection Liste de consultations de l'organisme.
     *
     * @ORM\OneToMany(targetEntity = "Flair\CoreBundle\Entity\Consultation", mappedBy = "organisme")
     */
    private $consultations;

    /**
     * @var ArrayCollection Liste des prestataires réferéncés par l'organisme.
     *
     * @ORM\ManyToMany(targetEntity = "Flair\UserBundle\Entity\Prestataire", inversedBy = "organismes")
     * @ORM\JoinTable(
     *      name = "organismes_prestataires",
     *      joinColumns = @ORM\JoinColumn(
     *          name = "id_organisme", referencedColumnName = "id", onDelete = "cascade"
     *      ),
     *      inverseJoinColumns = @ORM\JoinColumn(
     *          name = "id_prestataire", referencedColumnName = "id", onDelete = "cascade"
     *      )
     * )
     */
    private $prestataires;

    /**
     * @var Entreprise Les infos de l'entreprise
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\Entreprise", cascade = { "persist" })
     */
    private $entreprise;

    /**
     * Initialisation des types complexes.
     */
    public function __construct()
    {
        parent::__construct();

        $this->prestataires = new ArrayCollection();
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
     * @param \Flair\UserBundle\Entity\CategorieOrganisme $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return \Flair\UserBundle\Entity\CategorieOrganisme
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param String $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return String
     */
    public function getCodePostal()
    {
        return $this->codePostal;
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
     * @param String $rna
     */
    public function setRna($rna)
    {
        $this->rna = $rna;
    }

    /**
     * @return String
     */
    public function getRna()
    {
        return $this->rna;
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
     * Retourne le nom complet de l'utilisateur.
     */
    public function getNomComplet()
    {
        return $this->getPrenomContact() . ' ' . $this->getNomContact();
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $consultations
     */
    public function setConsultations($consultations)
    {
        $this->consultations = $consultations;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $prestataires
     */
    public function setPrestataires($prestataires)
    {
        $this->prestataires = $prestataires;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPrestataires()
    {
        return $this->prestataires;
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

    public function getAutreCategorie()
    {
        return $this->autreCategorie;
    }

    public function setAutreCategorie($autreCategorie)
    {
        $this->autreCategorie = $autreCategorie;
    }

    public function getCompletion()
    {
        $checkValues = array('resetToken', 'resetDate', 'autreCategorie', 'token');
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
    public function setEntreprise(Entreprise $entreprise)
    {
        $this->entreprise = $entreprise;
    }
}
