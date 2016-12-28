<?php

namespace Flair\PrestataireBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Flair\PrestataireBundle\Form\ChoiceList\ReponseStatutChoiceList;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire de filtre pour les propositions du prestataire.
 */
class FiltrePropositionType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $prestataire = $builder->getData()->getPrestataire();

        $builder
            ->add('organisme', 'entity', array(
                'label'         => 'Organisme',
                'class'         => 'FlairUserBundle:Organisme',
                'property'      => 'nom',
                'empty_value'   => 'Sélectionnez un organisme',
                'required'      => false,
                'query_builder' => function (EntityRepository $em) use ($prestataire) {
                    return $em->createQueryBuilder('o')
                        ->join('o.consultations', 'c')
                        ->join('c.reponses', 'p')
                        ->where('p.prestataire = :prestataire')
                        ->setParameter('prestataire', $prestataire->getId());
                }
            ))
            ->add('montantMin', 'integer', array(
                'required' => false,
                'attr'     => array(
                    'class' => 'prices'
                )
            ))
            ->add('montantMax', 'integer', array(
                'required' => false,
                'attr'     => array(
                    'class' => 'prices'
                )
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
                'label'       => 'Statut',
                'required'    => false,
                'choice_list' => new ReponseStatutChoiceList(),
                'empty_value' => 'Sélectionnez le statut'
            ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'filtre_proposition_form_type';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\PrestataireBundle\Model\FiltrePropositionModel'
        ));
    }
}
