<?php

namespace Flair\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Flair\UserBundle\Entity\CategoriePrestataire;
use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Entity\Prestataire;
use Flair\UserBundle\Validator\UniqueEmail;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Model de modification d'un prestataire.
 */
class ProfilPrestataire
{
    /**
     * @var String L'adresse email.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas etre vide")
     * @Assert\Email(message = "L'adresse e-mail n'est pas valide")
     */
    private $email;

    /**
     * @var String Le nom de l'entreprise.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $nom;

    private $tags;

    /**
     * @var String le numéro SIRET de l'organisme.
     * @Assert\Length(
     *     min = "14",
     *     max = "14"
     * )
     * @Assert\Regex("/\d/")
     * @Assert\Luhn(message = "Veuillez spécifier un numéro de siret correct")
     */
    private $siret;

    /**
     * @var String le numéro SIREN de l'organisme.
     *
     * @Assert\Length(
     *     min = "9",
     *     max = "9"
     * )
     * @Assert\NotBlank(message = "Cette valeur ne doit pas etre vide")
     */
    private $siren;

    /**
     * @var String le code ape.
     * 
     * @Assert\Regex("/([0-9]){4}([a-zA-Z]){1}/")
     * @Assert\Length(
     *     min = "5",
     *     max = "5"
     * )
     */
    private $ape;

    /**
     * @var String La TVA intracommunautaire.
     *
     * @Assert\Regex("/([A-Z]){2}([0-9]){11}/")
     * @Assert\Length(
     *     min = "13",
     *     max = "13"
     * )
     */
    private $tvaIntracommunautaire;

    /**
     * @var String La présentation de l'entreprise.
     */
    private $presentation;

    /**
     * @var String commentaires limitées à une dizaine de 
     * lignes afin d'y inscrire les principales références.
     */
    private $refs;

    /**
     * @var String L'adresse de l'organisme.
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @var String Le complément d'adresse de l'organisme.
     */
    private $complementAdresse;

    /**
     * @var \DateTime La date de création de l'entreprise.
     *
     * @Assert\NotBlank
     */
    private $dateCreation;

    /**
     * @var String la ville de l'organisme.
     */
    private $ville;

    /**
     * @var String Le code postal de l'organisme.
     */
    private $codePostal;

    /**
     * @var String Le perimetre d'intervention.
     */
    private $perimetreIntervention;

    /**
     * @var String Le numéro de téléphone.
     */
    private $telephone;

    /**
     * @var String Le numéro de mobile.
     */
    private $mobile;

    /**
     * @var String le prénom du contact.
     */
    private $prenomContact;

    /**
     * @var String le nom du contact.
     */
    private $nomContact;

    /**
     * @var PersistentCollection La liste des catégories
     */
    private $categories;

    /**
     * @var CategoriePrestataire La catégorie de premier niveau.
     */
    private $categorieLevelOne;

    /**
     * @var CategoriePrestataire La catégorie de deuxième niveau.
     */
    private $categorieLevelTwo;

    /**
     * @var CategoriePrestataire
     */
    private $categorieLevelThree;

    /**
     * @var Document La déclaration ussraf.
     *
     * @Assert\Valid
     */
    private $urssaf;

    /**
     * @var Document La declaration d'impots.
     *
     * @Assert\Valid
     */
    private $impots;

    /**
     * @var Document Un extrait KBIS.
     *
     * @Assert\Valid
     */
    private $kbis;

    /**
     * @var Document Un document présentant l'entreprise.
     *
     * @Assert\Valid
     */
    private $presentationDoc;

    /**
     * @param String $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @Assert\Callback
     */
    public function isCategorieValide(ExecutionContextInterface $context)
    {
        $categories = $this->getCategories();
        if ($categories == null) {
            $context->addViolationAt(
                'categorieLevelOne',
                'Veuillez renseigner une catégorie d\'activité!',
                array(),
                null
            );
        }
    }

    /**
     * Vérifie que la date de creation est bien valide. ie. inférieure à la date du jour.
     *
     * @Assert\Callback
     */
    public function isDateCreationValide(ExecutionContextInterface $context)
    {
        if ($this->getDateCreation() != null) {
            if ($this->getDateCreation() > new \DateTime()) {
                $context->addViolationAt(
                    'dateCreation',
                    'La date de création ne peut être supérieure à la date du jour',
                    array(),
                    null
                );
            }
        }
    }

    /**
     * Initialise le modele avec les valeurs de l'entité.
     *
     * @param Prestataire $prestataire
     */
    public function initialize(Prestataire $prestataire)
    {
        $this->setEmail($prestataire->getEmail());
        $this->setNom($prestataire->getNom());
        $this->setSiret($prestataire->getSiret());
        $this->setSiren($prestataire->getSiren());
        $this->setApe($prestataire->getApe());
        $this->setDateCreation($prestataire->getDateCreation());
        $this->setAdresse($prestataire->getAdresse());
        $this->setVille($prestataire->getVille());
        $this->setCodePostal($prestataire->getCodePostal());
        $this->setPerimetreIntervention($prestataire->getPerimetreIntervention());
        $this->setTelephone($prestataire->getTelephone());
        $this->setMobile($prestataire->getMobile());
        $this->setPrenomContact($prestataire->getPrenomContact());
        $this->setNomContact($prestataire->getNomContact());
        $this->setCategories($prestataire->getCategories());
        $this->setUrssaf($prestataire->getUrssaf());
        $this->setImpots($prestataire->getImpots());
        $this->setKbis($prestataire->getKbis());
        $this->setPresentationDoc($prestataire->getPresentationDoc());
        $this->setPresentation($prestataire->getPresentation());
        $this->setRefs($prestataire->getRefs());
        $this->setTags($prestataire->getTags());
        $this->setTvaIntracommunautaire($prestataire->getTvaIntracommunataire());
        $this->setComplementAdresse($prestataire->getComplementAdresse());
    }

    /**
     * Fusionne le modele et l'entité.
     *
     * @param Prestataire $prestataire
     */
    public function merge(Prestataire $prestataire)
    {
        $prestataire->setEmail($this->getEmail());
        $prestataire->setNom($this->getNom());
        $prestataire->setSiret($this->getSiret());
        $prestataire->setSiren($this->getSiren());
        $prestataire->setApe($this->getApe());
        $prestataire->setDateCreation($this->getDateCreation());
        $prestataire->setAdresse($this->getAdresse());
        $prestataire->setVille($this->getVille());
        $prestataire->setCodePostal($this->getCodePostal());
        $prestataire->setPerimetreIntervention($this->getPerimetreIntervention());
        $prestataire->setTelephone($this->getTelephone());
        $prestataire->setMobile($this->getMobile());
        $prestataire->setPrenomContact($this->getPrenomContact());
        $prestataire->setNomContact($this->getNomContact());
        $prestataire->setCategories($this->getCategories());
        $prestataire->setUrssaf($this->getUrssaf());
        $prestataire->setImpots($this->getImpots());
        $prestataire->setKbis($this->getKbis());
        $prestataire->setPresentationDoc($this->getPresentationDoc());
        $prestataire->setPresentation($this->getPresentation());
        $prestataire->setRefs($this->getRefs());
        $prestataire->setTvaIntracommunautaire($this->getTvaIntracommunautaire());
        $prestataire->setComplementAdresse($this->getComplementAdresse());
    }

    /**
     * Retourne la catégoriela plus précise.
     */
    public function getCategorie()
    {
        if ($this->getCategorieLevelThree() != null) {
            return $this->getCategorieLevelThree();
        }

        if ($this->categorieLevelTwo != null) {
            return $this->getCategorieLevelTwo();
        }

        return $this->categorieLevelOne;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return String
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Transpose la catégorie.
     * @param CategoriePrestataire $categorie La categorie du prestataire.
     */
    public function setCategories(PersistentCollection $categories)
    {
        $this->categories = $categories;
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
     * @param boolean $cgu
     */
    public function setCgu($cgu)
    {
        $this->cgu = $cgu;
    }

    /**
     * @return boolean
     */
    public function getCgu()
    {
        return $this->cgu;
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
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param String $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
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
     * @param String $siren
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

    /**
     * @return String
     */
    public function getSiren()
    {
        return $this->siren;
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
     * Récupère la tva intracommunataire.
     * 
     * @return String.
     */
    public function getTvaIntracommunautaire()
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
}
