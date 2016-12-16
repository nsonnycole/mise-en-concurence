<?php

namespace Flair\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Une invitation envoyé par un Utilisateur à un autre Utilisateur pour rejoindre le reseau.
 *
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\InvitationRepository")
 * @ORM\Table(name = "invitations")
 */
class Invitation
{
    const INVIT_PRESTATAIRE = 0;
    const INVIT_SERVICE_ORGANISME = 1;
    const INVIT_SERVICE_PRESTATAIRE = 2;

    const WAITING = 0;
    const ACCEPTED = 1;
    const REFUSED = 2;

    /**
     * @var integer L'identifiant de l'invitation.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *      name = "id_invitation",
     *      type = "integer"
     * )
     */
    private $id;

    /**
     * @var String Le nom de l'utilisateur invité.
     *
     * @ORM\Column(
     *      name = "nom",
     *      type = "string"
     * )
     *
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @var String L'adresse email utilisé pour l'invitation.
     *
     * @ORM\Column(
     *      name = "email",
     *      type = "string"
     * )
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var \DateTime La date de l'invitation.
     *
     * @ORM\Column(
     *      name = "date_invitation",
     *      type = "datetime"
     * )
     */
    private $dateInvitation;

    /**
     * @var AbstractUtilisateur
     *
     * @ORM\ManyToOne(targetEntity = "Flair\UserBundle\Entity\AbstractUtilisateur")
     * @ORM\JoinColumn(name = "id_utilisateur", onDelete = "cascade")
     */
    private $sender;

    /**
     * @var String Le token unique associé à l'invitation.
     *
     * @ORM\Column(
     *      name   = "token",
     *      type   = "string",
     *      length = 32
     * )
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(
     *      name = "type_invitation",
     *      type = "smallint"
     * )
     */
    private $typeInvitation;

    /**
     * @var integer
     *
     * @ORM\Column(
     *      name = "status",
     *      type = "smallint"
     * )
     */
    private $status;

    /**
     * Constructeur pour l'initialization du token.
     */
    public function __construct()
    {
        $this->token = md5(uniqid(null, true));
        $this->dateInvitation = new \DateTime();
        $this->status = self::WAITING;
    }

    /**
     * @param \DateTime $dateInvitation
     */
    public function setDateInvitation($dateInvitation)
    {
        $this->dateInvitation = $dateInvitation;
    }

    /**
     * @return \DateTime
     */
    public function getDateInvitation()
    {
        return $this->dateInvitation;
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @param \Flair\UserBundle\Entity\AbstractUtilisateur $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return \Flair\UserBundle\Entity\AbstractUtilisateur
     */
    public function getSender()
    {
        return $this->sender;
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
     * @return int
     */
    public function getTypeInvitation()
    {
        return $this->typeInvitation;
    }

    /**
     * @param int $typeInvitation
     */
    public function setTypeInvitation($typeInvitation)
    {
        if (in_array($typeInvitation, array(self::INVIT_PRESTATAIRE, self::INVIT_SERVICE_ORGANISME, self::INVIT_SERVICE_PRESTATAIRE))) {
            $this->typeInvitation = $typeInvitation;
        }

        return $this;
    }

    public function getStringStatus()
    {
        switch($this->status)
        {
            case self::WAITING:
                return 'En attente';

            case self::REFUSED:
                return 'Refusée';

            case self::ACCEPTED:
                return 'Acceptée';

            default:
                return 'Inconnue';
        }
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        if (in_array($status, array(self::WAITING, self::ACCEPTED, self::REFUSED))) {
            $this->status = $status;
        }

        return $this;
    }
}
