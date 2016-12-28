<?php

namespace Flair\UserBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Annotation qui valide que l'adresse e-mail est bien unique.
 *
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    /**
     * @var string Le message d'erreur
     */
    public $message = 'Cette adresse email est déjà utilisée';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'flair.validator.unique_email';
    }
}
