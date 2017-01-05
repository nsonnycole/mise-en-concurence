<?php


namespace Flair\OrganismeBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class ConsultationsCriteresChoiceList extends SimpleChoiceList
{
    public function __construct()
    {
        parent::__construct(
            array(
                'prix'     => 'prix',
                'delai'     => 'delai',
                'consultation'   => 'consultation',
            )
        );
    }

}