<?php

namespace Flair\UserBundle\Model;

use Flair\CoreBundle\Entity\CategoriePrestataire;

class FiltreInvitationModel
{
    private $typeInvitation;

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

    public function getTruthType($user)
    {
        if (is_null($this->typeInvitation)) {
            return null;
        }
        else if ($user instanceof Organisme)
        {
            if ($this->typeInvitation === TypeInvitationChoiceList::INVIT_PRESTATAIRE) {
                return InvitationEntity::INVIT_PRESTATAIRE;
            } else {
                return InvitationEntity::INVIT_SERVICE_ORGANISME;
            }
        }
        else if ($user instanceof Prestataire)
        {
            if ($this->typeInvitation === TypeInvitationChoiceList::INVIT_PRESTATAIRE) {
                return InvitationEntity::INVIT_PRESTATAIRE;
            } else {
                return InvitationEntity::INVIT_SERVICE_PRESTATAIRE;
            }
        }
        else {
            throw new \Exception("This user is not managed");
        }
    }
}
