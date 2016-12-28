<?php

namespace Flair\PrestataireBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FlairPrestataireBundle extends Bundle
{
    /**
     * @const String Onglet actif : mes demandes
     */
    const PROPOSITIONS = 'prestataires-propositions';

    /**
     * @const String Onglet actif ; mon compte.
     */
    const MON_COMPTE = 'prestataires-mon-compte';
}
