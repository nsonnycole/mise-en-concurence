<?php

namespace Flair\CoreBundle\Entity;

/**
 * Le perimetre d'intervention du prestataire.
 */
class PerimetreIntervention
{
    /**
     * @const String Intervention locale
     */
    const LOCAL = 'local';

    /**
     * @const String Intervention départementale
     */
    const DEPARTEMENTAL = 'départemental';

    /**
     * @const String Intervention régionale
     */
    const REGIONAL = 'régional';

    /**
     * @const String Intervention nationale.
     */
    const NATIONAL = 'national';

    /**
     * Retourne les choix possibles pour le formulaire d'inscription.
     *
     * @return array
     */
    public static function getChoices()
    {
        return array(
            self::LOCAL         => self::LOCAL,
            self::DEPARTEMENTAL => self::DEPARTEMENTAL,
            self::REGIONAL      => self::REGIONAL,
            self::NATIONAL      => self::NATIONAL
        );
    }
}
