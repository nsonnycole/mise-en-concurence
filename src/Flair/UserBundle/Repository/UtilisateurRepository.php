<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Repository de gestion pour les utilisateurs.
 */
class UtilisateurRepository extends EntityRepository
{
    /**
     * Compte les utilisateurs avec cette adresse email.
     */
    public function countByEmail($email)
    {
        return $this->createQueryBuilder('u')
            ->select('count(u)')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
