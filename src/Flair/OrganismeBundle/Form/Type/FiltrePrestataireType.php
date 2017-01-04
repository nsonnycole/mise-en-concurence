<?php

namespace Flair\OrganismeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Filtre sur les prestataires.
 */
class FiltrePrestataireType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', 'entity', array(
                'label'         => 'Secteur d\'activité',
                'class'         => 'FlairUserBundle:CategoriePrestataire',
                'choice_label'      => 'fullName',
                'placeholder'   => 'Selectionnez votre secteur d\'activité',
                'required'      => false
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'filtre_prestataire_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\OrganismeBundle\Model\FiltrePrestataireModel'
        ));
    }
}
