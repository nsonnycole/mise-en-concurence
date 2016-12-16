<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Repository de manipulation des catégories.
 */
class CategorieOrganismesRepository extends EntityRepository
{
    /**
     * Returns the categories which are parentless.
     */
    public function findCategoriesMeres()
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.parent IS NULL');
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
            ->setParameter('id', $categorie);
    }
}
