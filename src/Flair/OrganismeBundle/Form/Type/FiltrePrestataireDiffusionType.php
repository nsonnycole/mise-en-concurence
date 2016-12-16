<?php

namespace Flair\OrganismeBundle\Form\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Flair\CoreBundle\Entity\Consultation;
use Flair\OrganismeBundle\Form\ChoiceList\PrestataireStatutChoiceList;
use Flair\OrganismeBundle\Form\Type\TagType;
use Symfony\Component\Form\AbstractType;    
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Flair\CoreBundle\Entity\PerimetreIntervention;

class FiltrePrestataireDiffusionType extends AbstractType
{
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $consultation = $this->consultation;
        $builder
            ->add('tags', 'entity', array(
                'label'    => "Recherche",
                'class'    => 'FlairCoreBundle:Tag',
                'required' => false,
                'property' => 'name',
                'attr'     => array('multiple' => true)
            ))            
            ->add('exclusive', 'checkbox', array(
                'label'    => 'Mes prestataires uniquement',
                'required' => false
            ))
            ->add('ape', 'entity', array(
                'label'    => "APE",
                'class'    => 'FlairUserBundle:Prestataire',
                'required' => false,
                'property' => 'ape',
                'attr'     => array('multiple' => true)
            ))
            ->add('perimetreIntervention', 'choice', array(
                'label'   => 'Périmètre d\'intervention',
                'choices' => PerimetreIntervention::getChoices(),
                'empty_value' => 'Choisissez une option',
                'required' => false
            ))
            ->add('categorie', 'entity', array(
                'label'    => "Secteur d'activité",
                'class'    => 'FlairUserBundle:CategoriePrestataire',
                'property' => 'nom',
                'required' => false,
                'attr'     => array('multiple' => true),
                'query_builder' => function (EntityRepository $er) use ($consultation) {
                    return $er->findCategoriesFilles($consultation->getCategorie());
                }
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'filtre_prestataire_diffusion_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\OrganismeBundle\Model\FiltrePrestataireDiffusionModel'
        ));
    }
}
