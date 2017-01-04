<?php

namespace Flair\UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Form\EventListener\CategorieOrganismeEventSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Formulaire de modification du profil d'un organisme.
 */
class ProfilOrganismeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Email'))
            ->add('nom', 'text', array(
                'label' => 'Nom de l\'organisme'
            ))
            ->add('siret', 'text', array(
                'label'    => 'SIRET',
                'required' => false
            ))
            ->add('autreCategorie', 'text', array(
                'label' => 'Précisez',
                'required' => false
            ))
            ->add('siren', 'text', array(
                'label'    => 'SIREN'
            ))
            ->add('ape', 'text', array(
                'label'    => 'Code APE',
                'required' => false
            ))
            ->add('rna', 'text', array(
                'label'    => 'Code RNA',
                'required' => false
            ))
            ->add('adresse', 'text', array(
                'label'    => 'Adresse',
                'attr'     =>  array('placeholder' => '8 rue de Paris'),
                'required' => false
            ))
            ->add('complementAdresse', 'text', array(
                'required' => false,
                'label'    => "Complément d'adresse",
                'required' => false,
                'attr'     =>  array('placeholder' => 'N° bât, étage, appt..'),
            ))
            ->add('codePostal', 'text', array(
                'label'    => 'Code postal',
                'attr'     =>  array('placeholder' => '75007'),
                'required' => false
            ))
            ->add('ville', 'text', array(
                'label'    => 'Ville',
                'attr'     =>  array('placeholder' => 'Paris'),
                'required' => false
            ))
            ->add('telephone', 'text', array(
                'label'    => 'Téléphone',
                'attr'     =>  array('placeholder' => '0101010101'),
                'required' => false
            ))
            ->add('mobile', 'text', array(
                'label'    => 'Mobile',
                'required' => false,
                'attr'     =>  array('placeholder' => '0606060606')
            ))
            ->add('categorieLevelOne', 'entity', array(
                'label'         => "Secteur d'activité",
                'class'         => 'FlairUserBundle:CategorieOrganisme',
                'choice_label'  => 'nom',
                'placeholder'   => 'Entrez votre secteur d\'activité',
                'attr'          => array('class' => 'profil'),
                'query_builder' => function (EntityRepository $er) {
                    return $er->findCategoriesMeres();
                }
            ))
            ->add('prenomContact', 'text', array(
                'label'    => 'Prénom du contact',
                'required' => false
            ))
            ->add('nomContact', 'text', array(
                'label'    => 'Nom du contact',
                'required' => false
            ));

        $builder->addEventSubscriber(new CategorieOrganismeEventSubscriber($builder->getFormFactory()));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'inscription_organisme_form';
    }
}
