<?php

namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\ChoiceList\View\ChoiceListView;

class ConsultationStatutChoiceList extends ChoiceListView
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
                'brouillon' => self::DRAFT,
                'diffusée' => self::PUBLISHED,
                'sélectionnée' => self::SELECTED,
                'démarrée' => self::STARTED,
                'terminée' => self::FINISHED,
                'cloturé' => self::CLOSED,
                'annulée' => self::CANCELLED,
            ),
            $preferredChoices
        );
    }

    /**
    * function
    *
    * Return le taleau définie dans le construct
    **/
    public function GetChoices(){
        return $this->choices;
    }
}
