<?php

namespace Flair\UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Flair\CoreBundle\Entity\PerimetreIntervention;
use Flair\CoreBundle\Form\Type\PdfDocumentType;
use Flair\UserBundle\Form\EventListener\CategoriePrestataireEventSubcriber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire de modification d'un prestataire.
 */
class ProfilPrestataireType extends AbstractType
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
                'choice_label' => 'name',
                'attr'     => array('multiple' => true)
            ))
            ->add('email', 'text', array(
                'label' => 'Adresse email'
            ))
            ->add('nom', 'text', array(
                'label' => 'Nom de l\'entreprise'
            ))
            ->add('siret', 'text', array(
                'label'    => 'SIRET',
                'required' => false
            ))
            ->add('siren', 'text', array(
                'label' => 'SIREN'
            ))
            ->add('ape', 'text', array(
                'label'          => 'APE',
                'required'       => false
            ))
            ->add('tvaIntracommunautaire', 'text', array(
                'label'    => 'TVA intracommunautaire',
                'required' => false
            ))
            ->add('refs', 'textarea', array(
                'label'          => 'Vos principales références',
                'required'       => false,
                'attr'           => array(
                    'class'       => 'bigInput',
                    'placeholder' => 'Maximum 255 caractères'
                )
            ))
            ->add('dateCreation', 'date', array(
                'label'          => "Date de création de l'entreprise",
                'widget'         => 'single_text',
                'format'         => 'dd/MM/yyyy',
                'attr'           => array(
                    'class'       => 'dateDebutInput js_datepicker',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('adresse', 'text', array(
                'label'          => 'Adresse (n° et rue)'
            ))
            ->add('complementAdresse', 'text', array(
                'label'          => "Complément d'adresse",
                'required'       => false
            ))
            ->add('codePostal', 'text', array(
                'label'          => 'Code postal',
                'required'       => false
            ))
            ->add('ville', 'text', array(
                'label'          => 'Ville',
                'required'       => false
            ))
            ->add('perimetreIntervention', 'choice', array(
                'label'   => 'Périmètre d\'intervention',
                'choices' => PerimetreIntervention::getChoices()
            ))
            ->add('telephone', 'text', array(
                'label'          => 'Téléphone',
                'required'       => false
            ))
            ->add('mobile', 'text', array(
                'label'          => 'Mobile',
                'required'       => false
            ))
            ->add('categories', 'entity', array(
                'label'          => "Secteur d'activité",
                'class'          => 'FlairUserBundle:CategoriePrestataire',
                'choice_label'   => 'nom',
                'multiple'       => false,
                'placeholder'    => 'Entrez votre secteur d\'activité',
                'query_builder'  => function (EntityRepository $er) {
                    return $er->getAll();
                }
            ))
            ->add('prenomContact', 'text', array(
                'label'          => 'Prénom du contact',
                'required'       => false
            ))
            ->add('nomContact', 'text', array(
                'label'          => 'Nom du contact',
                'required'       => false
            ))
            ->add('presentation', 'textarea', array(
                'label'          => "Présentez l'entreprise",
                'required'       => false,
                'attr'           => array(
                    'class'       => 'bigInput',
                    'placeholder' => 'Maximum 255 caractères'
                )
            ))
            ->add('urssaf', PdfDocumentType::class, array(
                'label' => 'Attestation URSSAF',
                'required' => false
            ))
            ->add('impots', PdfDocumentType::class, array(
                'label'    => 'Attestation impôts',
                'required' => false
            ))
            ->add('kbis', PdfDocumentType::class, array(
                'label' => 'Extrait KBIS',
                'required' => false
            ))
            ->add('presentationDoc', PdfDocumentType::class, array(
                'label' => 'Autre document',
                'required' => false
            ));

        $builder->addEventSubscriber(new CategoriePrestataireEventSubcriber($builder->getFormFactory()));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'profil_prestataire_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('pdf', 'Default'),
            'data_class'        => 'Flair\UserBundle\Model\ProfilPrestataire'
        ));
    }
}
