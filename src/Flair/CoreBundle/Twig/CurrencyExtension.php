<?php

namespace Flair\CoreBundle\Twig;

/**
 * Affichage en une ligne de la categorie.
 */
class CurrencyExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'euros' => new \Twig_Filter_Method($this, 'euros')
        );
    }

    /**
     * Affiche le montant en euros avec virgule tout ca.
     */
    public function euros($euros)
    {
        return number_format($euros, 0, ',', ' ') . ' €';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'euros_extension';
    }
}
