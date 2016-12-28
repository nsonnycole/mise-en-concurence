<?php

namespace Flair\UserBundle\Form\Type;

use Flair\UserBundle\Form\EventListener\CategorieOrganismeEventSubscriber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class IncriptionOrganisme
 * @package Flair\UserBundle
 */
class InscriptionOrganismeType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Email'))
            ->add('motdepasse', 'repeated', array(
                'type'           => 'password',
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
            ))
            ->add('nom', 'text', array(
                'label' => 'Nom de l\'organisme'
            ))
            ->add('autreCategorie', 'text', array(
                'label' => 'Précisez',
                'required' => false
            ))
            ->add('siret', 'text', array(
                'label'    => 'SIRET',
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
                'label'    => 'Adresse (n° et rue)',
                'required' => false
            ))
            ->add('complementAdresse', 'text', array(
                'required' => false,
                'label'    => "Complément d'adresse"
            ))
            ->add('codePostal', 'text', array(
                'required' => false,
                'label'    => 'Code postal'
            ))
            ->add('ville', 'text', array(
                'label'    => 'Ville',
                'required' => false
            ))
            ->add('telephone', 'text', array(
                'label'    => 'Téléphone',
                'required' => false
            ))
            ->add('mobile', 'text', array(
                'label'    => 'Mobile',
                'required' => false
            ))
            ->add('categorieLevelOne', 'entity', array(
                'label'         => "Secteur d'activité",
                'class'         => 'FlairUserBundle:CategorieOrganisme',
                'property'      => 'nom',
                'empty_value'   => 'Entrez votre secteur d\'activité',
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
            ))
            ->add('emailPartenaire', 'yes_no_choice', array(
                'label'       => 'Acceptez-vous de recevoir des emails de nos partenaires ?',
                'empty_value' => false
            ))
            ->add('cgu', 'checkbox', array(
                'label' => 'J\'accepte les CGU',
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

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\UserBundle\Model\InscriptionOrganisme'
        ));
    }
}
