<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Entity\Organisme;

/**
 * Surcharge des methodes de manipulation de l'organisme.
 */
class OrganismeRepository extends EntityRepository
{
    /**
     * Retourne la liste des organismes filtré pour un organisme.
     */
    public function findServiceByOrganisme(Organisme $organisme)
    {
        $qb = $this->createQueryBuilder('o')
            ->join('o.organisme', 'org')
            ->where('org.id = :organisme')
            ->setParameter('organisme', $organisme->getId())
            ->addOrderBy('o.nom', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne le nombre de prestataires pour un organisme.
     */
    public function countPrestataires($idOrganisme)
    {
        return $this->createQueryBuilder('o')
            ->select('count(p)')
            ->leftJoin('o.prestataires', 'p')
            ->where('o.id = :idOrganisme')
            ->setParameter('idOrganisme', $idOrganisme)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Retourne le nombre d'orgainsmes pour des catégories données.
     */
    public function countByCategories($categories)
    {
        return $this->createQueryBuilder('o')
            ->select('count(o)')
            ->leftJoin('o.categorie', 'c')
            ->where('c.id in (:cats)')
            ->setParameter('cats', $categories)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findService($organisme)
    {
        $qb = $this->createQueryBuilder("p")
            ->where("p.entreprise = :entreprise")
            ->setParameter("entreprise", $organisme->getEntreprise());

        return $qb->getQuery()->getResult();
    }

    public function findGestionnaire($siren)
    {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.entreprise', 'e')
            ->where("e.siren = :siren")
            ->setParameter("siren", $siren);

        return $qb->getQuery()->getResult();
    }
}
