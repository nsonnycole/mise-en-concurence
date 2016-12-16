<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Repository de manipulation des catégories.
 */
class CategoriePrestatairesRepository extends EntityRepository
{
    /**
     * Returns the categories which are parentless.
     */
    public function findCategoriesMeres()
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.parent IS NULL')
            ->addOrderBy('c.nom', 'asc');
    }

    public function getAll()
    {
        return $this->createQueryBuilder('c');
    }

    /**
     * Retourne la liste de catégories filles.
     *
     * @param $categorie
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findCategoriesFilles($categorie)
    {
        return $this
            ->createQueryBuilder('c')
            ->innerJoin('c.parent', 'p')
            ->where('p.id = :id')
            ->addOrderBy('c.nom', 'asc')
            ->setParameter('id', $categorie);
    }

    /**
     * Vérifie si la catégorie en question a des catégories filles.
     */
    public function hasCategoriesFilles($categorie)
    {
        return 0 != count($this->findCategoriesFilles($categorie)->getQuery()->getResult());
    }
}
