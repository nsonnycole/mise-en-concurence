<?php

namespace Flair\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Entity\Organisme;
use Flair\OrganismeBundle\Model\FiltreConsultationModel;

/**
 * Repository des consultations.
 */
class ConsultationRepository extends EntityRepository
{
    /**
     * Filtre les consultations en fonction du filtre.
     */
    public function findByFiltreAndOrganisme(FiltreConsultationModel $filtre, Organisme $organisme)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.organisme = :organisme')
            ->setParameter('organisme', $organisme->getId());

        if ($filtre->getCategorie() != null) {
            $qb->join('c.categorie', 'cp');
            $qb->andWhere(
                $qb->expr()->orx(
                    $qb->expr()->eq('c.categorie', ':categorie'),
                    $qb->expr()->eq('cp.parent', ':categorie')
                )
            );

            $qb->setParameter('categorie', $filtre->getCategorie()->getId());
        }

        if ($filtre->getStatut() !== null) {
            $qb->andWhere('c.statut = :statut')
                ->setParameter('statut', $filtre->getStatut());
        }

        if ($filtre->getDateDebut() != null) {
            $qb->andWhere('c.dateCreation >= :dateDebut')
                ->setParameter('dateDebut', $filtre->getDateDebut());
        }

        if ($filtre->getDateFin() != null) {
            $qb->andWhere('c.dateCreation <= :dateFin')
                ->setParameter('dateFin', $filtre->getDateFin());
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Récupère le nombre de consultations pour un organisme.
     *
     * @param integer idOrganisme L'id de l'organisme.
     */
    public function countConsultations($idOrganisme)
    {
        return $this->createQueryBuilder('c')
            ->select('count(c)')
            ->where('c.organisme = :organisme')
            ->setParameter('organisme', $idOrganisme)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Récupère le budget moyen pour un organisme.
     *
     * @param integer idOrganisme L'id de l'organisme.
     */
    public function getAVGBudget($idOrganisme)
    {
        $nbConsultations = $this->countConsultations($idOrganisme);

        return $this->createQueryBuilder('c')
            ->select('((SUM(c.prixMinimum) + SUM(c.prixMaximum))/2)/:nbConsultations')
            ->where('c.organisme = :organisme')
            ->setParameter('organisme', $idOrganisme)
            ->setParameter('nbConsultations', $nbConsultations)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Retourne le nombre de prestataire moyen par consultation pour un organisme.
     *
     * @param integer idOrganisme L'id de l'organisme.
     */
    public function countAVGPrestataires($idOrganisme)
    {
        return $this->createQueryBuilder('c')
            ->select('count(r.prestataire)/count(c)')
            ->join('c.reponses', 'r')
            ->where('c.organisme = :organisme')
            ->setParameter('organisme', $idOrganisme)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getStatsConsultation($idOrganisme)
    {
        $qb =  $this->createQueryBuilder('c')
            ->select('count(cat) as nbCat')
            ->addSelect('cat.nom')
            ->leftJoin('c.categorie', 'cat')
            ->where('c.organisme = :organisme')
            ->addGroupBy('c.categorie')
            ->setParameter('organisme', $idOrganisme)
            ->getQuery()
            ->getResult();

        return $qb;
    }
}
