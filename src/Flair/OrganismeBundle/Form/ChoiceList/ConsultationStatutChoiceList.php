<?php

namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class ConsultationStatutChoiceList extends SimpleChoiceList
{
    /**
     * @const String La consultation est en brouillon.
     */
    const DRAFT = 0;

    /**
     * @const String La consultation est publié. ie. envoyé aux prestataires.
     */
    const PUBLISHED = 1;

    /**
     * @const String Le prestataire a été selectionné.
     */
    const SELECTED = 2;

    /**
     * @const String La consultation a été démarrée par le prestataire.
     */
    const STARTED = 3;

    /**
     * @const String La consultation a été terminée par le prestataire.
     */
    const FINISHED = 4;

    /**
     * @const String La consultation a été cloturée.
     */
    const CLOSED = 5;

    /**
     * @const String La consultation a été annulée.
     */
    const CANCELLED = -1;

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::DRAFT     => 'brouillon',
                self::PUBLISHED => 'diffusée',
                self::SELECTED  => 'sélectionnée',
                self::STARTED   => 'démarrée',
                self::FINISHED  => 'terminée',
                self::CLOSED    => 'cloturé',
                self::CANCELLED => 'annulée',
            ),
            $preferredChoices
        );
    }
}
