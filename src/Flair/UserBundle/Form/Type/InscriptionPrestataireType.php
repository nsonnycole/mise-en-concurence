<?php

namespace Flair\UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Flair\CoreBundle\Entity\PerimetreIntervention;
use Flair\UserBundle\Form\EventListener\CategoriePrestataireEventSubcriber;
use Flair\CoreBundle\Form\Type\PdfDocumentType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire d'inscription pour un prestataire.
 */
class InscriptionPrestataireType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tags', 'entity', array(
                'label'    => "Mots clés",
                'class'    => 'FlairCoreBundle:Tag',
                'required' => false,
                'property' => 'name',
                'attr'     => array('multiple' => true)
            ))
            ->add('email', 'text', array(
                'label' => 'Adresse email'
            ))
            ->add('nom', 'text', array(
                'label' => 'Nom de l\'entreprise'
            ))
            ->add('password', 'repeated', array(
                'type'           => 'password',
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
            ))
            ->add('siret', 'text', array(
                'label'    => 'SIRET',
                'required' => false
            ))
            ->add('siren', 'text', array(
                'label' => 'SIREN'
            ))
            ->add('ape', 'text', array(
                'label'    => 'APE',
                'required' => false
            ))
            ->add('tvaIntracommunautaire', 'text', array(
                'label'    => 'TVA intracommunautaire',
                'required' => false
            ))
            ->add('refs', 'textarea', array(
                'label'    => 'Vos principales références',
                'required' => false,
                'attr'     => array(
                    'class'       => 'bigInput',
                    'placeholder' => 'Maximum 255 caractères'
                )
            ))
            ->add('dateCreation', 'date', array(
                'label'    => "Date de création de l'entreprise",
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array(
                    'class'       => 'dateDebutInput js_datepicker',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('adresse', 'text', array(
                'label'    => 'Adresse (n° et rue)'
            ))
            ->add('complementAdresse', 'text', array(
                'label'    => "Complément d'adresse",
                'required' => false
            ))
            ->add('codePostal', 'text', array(
                'label'    => 'Code postal',
                'required' => false
            ))
            ->add('ville', 'text', array(
                'label'    => 'Ville',
                'required' => false
            ))
            ->add('perimetreIntervention', 'choice', array(
                'label'   => 'Périmètre d\'intervention',
                'choices' => PerimetreIntervention::getChoices()
            ))
            ->add('telephone', 'text', array(
                'label'    => 'Téléphone',
                'required' => false
            ))
            ->add('mobile', 'text', array(
                'label' => 'Mobile',
                'required' => false
            ))
            ->add('categorieLevelOne', 'entity', array(
                'label'         => "Secteur d'activité de l'entreprise",
                'class'         => 'FlairUserBundle:CategoriePrestataire',
                'property'      => 'nom',
                'multiple'      => true,
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
            ->add('presentation', 'textarea', array(
                'label' => "L'entreprise",
                'required' => false,
                'attr' => array(
                    'class'       => 'bigInput',
                    'placeholder' => 'Maximum 255 caractères'
                )
            ))
            ->add('cgu', 'checkbox', array(
                'label' => 'J\'accepte les CGU'
            ))
            ->add('urssaf', new PdfDocumentType(), array(
                'label' => 'Attestation URSSAF',
                'error_bubbling' => true,
                'required' => false
            ))
            ->add('impots', new PdfDocumentType(), array(
                'label'    => 'Attestation impôts',
                'error_bubbling' => true,
                'required' => false
            ))
            ->add('kbis', new PdfDocumentType(), array(
                'label' => 'Extrait KBIS',
                'error_bubbling' => true,
                'required' => false
            ))
            ->add('presentationDoc', new PdfDocumentType(), array(
                'label' => 'Autre document',
                'error_bubbling' => true,
                'required' => false
            ));

        $builder->addEventSubscriber(new CategoriePrestataireEventSubcriber($builder->getFormFactory()));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'flair_inscription_prestataire_form';
    }
}
