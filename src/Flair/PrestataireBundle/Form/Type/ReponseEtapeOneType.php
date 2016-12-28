<?php

namespace Flair\PrestataireBundle\Form\Type;

use Flair\CoreBundle\Entity\Reponse;
use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ReponseEtapeOneType extends AbstractType
{
    /**
     * @inheritdocs
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periodeDebut', 'choice', array(
                'required'    => false,
                'label'       => 'Date de démarrage possible',
                'choice_list' => new DisponibiliteChoiceList(),
                'empty_value' => 'Choisissez une option',
                'required'    => false,
                'attr'        => array(
                    'class'             => 'js_input_toggle',
                    'data-target-input' => 'dateDebutInput',
                    'placeholder'       => 'jj/mm/aaaa'
                )
            ))
            ->add('dateDebut', 'date', array(
                'label'    => '',
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'required' => false,
                'attr'     => array(
                    'class'       => 'dateDebutInput js_datepicker proposition-date',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('periodeLivraison', 'choice', array(
                'required'    => false,
                'label'       => 'La prestation doit se terminer',
                'choice_list' => new DisponibiliteChoiceList(),
                'empty_value' => 'Choisissez une option',
                'required'    => false,
                'attr'        => array(
                    'class'             => 'js_input_toggle',
                    'data-target-input' => 'dateLivraisonInput'
                )
            ))
            ->add('dateLivraison', 'date', array(
                'label'    => '',
                'widget' => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array('class' => 'js_datepicker'),
                'required' => false,
                'attr'     => array(
                    'class'       => 'dateLivraisonInput js_datepicker proposition-date',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('reponse', 'textarea', array(
                'label'   => 'Votre réponse',
                'required' => false,
                'attr'    => array(
                    'class'       => 'big',
                    'placeholder' => '255 caractères maximum'
                )
            ))
            ->add('certifications', 'textarea', array(
                'label'      => 'Qualification ou certification',
                'required'   => false,
                'max_length' => 255,
                'attr'       => array('placeholder' => '255 caractères maximum')
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'reponse_etape_one_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\PrestataireBundle\Model\ReponseEtapeOne'
        ));
    }
}
