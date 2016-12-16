<?php

namespace Flair\CoreBundle\Events;

/**
 * Evenements liés aux consultations.
 */
class ConsultationEvents
{
    /**
     * @const String une invitation a la consultation.
     */
    const DIFFUSION = 'flair.event.consultation.diffusion';

    /**
     * @const String Annulation de la consultation.
     */
    const ANNULLATION = 'flair.event.consultation.annulation';

    /**
     * @const String Une nouvelle reponse a été apportée.
     */
    const NEW_REPONSE = 'flair.event.consultation.new_reponse';

    /**
     * @const String Une réponse a été sélectionnée.
     */
    const REPONSE_SELECTED = 'flair.event.consultation.reponse_selected';
}
