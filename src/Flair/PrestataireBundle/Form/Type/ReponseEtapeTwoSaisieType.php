<?php

namespace Flair\PrestataireBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Saisie du devis en ligne.
 */
class ReponseEtapeTwoSaisieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lignesDevis', 'collection', array(
            'type'         => new LigneDevisType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'prototype'    => true,
            'by_reference' => false,
            'error_bubbling' => false
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'etape_2_saisie_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\CoreBundle\Entity\Reponse',
            'validation_groups' => array('no_documents', 'Default')
        ));
    }
}
