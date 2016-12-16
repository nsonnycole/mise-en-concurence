<?php

namespace Flair\UserBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class TypeInvitationChoiceList extends SimpleChoiceList
{
    const INVIT_PRESTATAIRE = 0; // Accessible pour les organismes
    const INVIT_SERVICE = 1; // Accessible pour le role gestionnaire

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::INVIT_PRESTATAIRE => 'prestataire',
                self::INVIT_SERVICE     => 'service',
            ),
            $preferredChoices
        );
    }
}
