<?php

namespace Flair\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Flair\UserBundle\Entity\Administrateur;

/**
 * Chargement des catégories pour les prestataires.
 */
class LoadAdministrateurs implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $admin = new Administrateur();
        $admin->addRole("ROLE_SONATA_ADMIN");
        $admin->addRole("ROLE_SUPER_ADMIN");
        $admin->setNom("Administrateur");
        $admin->setEmail("admin@mise-en-concurrence.com");
        $admin->setEmailValide(true);
        $admin->setPassword("B3gT2Ytf35g8Z6Wy");

        $manager->persist($admin);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 102;
    }
}
