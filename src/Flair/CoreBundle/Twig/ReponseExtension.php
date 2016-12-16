<?php

namespace Flair\CoreBundle\Twig;

use Flair\CoreBundle\Entity\Consultation;
use Flair\CoreBundle\Entity\Reponse;

class ReponseExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        parent::getFilters();

        return array(
            'reponse_statut' => new \Twig_Filter_Method($this, 'reponseStatut'),
        );
    }

    /**
     * Affiche le statut de la reponse.
     */
    public function reponseStatut(Reponse $reponse)
    {
        // Dans le cas d'une consultation annulé, ca prends le dessus par rapport au statut prestataire.
        if ($reponse->getConsultation()->getStatut() == Consultation::CANCELLED) {
            return 'Consultation annulée';
        }

        switch ($reponse->getStatut()) {
            case Reponse::WAITING:
                return 'n\'a pas répondu';

            case Reponse::DRAFT:
                return 'Brouillon';

            case Reponse::DECLINE:
                return 'Proposition déclinée';

            case Reponse::ANSWERED:
                return 'répondu';
        }
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'reponse_extension';
    }
}
