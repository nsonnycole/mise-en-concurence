<?php

namespace Flair\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\CoreBundle\Entity\Consultation;

/**
 * Gestion des question.
 */
class QuestionRepository extends EntityRepository
{
    /**
     * Retourne les questions pour une consultation.
     */
    public function findForConsultation(Consultation $consultation)
    {
        return $this->createQueryBuilder('q')
            ->join('q.reponse', 'r')
            ->where('r.consultation = :consultation')
            ->addOrderBy('q.dateQuestion', 'desc')
            ->setParameter('consultation', $consultation->getId())
            ->getQuery()
            ->getResult();
    }

    /**
     * Retourne les questions pour une consultation.
     */
    public function countForConsultation(Consultation $consultation)
    {
        return $this->createQueryBuilder('q')
            ->select('count(q.id)')
            ->join('q.reponse', 'r')
            ->where('r.consultation = :consultation')
            ->addOrderBy('q.dateQuestion', 'desc')
            ->setParameter('consultation', $consultation->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Retourne les questions pour une consultation.
     */
    public function countUnansweredForConsultation(Consultation $consultation)
    {
        return $this->createQueryBuilder('q')
            ->select('count(q.id)')
            ->join('q.reponse', 'r')
            ->where('r.consultation = :consultation')
            ->andWhere('r.dateReponse is NULL')
            ->addOrderBy('q.dateQuestion', 'desc')
            ->setParameter('consultation', $consultation->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }
}
