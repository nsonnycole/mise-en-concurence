<?php

namespace Flair\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Entity\Prestataire;
use Flair\CoreBundle\Entity\Reponse;
use Flair\PrestataireBundle\Model\FiltrePropositionModel;

/**
 * Repository des propositions.
 */
class ReponseRepository extends EntityRepository
{
    /**
     * Filtrage des propositions par cirteres.
     */
    public function findByFiltreAndPrestataire(FiltrePropositionModel $filtre, Prestataire $prestataire)
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.consultation', 'c')
            ->where('p.prestataire = :prestataire')
            ->orderBy('p.statut')
            ->setParameter('prestataire', $prestataire);

        if ($filtre->getOrganisme() != null) {
            $qb
                ->andWhere('c.organisme = :organisme')
                ->setParameter('organisme', $filtre->getOrganisme()->getId());
        }

        if ($filtre->getDateDebut() != null) {
            $qb
                ->andWhere('c.dateLimite >= :dateDebut')
                ->setParameter('dateDebut', $filtre->getDateDebut());
        }

        if ($filtre->getDateFin() != null) {
            $qb
                ->andWhere('c.dateLimite <= :dateFin')
                ->setParameter('dateFin', $filtre->getDateFin());
        }

        if ($filtre->getMontantMin() != null) {
            $qb
                ->andWhere('p.montantHt >= :prixMinimum')
                ->setParameter('prixMinimum', $filtre->getMontantMin());
        }

        if ($filtre->getMontantMax() != null) {
            $qb
                ->andWhere('p.montantHt <= :prixMaximum')
                ->setParameter('prixMaximum', $filtre->getMontantMax());
        }

        if ($filtre->getStatut() !== null) {
            $qb
                ->andWhere('p.statut = :statut')
                ->setParameter('statut', $filtre->getStatut());
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Récupère le nombre de reponses moyen pour une consultation.
     *
     * @param integer idOrganisme L'id de l'organisme.
     */
    public function getAVGNumberReponses($idOrganisme)
    {
        return $this->createQueryBuilder('r')
            ->select('count(r)/count(c)')
            ->leftJoin('r.consultation', 'c')
            ->where('c.organisme = :idOrganisme')
            ->setParameter('idOrganisme', $idOrganisme)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Récupère le classement des réponses par rapport aux critères de la consultation.
     *
     * @param integer consultation La consultation.
     */
    public function getReponseRanking($consultation)
    {
        $qb = $this->createQueryBuilder('r')
            ->select('r as infos')
            ->addSelect('(c.prixMaximum - c.prixMinimum) / r as diff')
            ->leftJoin('r.consultation', 'c')
            ->where('r.statut = :statut')
            ->andWhere('r.consultation = :consultation')
            ->orderBy('diff')
            ->setParameter('statut', Reponse::ANSWERED)
            ->setParameter('consultation', $consultation)
            ->getQuery()
            ->getResult();

        return $qb;
    }
}
