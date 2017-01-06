<?php

namespace Flair\UserBundle\Model;

use Flair\UserBundle\Entity\Organisme;
use Symfony\Component\Validator\Constraints as Assert;
use Flair\UserBundle\Validator\UniqueEmail;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Represente le formulaire de modification d'un organisme.
 */
class ProfilOrganisme
{
    /**
     * @var String l'adresse email de l'organisme.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     * @Assert\Email(message = "L'adresse e-mail n'est pas valide")
     */
    private $email;

    /**
     * @var boolean Si l'utiliasteur a accepté les CGU.
     *
     * @Assert\IsTrue(message = "Vous devez accepter les CGU")
     */
    private $cgu;

    /**
     * @var boolean Si l'utilisateur accpete de recevoir des emails des partenaires.
     */
    private $emailPartenaire;

    /**
     * @var String Le nom de l'organisme.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $nom;

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
     * @var String le code rna pour les associations.
     *
     * @Assert\Regex("/w([1-9]){9}/")
     * @Assert\Length(
     *     min = "10",
     *     max = "10"
     * )
     */
    private $rna;

    /**
     * @var String L'adresse de l'organisme.
     */
    private $adresse;

    /**
     * @var String Le complément d'adresse de l'organisme.
     */
    private $complementAdresse;

    /**
     * @var String la ville de l'organisme.
     */
    private $ville;

    /**
     * @var String Le code postal de l'organisme.
     */
    private $codePostal;

    /**
     * @var String Le numéro de téléphone.
     */
    private $telephone;

    /**
     * @var String Le numéro de mobile.
     */
    private $mobile;

    /**
     * @var CategorieOrganisme La catégorie de premier niveau.
     */
    private $categorieLevelOne;

    /**
     * @var CategorieOrganisme La catégorie de deuxième niveau.
     */
    private $categorieLevelTwo;

    /**
     * @var String le prénom du contact.
     */
    private $prenomContact;

    /**
     * @var String le nom du contact.
     */
    private $nomContact;

    /**
     * @var String Autre catégorie.
     */
    private $autreCategorie;

    /**
     * Retourne un organisme à partir de ce modele.
     */
    public function merge(Organisme $organisme)
    {
        $organisme->setEmail($this->email);
        $organisme->setNom($this->nom);
        $organisme->setSiret($this->siret);
        $organisme->setSiren($this->siren);
        $organisme->setRna($this->rna);
        $organisme->setApe($this->ape);
        $organisme->setAdresse($this->adresse);
        $organisme->setCodePostal($this->codePostal);
        $organisme->setVille($this->ville);
        $organisme->setCategorie($this->getCategorie());
        $organisme->setTelephone($this->telephone);
        $organisme->setMobile($this->mobile);
        $organisme->setPrenomContact($this->prenomContact);
        $organisme->setNomContact($this->nomContact);
        $organisme->setComplementAdresse($this->complementAdresse);
        $organisme->setAutreCategorie($this->autreCategorie);

        return $organisme;
    }

    /**
     * Cr2e les valeurs a partir de la valeur de l'entité.
     */
    public function initialize(Organisme $organisme)
    {
        $this->setEmail($organisme->getEmail());
        $this->setNom($organisme->getNom());
        $this->setSiret($organisme->getSiret());
        $this->setAdresse($organisme->getAdresse());
        $this->setCodePostal($organisme->getCodePostal());
        $this->setVille($organisme->getVille());
        $this->setCategorie($organisme->getCategorie());
        $this->setTelephone($organisme->getTelephone());
        $this->setMobile($organisme->getMobile());
        $this->setPrenomContact($organisme->getPrenomContact());
        $this->setNomContact($organisme->getNomContact());
        $this->setComplementAdresse($organisme->getComplementAdresse());
        $this->setSiren($organisme->getSiren());
        $this->setRna($organisme->getRna());
        $this->setApe($organisme->getApe());
        $this->setAutreCategorie($organisme->getAutreCategorie());
    }

    /**
     * @Assert\Callback
     */
    public function isCategorieValide(ExecutionContextInterface $context)
    {
        $categorie = $this->getCategorie();
        if ($categorie == null) {
            $context->addViolationAt(
                'categorieLevelOne',
                'Veuillez renseigner une catégorie d\'activité!',
                array(),
                null
            );
        }
    }

    /** 
     * @Assert\Callback
     */
    public function areDataValid(ExecutionContextInterface $context)
    {
        if ($this->getCategorie() === "Association" && is_null($this->getRna())) {
            $context->addViolationAt(
                'rna',
                "En tant qu'association, veuillez renseigner votre code RNA",
                array(),
                null
            );
        }
    }

    /**
     * Retourne la catégorie.
     */
    public function getCategorie()
    {
        if ($this->categorieLevelTwo != null) {
            return $this->getCategorieLevelTwo();
        }

        return $this->categorieLevelOne;
    }

    /**
     * Définit la catégorie.
     */
    public function setCategorie($categorie)
    {
        if ($categorie->getParent() == null) {
            $this->categorieLevelOne = $categorie;
        } else {
            $this->categorieLevelOne = $categorie->getParent();
            $this->categorieLevelTwo = $categorie;
        }
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
     * @param \Flair\UserBundle\Model\Categorie $categorieLevelOne
     */
    public function setCategorieLevelOne($categorieLevelOne)
    {
        $this->categorieLevelOne = $categorieLevelOne;
    }

    /**
     * @return \Flair\UserBundle\Model\Categorie
     */
    public function getCategorieLevelOne()
    {
        return $this->categorieLevelOne;
    }

    /**
     * @param \Flair\UserBundle\Model\Categorie $categorieLevelTwo
     */
    public function setCategorieLevelTwo($categorieLevelTwo)
    {
        $this->categorieLevelTwo = $categorieLevelTwo;
    }

    /**
     * @return \Flair\UserBundle\Model\Categorie
     */
    public function getCategorieLevelTwo()
    {
        return $this->categorieLevelTwo;
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
     * @param mixed $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @return mixed
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
}
