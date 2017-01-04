<?php


namespace Flair\OrganismeBundle\Form\Type;

use Flair\OrganismeBundle\Form\ChoiceList\DisponibiliteChoiceList;
use Flair\OrganismeBundle\Form\ChoiceList\ExperienceRequiseChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Formulaire de l'étape 2 de la création de la demande.
 */
class ConsultationEtape2Type extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prixMinimum', 'money', array(
            'label'     => 'Fourchette de prix estimée entre',
            'required'  => false,
            'precision' => 0
        ))
        ->add('prixMaximum', 'money', array(
            'label'     => 'et',
            'required'  => false,
            'precision' => 0
        ))
        ->add('periodeDebut', 'choice', array(
            'required'    => false,
            'label'       => 'La prestation doit commencer',
            'choices' => new DisponibiliteChoiceList(),
            'placeholder' => 'Choisissez une option',
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
                'class'       => 'dateDebutInput js_datepicker',
                'placeholder' => 'jj/mm/aaaa'
            )
        ))
        ->add('periodeLivraison', 'choice', array(
            'required'    => false,
            'label'       => 'La prestation doit se terminer',
            'choices' => new DisponibiliteChoiceList(),
            'placeholder' => 'Choisissez une option',
            'required'    => false,
            'attr'        => array(
                'class'             => 'js_input_toggle',
                'data-target-input' => 'dateLivraisonInput'
            )
        ))
        ->add('dateLivraison', 'date', array(
            'label'    => '', 'widget' => 'single_text',
            'format'   => 'dd/MM/yyyy',
            'attr'     => array('class' => 'js_datepicker'),
            'required' => false,
            'attr'     => array(
                'class'       => 'dateLivraisonInput js_datepicker',
                'placeholder' => 'jj/mm/aaaa'
            )
        ))
        ->add('experienceRequise', 'choice', array(
            'required'    => false,
            'label'       => 'Date de création de la société prestataire',
            'choices' => new ExperienceRequiseChoiceList(),
            'placeholder' => 'Choisissez une option'
        ))
        ->add('certificationRequise', 'yes_no_choice', array(
            'label'       => 'Rechercher vous une qualification ou certification précise?',
            'expanded'    => true,
            'multiple'    => false,
            'placeholder' => false,
            'required'    => false,
            'attr'        => array(
                'class'             => 'js_input_toggle',
                'data-target-input' => 'certificationsInput'
            )
        ))
        ->add('certifications', 'text', array(
            'required' => false,
            'label'    => '',
            'attr'     => array(
                'placeholder' => 'Merci de préciser vos pré-recquis',
                'class'       => 'certificationsInput large'
            )
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'consultation_etape2_form_type';
    }
}
