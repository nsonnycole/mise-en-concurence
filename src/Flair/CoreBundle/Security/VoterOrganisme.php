<?php

namespace Flair\CoreBundle\Security;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Organisme;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class VoterOrganisme implements VoterInterface
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function supportsClass($class)
    {
        $supportedClass = 'Flair\UserBundle\Entity\Organisme';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    public function supportsAttribute($attribute)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::DELETE))) {
            return false;
        }

        return true;
    }

    public function vote(TokenInterface $token, $organisme, array $attributes)
    {
        // check if the class of this object is supported by this voter
        if (!$this->supportsClass(get_class($organisme))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        if ($user->hasRole("ROLE_SUPER_ADMIN")) {
            return VoterInterface::ACCESS_GRANTED;
        }

        $access = $attributes[0];

        switch ($access)
        {
            case self::VIEW:
                return $this->canView($user, $organisme);
                break;

            case self::EDIT:
                return $this->canEdit($user, $organisme);
                break;

            case self::DELETE:
                return $this->canDelete($user, $organisme);
                break;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canView(AbstractUtilisateur $user, Organisme $organisme)
    {
        $entreprise = $organisme->getEntreprise();

        if ($entreprise->getId() === $user->getEntreprise()->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canEdit(AbstractUtilisateur $user, Organisme $organisme)
    {
        if ($this->canView($user, $organisme) && $user->hasRole("ROLE_GESTIONNAIRE")) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canDelete(AbstractUtilisateur $user, Organisme $organisme)
    {
        if ($this->canEdit($user, $organisme) && $user->getId() !== $organisme->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }
}