<?php

namespace Flair\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Yaml\Yaml;

use Flair\UserBundle\Entity\CategorieOrganisme;

/**
 * Chargement des catégories des organismes.
 */
class LoadCategoriesOrganismes implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $data = Yaml::parse(file_get_contents(__DIR__.'/../../DataFixtures/YAML/categoriesOrganisme.yml'));

        foreach ($data as $nomCategorieMere => $categories) {
            $categorieMere = new CategorieOrganisme();
            $categorieMere->setNom($nomCategorieMere);
            $manager->persist($categorieMere);

            foreach ($categories as $nomCategorie) {
                $categorie = new CategorieOrganisme();
                $categorie->setNom($nomCategorie);
                $categorie->setParent($categorieMere);
                $manager->persist($categorie);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 100;
    }
}
