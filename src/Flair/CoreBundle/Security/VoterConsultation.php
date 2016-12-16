<?php

namespace Flair\CoreBundle\Security;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\CoreBundle\Entity\Consultation;
use Flair\UserBundle\Entity\Prestataire;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class VoterConsultation implements VoterInterface
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    public function supportsClass($class)
    {
        $supportedClass = 'Flair\CoreBundle\Entity\Consultation';

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

    public function vote(TokenInterface $token, $consultation, array $attributes)
    {
        // check if the class of this object is supported by this voter
        if (!$this->supportsClass(get_class($consultation))) {
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
                return $this->canView($user, $consultation);
                break;

            case self::EDIT:
                return $this->canEdit($user, $consultation);
                break;

            case self::DELETE:
                return $this->canDelete($user, $consultation);
                break;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canView(AbstractUtilisateur $user, Consultation $consultation)
    {
        if ($consultation->getOrganisme() === $user->getId() ||
            $this->consultationContainsPresta($consultation, $user)) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canEdit(AbstractUtilisateur $user, Consultation $consultation)
    {
        if ($consultation->getOrganisme() === $user->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function canDelete(AbstractUtilisateur $user, Consultation $consultation)
    {
        if ($consultation->getOrganisme() === $user->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }

    private function consultationContainsPresta(Consultation $consultation, Prestataire $presta)
    {
        $responses = $consultation->getReponses();

        foreach ($responses as $response)
        {
            if ($response->getPrestataire()->getId() === $presta->getId()) {
                return true;
            }
        }

        return false;
    }
}