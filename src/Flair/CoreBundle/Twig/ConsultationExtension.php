<?php

namespace Flair\CoreBundle\Twig;

use Flair\CoreBundle\Entity\Consultation;

/**
 * Quelques helpers twig pour l'affichage.
 */
class ConsultationExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'consultation_statut' => new \Twig_Filter_Method($this, 'consultationStatut'),
        );
    }

    /**
     * Affiche en fonction du statut le label appropriée.
     *
     * @param $statut La statut a afficher.
     * @return string
     */
    public function consultationStatut($statut)
    {
        switch ($statut) {
            case Consultation::DRAFT:
                return 'brouillon';

            case Consultation::PUBLISHED:
                return 'diffusée';

            case Consultation::SELECTED:
                return 'sélectionnée';

            case Consultation::STARTED:
                return 'démarrée';

            case Consultation::FINISHED:
                return 'terminée';

            case Consultation::CANCELLED:
                return 'annulée';

            case Consultation::CLOSED:
                return 'cloturée';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'consultation_extension';
    }
}
