<?php

namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class DisponibiliteChoiceList extends SimpleChoiceList
{
    /**
     * @const ASAP As soon as possible availability date.
     */
    const ASAP = 'Dès que possible';

    /**
     * @const LAST At the latest availability date.
     */
    const LAST = 'Au plus tard le';

    /**
     * @const FROM from  availability date.
     */
    const FROM = 'A partir de';

    /**
     * @const DATE at this availability date.
     */
    const DATE = 'A cette date précise';

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::ASAP => self::ASAP,
                self::LAST => self::LAST,
                self::FROM => self::FROM,
                self::DATE => self::DATE,
            ),
            $preferredChoices
        );
    }
}
