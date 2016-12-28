<?php

namespace Flair\CoreBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * Permets la récuperation.
 */
class PrestataireExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'prestataire' => new \Twig_Filter_Method($this, 'prestataire'),
        );
    }

    /**
     *
     */
    public function prestataire($id)
    {
        return $this->em->getRepository('FlairUserBundle:Prestataire')->find($id);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'prestataire_extension';
    }
}
