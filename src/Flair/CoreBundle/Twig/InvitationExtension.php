<?php

namespace Flair\CoreBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * Affichage d'une invitation.
 */
class InvitationExtension extends \Twig_Extension
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
            'invitation' => new \Twig_Filter_Method($this, 'invitation'),
        );
    }

    /**
     * Recherche une invitation par son id.
     *
     * @param integer id L'id de l'invitation
     */
    public function invitation($id)
    {
        return $this->em->getRepository('FlairUserBundle:Invitation')->find($id);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'invitation_extension';
    }
}
