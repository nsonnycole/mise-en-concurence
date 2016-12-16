<?php

namespace Flair\OrganismeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Formulaire pour le changement de mot de passe.
 */
class MotdepasseType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motdepasse', 'repeated', array(
                'type'           => 'password',
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'motdepasse_form_type';
    }
}
