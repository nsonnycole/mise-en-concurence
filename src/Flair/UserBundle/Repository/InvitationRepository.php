<?php

namespace Flair\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Model\FiltreInvitationModel;
use Flair\OrganismeBundle\Model\FiltrePrestataireModel;
use Flair\UserBundle\Entity\Organisme;

/**
 * Repository de manipulation des invitations.
 */
class InvitationRepository extends EntityRepository
{
    /**
     * Retourne la liste des prestataires filtré pour un organisme.
     */
    public function findByFiltreAndOrganisme(FiltrePrestataireModel $filtre, Organisme $organisme)
    {
        $qb = $this->createQueryBuilder('i')
            ->join('i.sender', 'o')
            ->where('o.id = :organisme')
            ->andWhere('i.typeInvitation = :invitationPrestataire')
            ->setParameters(array(
                'organisme' => $organisme->getId(),
                'invitationPrestataire' => Invitation::INVIT_PRESTATAIRE
            ))
            ->addOrderBy('i.nom', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne la liste des services filtré pour un organisme.
     */
    public function findInvitationByFiltreAndSender(FiltreInvitationModel $filtre, AbstractUtilisateur $user)
    {
        $typeInvitation = $filtre->getTruthType($user);

        $qb = $this->createQueryBuilder('i')
            ->join('i.sender', 's')
            ->where('s.id = :sender')
            ->setParameters(array(
                'sender' => $user->getId()
            ))
            ->addOrderBy('i.nom', 'asc');

        if (!is_null($typeInvitation))
        {
            $qb->andWhere("i.typeInvitation = :typeInvitation")
                ->setParameter("typeInvitation", $typeInvitation);
        }

        return $qb->getQuery()->getResult();
    }
}
