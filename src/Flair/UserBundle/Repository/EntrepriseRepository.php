<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EntrepriseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EntrepriseRepository extends EntityRepository
{
    public function findBySiren($siren)
    {
        $qb = $this->createQueryBuilder("e")
                    ->where("e.siren = :siren")
                    ->setParameter("siren", $siren);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
