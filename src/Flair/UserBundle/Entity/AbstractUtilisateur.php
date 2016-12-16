<?php

namespace Flair\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\UtilisateurRepository")
 * @ORM\Table(name = "utilisateurs")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name = "type", type = "string")
 * @ORM\DiscriminatorMap({
 *      "prestataire" = "Prestataire",
 *      "organisme"   = "Organisme",
 *      "administrateur" = "Administrateur"
 * })
 */
class AbstractUtilisateur implements AdvancedUserInterface, \Serializable
{
    const ROLE_DEFAULT = "ROLE_USER";

    /**
     * @var integer L'identifiant de l'utiliasteur.
     *
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var String L'adresse e-mail du compte.
     *
     * @ORM\Column(
     *      name   = "email",
     *      type   = "string",
     *      length = 255
     * )
     */
    protected $email;

    /**
     * @var String Le salt utilisé pour haché le mot de passe.
     *
     * @ORM\Column(
     *      name   = "salt",
     *      type   = "string",
     *      length = 80
     * )
     */
    protected $salt;

    /**
     * @var String Le mot de passe haché de l'utilisateur.
     *
     * @ORM\Column(
     *      name   = "password",
     *      type   = "string",
     *      length = 128
     * )
     */
    protected $password;

    /**
     * @var Array La liste des rôles de l'utilisateur
     *
     * @ORM\Column(
     *      name = "roles",
     *      type = "array"
     * )
     */
    protected $roles;

    /**
     * @var \DateTime La date d'inscription de l'utilisateur.
     *
     * @ORM\Column(
     *      name = "date_inscription",
     *      type = "datetime"
     * )
     */
    protected $dateInscription;

    /**
     * @var String Le token de validation d'inscription.
     *
     * @ORM\Column(
     *      name     = "email_validation_token",
     *      type     = "string",
     *      length   = 80,
     *      nullable = true
     * )
     */
    protected $token;

    /**
     * @var boolean Validation de l'adresse e-mail effectué?
     *
     * @ORM\Column(
     *      name = "email_valide",
     *      type = "boolean"
     * )
     */
    protected $emailValide;

    /**
     * @var String Le token utilisé pour le reset du mot de passe.
     *
     * @ORM\Column(
     *      name     = "reset_token",
     *      type     = "string",
     *      length   = 128,
     *      nullable = true
     * )
     */
    protected $resetToken;

    /**
     * @var \DateTime La date de demande de reset de mot de passe.
     *
     * @ORM\Column(
     *      name     = "reset_date",
     *      type     = "datetime",
     *      nullable = true
     * )
     */
    protected $resetDate;

    /**
     * Initialisation du salt.
     */
    public function __construct()
    {
        $this->salt = md5(uniqid(null, true));
        $this->token = md5(uniqid(null, true));
        $this->dateInscription = new \DateTime();
        $this->emailValide = false;
        $this->roles = array();
    }

    public function hasRole($role)
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_DEFAULT;

        return in_array($role, $roles);
    }

    /**
     * Retourne la liste des rôles
     */
    public function getRoles()
    {
        $roles = $this->roles;

        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;

        return array_unique($roles);
    }

    /**
     * Initialise les rôles de l'utilisateur
     *
     * @param array $roles La liste des rôles
     * @return $this
     */
    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }

    /**
     * Ajoute un rôle
     *
     * @param $role Le nouveau rôle
     * @return $this
     */
    public function addRole($role)
    {
        $role = strtoupper($role);

        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * Supprime un rôle
     *
     * @param $role La rôle à supprimer
     * @return $this
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    /**
     * Retourne le nom complet d'un utilisateur.
     */
    public function getNomComplet()
    {
        throw new \Exception("The getNomComplet should be implemented in subclasses.");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Serialization de l'entité.
     *
     * @return string
     */
    public function serialize()
    {
        return implode(',', array('id' => $this->id));
    }

    /**
     * Désérialisation.
     *
     * @param string $serialized
     * @return mixed|void
     */
    public function unserialize($serialized)
    {
        $serialized = explode(',', $serialized);
        $this->id = $serialized[0];
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param String $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * @inheritdoc
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return $this->emailValide;
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
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param \DateTime $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param boolean $emailValide
     */
    public function setEmailValide($emailValide)
    {
        $this->emailValide = $emailValide;
    }

    /**
     * @return boolean
     */
    public function getEmailValide()
    {
        return $this->emailValide;
    }

    /**
     * @param String $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return String
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param \DateTime $resetDate
     */
    public function setResetDate($resetDate)
    {
        $this->resetDate = $resetDate;
    }

    /**
     * @return \DateTime
     */
    public function getResetDate()
    {
        return $this->resetDate;
    }

    /**
     * @param String $resetToken
     */
    public function setResetToken($resetToken)
    {
        $this->resetToken = $resetToken;
    }

    /**
     * @return String
     */
    public function getResetToken()
    {
        return $this->resetToken;
    }
}
