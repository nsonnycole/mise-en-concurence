<?php

namespace Flair\PrestataireBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

/**
 * Creation d'une choicelist avec les statuts de la réponse.
 */
class ReponseStatutChoiceList extends SimpleChoiceList
{
    /**
     * @const integer No answered status
     */
    const WAITING = 1;

    /**
     * @const integer Le prestataire a besoin de plus de precision.
     */
    const NEED_PRECISION = 2;

    /**
     * @const integer Le prestaire accepte de repondre.
     */
    const ANSWERING = 3;

    /**
     * @const integer La reponse est finale et sera transmise à l'organisme.
     */
    const ANSWERED = 4;

    /**
     * @const integer Le prestataire decline la consultation.
     */
    const DECLINE = -1;

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::WAITING        => 'n\'a pas répondu',
                self::NEED_PRECISION => 'en train de répondre',
                self::ANSWERING      => 'a besoin de préçision',
                self::ANSWERED       => 'repondu',
                self::DECLINE        => 'n\'est pas intéressé',
            ),
            $preferredChoices
        );
    }
}
