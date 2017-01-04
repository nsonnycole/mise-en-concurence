<?php

namespace Flair\OrganismeBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Flair\UserBundle\Form\EventListener\CategoriePrestataireEventSubcriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

/**
 * Formulaire d'une consultation.
 */
class ConsultationEtape1Type extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array('label' => 'Titre'))
            ->add('description', CKEditorType::class, array(
                'label' => 'Description sommaire'
            ))
            ->add('categorieLevelOne', 'entity', array(
                'label'         => 'Secteur d\'activité de la prestation',
                'class'         => 'FlairUserBundle:CategoriePrestataire',
                'choice_label'      => 'nom',
                'placeholder'   => 'Entrez votre secteur d\'activité',
                'query_builder' => function (EntityRepository $er) {
                    return $er->findCategoriesMeres();
                }
            ))
            ->add('dateLimite', 'date', array(
                'label'    => 'Date de clôture de la mise en concurrence',
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array(
                    'class'       => 'js_datepicker',
                    'placeholder' => 'jj/mm/aaaa'
                )
            ));

        $builder->addEventSubscriber(new CategoriePrestataireEventSubcriber($builder->getFormFactory()));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'consultation_etape1_form_type';
    }
}
