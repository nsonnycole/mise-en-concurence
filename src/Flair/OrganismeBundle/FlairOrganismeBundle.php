<?php

namespace Flair\OrganismeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FlairOrganismeBundle extends Bundle
{
    /**
     * Onglet actif : Consultations
     */
    const CONSULTATIONS = 'organisme-consultations';

    /**
     * Onglet actif : Prestataires
     */
    const PRESTATAIRES  = 'organisme-prestataires';

    /**
     * Onglet actif : Services
     */
    const SERVICES = 'organisme-services';

    /**
     * Onglet actif : Mon compte
     */
    const MON_COMPTE = 'organisme-mon-compte';
}
