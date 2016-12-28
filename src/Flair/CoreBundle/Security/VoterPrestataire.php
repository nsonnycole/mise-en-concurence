<?php

namespace Flair\CoreBundle\Security;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Prestataire;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class VoterPrestataire implements VoterInterface
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function supportsClass($class)
    {
        $supportedClass = 'Flair\UserBundle\Entity\Prestataire';

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

    public function vote(TokenInterface $token, $prestataire, array $attributes)
    {
        // check if the class of this object is supported by this voter
        if (!$this->supportsClass(get_class($prestataire))) {
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
                return $this->canView($user, $prestataire);
                break;

            case self::EDIT:
                return $this->canEdit($user, $prestataire);
                break;

            case self::DELETE:
                return $this->canDelete($user, $prestataire);
                break;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canView(AbstractUtilisateur $user, Prestataire $prestataire)
    {
        $entreprise = $prestataire->getEntreprise();

        if ($entreprise->getId() === $user->getEntreprise()->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        $organismes = $prestataire->getOrganismes();

        foreach ($organismes as $organisme) {
            if ($organisme->getId() === $user->getId()) {
                return VoterInterface::ACCESS_GRANTED;
            }
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canEdit(AbstractUtilisateur $user, Prestataire $prestataire)
    {
        $entreprise = $prestataire->getEntreprise();

        if ($entreprise->getId() === $user->getEntreprise()->getId() && $user->hasRole("ROLE_GESTIONNAIRE")) {
            return VoterInterface::ACCESS_GRANTED;
        }

        if ($user->getId() === $prestataire->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canDelete(AbstractUtilisateur $user, Prestataire $prestataire)
    {
        if ($this->canEdit($user, $prestataire) && $user->getId() !== $prestataire->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }
}