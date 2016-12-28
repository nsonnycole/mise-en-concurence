<?php

namespace Flair\OrganismeBundle\Form\Type;

use Flair\OrganismeBundle\Form\ChoiceList\ConsultationStatutChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Filtre sur les consultations.
 */
class FiltreConsultationType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', 'entity', array(
                'label'       => '',
                'class'       => 'FlairUserBundle:CategoriePrestataire',
                'property'    => 'fullName',
                'empty_value' => 'Sélectionnez votre catégorie',
                'required'    => false
            ))
            ->add('dateDebut', 'date', array(
                'label'    => '',
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'required' => false,
                'attr'     => array(
                    'class'       => 'js_datepicker',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('dateFin', 'date', array(
                'label'    => '',
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'required' => false,
                'attr'     => array(
                    'class'       => 'js_datepicker',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('statut', 'choice', array(
                'required'    => false,
                'choice_list' => new ConsultationStatutChoiceList(),
                'required'    => false,
                'empty_value' => 'Sélectionnez le statut'
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'filtre_consultation_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\OrganismeBundle\Model\FiltreConsultationModel'
        ));
    }
}
