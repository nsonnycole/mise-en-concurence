<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Entity\Organisme;
use Flair\OrganismeBundle\Model\FiltrePrestataireModel;

/**
 * Surcharge des methodes de manipulation du prestataire.
 */
class PrestataireRepository extends EntityRepository
{
    /**
     * Retourne la liste des prestataires filtré pour un organisme.
     */
    public function findByFiltreAndOrganisme(FiltrePrestataireModel $filtre, Organisme $organisme)
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.organismes', 'o')
            ->where('o.id = :organisme')
            ->setParameter('organisme', $organisme->getId())
            ->addOrderBy('p.nom', 'asc');

        if ($filtre->getCategorie() != null) {
            $qb->join('p.categories', 'c')
                ->andWhere('c = :categorie')
                ->setParameter('categorie', $filtre->getCategorie()->getId());
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne le nombre de prestataire pour un organisme.
     *
     * @param integer idOrganisme L'id de l'organisme.
     */
    public function countByOrganisme(Organisme $organisme)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->join('p.organismes', 'o')
            ->where('o.id = :organisme')
            ->setParameter('organisme', $organisme)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Retourne le nombre de prestataires pour des catégories données.
     */
    public function countByCategories($categories)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p)')
            ->leftJoin('p.categories', 'c')
            ->where('c.id in (:cats)')
            ->setParameter('cats', $categories)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findService($prestataire)
    {
        $qb = $this->createQueryBuilder("p")
                    ->where("p.entreprise = :entreprise")
                    ->setParameter("entreprise", $prestataire->getEntreprise());

        return $qb->getQuery()->getResult();
    }

    public function findGestionnaire($siren)
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.entreprise', 'e')
            ->where("e.siren = :siren")
            ->setParameter("siren", $siren);

        return $qb->getQuery()->getResult();
    }
}
