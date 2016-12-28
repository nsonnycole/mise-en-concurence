<?php

namespace Flair\UserBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Valide qwue l'adresse email est bien unique.
 */
class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var EntityManager L'entité manager.
     */
    private $em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritdoc
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->em->getRepository('FlairUserBundle:AbstractUtilisateur')->countByEmail($value) != 0) {
            $this->context->addViolation($constraint->message, array());
        }
    }
}
