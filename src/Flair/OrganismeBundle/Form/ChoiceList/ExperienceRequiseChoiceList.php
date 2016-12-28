<?php

namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class ExperienceRequiseChoiceList extends SimpleChoiceList
{
    /**
     * @const LESS_THAN_ONE_YEAR Less than one year experience required.
     */
    const LESS_THAN_ONE = "moins d'un an";

    /**
     * @const ONE_TO_THREE_YEAR Between 1 and 3 years experience required.
     */
    const MORE_THAN_ONE = 'plus de 1 an';

    /**
     * @const THREE_TO_FIVE_YEAR Between 3 and 5 years experience required.
     */
    const MORE_THAN_THREE = 'plus de 3 ans';

    /**
     * @const FIVE_TO_TEN_YEAR Between 5 and 10 years experience required.
     */
    const MORE_THAN_FIVE = 'plus de 5 ans';

    /**
     * @const TEN_TO_FIFTEEN_YEAR Between 10 and 15 years experience required.
     */
    const MORE_THAN_TEN = 'plus de 10 ans';

    /**
     * @const MORE_THAN_FIFTEEN_YEAR More than 15 years experience required.
     */
    const MORE_THAN_FIFTEEN = 'plus de 15 ans';

    /**
     * Constructor.
     *
     * @param array $preferredChoices Preferred choices in the list.
     */
    public function __construct(array $preferredChoices = array())
    {
        parent::__construct(
            array(
                self::LESS_THAN_ONE     => self::LESS_THAN_ONE,
                self::MORE_THAN_ONE     => self::MORE_THAN_ONE,
                self::MORE_THAN_THREE   => self::MORE_THAN_THREE,
                self::MORE_THAN_FIVE    => self::MORE_THAN_FIVE,
                self::MORE_THAN_TEN     => self::MORE_THAN_TEN,
                self::MORE_THAN_FIFTEEN => self::MORE_THAN_FIFTEEN,
            ),
            $preferredChoices
        );
    }
}
