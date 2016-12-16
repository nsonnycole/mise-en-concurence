<?php

namespace Flair\PrestataireBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire pour poser une question.
 */
class QuestionFormType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array(
                'label' => 'Objet de votre question'
            ))
            ->add('question', 'ckeditor', array(
                'label' => 'Votre question'
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'question_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'       => 'Flair\CoreBundle\Entity\Question',
            'validation_groups' => array('prestataire')
        ));
    }
}
