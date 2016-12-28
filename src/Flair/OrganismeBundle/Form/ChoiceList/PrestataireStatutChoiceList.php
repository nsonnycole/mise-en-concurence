<?php

namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class PrestataireStatutChoiceList extends SimpleChoiceList
{
    /**
     * @const String Le prestataire est confirmé.
     */
    const CONFIRMED = 0;

    /**
     * @const String Le prestataire est invité.
     */
    const INVITED = 1;

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::CONFIRMED => 'confirmé',
                self::INVITED   => 'invité',
            ),
            $preferredChoices
        );
    }
}
