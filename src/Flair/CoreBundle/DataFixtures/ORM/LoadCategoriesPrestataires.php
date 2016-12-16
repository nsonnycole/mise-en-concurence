<?php

namespace Flair\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Flair\UserBundle\Entity\CategoriePrestataire;
use Symfony\Component\Yaml\Yaml;

/**
 * Chargement des catégories pour les prestataires.
 */
class LoadCategoriesPrestataires implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $data = Yaml::parse(file_get_contents(__DIR__.'/../../DataFixtures/YAML/categoriesPrestataire.yml'));

        foreach ($data as $nomCategorieMere => $categories) {
            $categorieMere = new CategoriePrestataire();
            $categorieMere->setNom($nomCategorieMere);
            $manager->persist($categorieMere);

            if (is_array($categories)) {
                foreach ($categories as $nomCategorie => $sousCategories) {
                    if (is_array($sousCategories)) {
                        $categorie = new CategoriePrestataire();
                        $categorie->setNom($nomCategorie);
                        $categorie->setParent($categorieMere);
                        $manager->persist($categorie);

                        if (is_array($sousCategories)) {
                            foreach ($sousCategories as $nomSousCategorie) {
                                $sousCategorie = new CategoriePrestataire();
                                $sousCategorie->setNom($nomSousCategorie);
                                $sousCategorie->setParent($categorie);
                                $manager->persist($sousCategorie);
                            }
                        }
                    } else {
                        $categorie = new CategoriePrestataire();
                        $categorie->setNom($sousCategories);
                        $categorie->setParent($categorieMere);
                        $manager->persist($categorie);
                    }
                }
            }
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 101;
    }
}
