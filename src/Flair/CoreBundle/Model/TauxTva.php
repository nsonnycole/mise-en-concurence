<?php

namespace Flair\CoreBundle\Model;

/**
 */
class TauxTva
{
    /**
     * @return array
     */
    public static function getChoices()
    {
        return array(
            '1.0'   => '0 %',
            '1.055' => '5.5 %',
            '1.1'   => '10 %',
            '1.2'   => '20 %'
        );
    }
}
