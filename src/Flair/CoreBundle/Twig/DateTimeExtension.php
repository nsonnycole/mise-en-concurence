<?php

namespace Flair\CoreBundle\Twig;

use Flair\CoreBundle\Exceptions\UnsupportedTypeException;

class DateTimeExtension extends \Twig_Extension
{
    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'before_now' => new \Twig_Filter_Method($this, 'beforeNow'),
            'after_now'  => new \Twig_Filter_Method($this, 'afterNow'),
            'date_diff'  => new \Twig_Filter_Method($this, 'dateDiff'),
        );
    }

    /**
     * Retourne vrai si la date est antérieure à la date du jour.
     */
    public function beforeNow($date)
    {
        if (!$date instanceof \DateTime) {
            throw new UnsupportedTypeException();
        }

        $now = new \DateTime();
        $now->setTime(00, 00, 01);
        $date->setTime(23, 59, 59);

        return $now > $date;
    }

    /**
     * Retourne vrai si la date est postérieure à la date du jour.
     */
    public function afterNow($date)
    {
        if (!$date instanceof \DateTime) {
            throw new UnsupportedTypeException();
        }

        $now = new \DateTime();
        $now->setTime(00, 00, 01);
        $date->setTime(23, 59, 59);

        return $now < $date;
    }

    /**
     * Retourne la différence de jour entre 2 dates.
     */
    public function dateDiff($startDate, $endDate)
    {
        $startDate = new \DateTime($startDate);
        $startDate->setTime(00, 00, 01);
        $endDate = new \DateTime($endDate);
        $endDate->setTime(23, 59, 59);
        $diff = date_diff($startDate, $endDate);

        return $diff->format('%a');
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'flair_time_extension';
    }
}
