<?php

namespace Flair\UserBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ExistingEmail extends Constraint
{
    /**
     * @var string Le message d'erreur
     */
    public $message = 'Cette adresse email n\'existe pas';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'flair.validator.existing_email';
    }
}
