<?php

namespace Flair\UserBundle\Model;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Invitation as InvitationEntity;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;
use Flair\UserBundle\Form\ChoiceList\TypeInvitationChoiceList;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model pour le changement de mot de passe.
 */
class Invitation
{
    /**
     * @var String Le nom de l'utilisateur invité.
     *
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @var String L'adresse email utilisé pour l'invitation.
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var Integer Le type d'invitation
     *
     * @Assert\NotBlank
     */
    private $typeInvitation;

    public function toInvitation($sender)
    {
        $invitation = new InvitationEntity();
        $invitation->setEmail($this->email);
        $invitation->setNom($this->nom);
        $invitation->setSender($sender);

        if ($sender instanceof Organisme)
        {
            if ($this->typeInvitation === TypeInvitationChoiceList::INVIT_PRESTATAIRE) {
                $invitation->setTypeInvitation(InvitationEntity::INVIT_PRESTATAIRE);
            } else {
                $invitation->setTypeInvitation(InvitationEntity::INVIT_SERVICE_ORGANISME);
            }
        }
        else if ($sender instanceof Prestataire)
        {
            if ($this->typeInvitation === TypeInvitationChoiceList::INVIT_PRESTATAIRE) {
                $invitation->setTypeInvitation(InvitationEntity::INVIT_PRESTATAIRE);
            } else {
                $invitation->setTypeInvitation(InvitationEntity::INVIT_SERVICE_PRESTATAIRE);
            }
        }
        else {
            throw new \Exception("This user is not managed");
        }

        return $invitation;
    }

    /**
     * @return String
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param String $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
    public function getTypeInvitation()
    {
        return $this->typeInvitation;
    }

    /**
     * @param mixed $typeInvitation
     */
    public function setTypeInvitation($typeInvitation)
    {
        $this->typeInvitation = $typeInvitation;
    }
}
