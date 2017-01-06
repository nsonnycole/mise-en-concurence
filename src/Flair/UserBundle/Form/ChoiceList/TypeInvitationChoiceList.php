<?php

namespace Flair\UserBundle\Form\ChoiceList;

use Symfony\Component\Form\ChoiceList\View\ChoiceListView;

class TypeInvitationChoiceList extends ChoiceListView
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
                'prestataire' => self::INVIT_PRESTATAIRE,
                'service' => self::INVIT_SERVICE,
            ),
            $preferredChoices
        );
    }
}
