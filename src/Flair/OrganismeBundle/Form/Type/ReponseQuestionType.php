<?php

namespace Flair\OrganismeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Reponse d'un organisme à un prestataire.
 */
class ReponseQuestionType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reponseOrganisme', 'ckeditor', array(
            'label' => 'Votre réponse'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'reponse_question_from_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Flair\CoreBundle\Entity\Question',
            'validation_groups' => array('organisme')
        ));
    }
}
