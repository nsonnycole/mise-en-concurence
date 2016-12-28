<?php

namespace Flair\OrganismeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Formulaire complet d'édition d'une consultation.
 */
class ConsultationType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $etape1 = new ConsultationEtape1Type();
        $etape1->buildForm($builder, $options);

        $etape2 = new ConsultationEtape2Type();
        $etape2->buildForm($builder, $options);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'consultation_form_type';
    }
}
