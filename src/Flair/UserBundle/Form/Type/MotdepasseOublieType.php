<?php

namespace Flair\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Le formulaire de demande de re-initialisation du mot de passe.
 */
class MotdepasseOublieType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array(
            'label' => 'Votre adresse email'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'motdepasse_oublie_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\UserBundle\Model\MotdepasseOublie'
        ));
    }
}
