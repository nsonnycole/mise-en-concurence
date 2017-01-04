<?php

namespace Flair\UserBundle\Model;

use Flair\UserBundle\Entity\Categorie;
use Flair\UserBundle\Entity\CategorieOrganisme;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Validator\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Modèle d'inscription.
 */
class InscriptionOrganisme
{
    /**
     * @var String l'adresse email de l'organisme.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     * @Assert\Email(message = "L'adresse e-mail n'est pas valide")
     * @UniqueEmail
     */
    private $email;

    /**
     * @var String Le mot de passe.
     *
     * @Assert\NotBlank(message = "Cette valeur ne doit pas être vide")
     */
    private $motdepasse;

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
     * @var String Une catégorie autre (renseignée par l'organisme).
     */
    private $autreCategorie;

    /**
     * Retourne un organisme à partir de ce modele.
     */
    public function toOrganisme()
    {
        $organisme = new Organisme();
        $organisme->setEmail($this->email);
        $organisme->setPassword($this->motdepasse);
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
        $organisme->setAutreCategorie($this->getAutreCategorie());
        $organisme->addRole("ROLE_ORGANISME");

        return $organisme;
    }

    public function toService(Organisme $organismeParent)
    {
        $organisme = $this->toOrganisme();
        $organisme->setEntreprise($organismeParent->getEntreprise());
        $organisme->addRole("ROLE_CONSULTANT");

        return $organisme;
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
     * @Assert\Callback
     */
    public function isCategorieValide(ExecutionContextInterface $context, $payload)
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
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
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
     * @param mixed $cgu
     */
    public function setCgu($cgu)
    {
        $this->cgu = $cgu;
    }

    /**
     * @return mixed
     */
    public function getCgu()
    {
        return $this->cgu;
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
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $emailPartenaire
     */
    public function setEmailPartenaire($emailPartenaire)
    {
        $this->emailPartenaire = $emailPartenaire;
    }

    /**
     * @return mixed
     */
    public function getEmailPartenaire()
    {
        return $this->emailPartenaire;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $motdepasse
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nomContact
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;
    }

    /**
     * @return mixed
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * @param mixed $prenomContact
     */
    public function setPrenomContact($prenomContact)
    {
        $this->prenomContact = $prenomContact;
    }

    /**
     * @return mixed
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
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
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
