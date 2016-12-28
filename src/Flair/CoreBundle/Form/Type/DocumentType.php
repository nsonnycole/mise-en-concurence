<?php

namespace Flair\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Type de formulaire pour les documents.
 */
class DocumentType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array(
                'label' => 'Nom du document',
            ))
            ->add('document', 'file', array(
                'label' => 'Fichier à uploader',
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'document_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Flair\CoreBundle\Entity\Document'));
    }
}
