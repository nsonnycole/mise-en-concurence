<?php

namespace Flair\OrganismeBundle\Form\Type;

use Flair\OrganismeBundle\Form\ChoiceList\PrestataireStatutChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Filtre sur les prestataires.
 */
class FiltreServiceType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut', 'choice', array(
                'required'    => false,
                'label'       => 'Statut',
                'choice_list' => new PrestataireStatutChoiceList(),
                'empty_value' => 'Selectionnez un statut',
                'required'    => false
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'filtre_service_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\OrganismeBundle\Model\FiltreServiceModel'
        ));
    }
}
