<?php

namespace Flair\PrestataireBundle\Form\Type;

use Flair\CoreBundle\Model\TauxTva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Represente une ligne de formulaire.
 */
class LigneDevisType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'text', array(
                'attr' => array(
                    'class' => 'small'
                )
            ))
            ->add('libelle', 'text', array(
                'attr' => array(
                    'class' => 'large'
                )
            ))
            ->add('quantite', 'integer', array(
                'precision' => 2,
                'attr' => array(
                    'class' => 'medium quantite'
                )
            ))
            ->add('prixUnitaire', 'text', array(
                'attr' => array(
                    'class' => 'medium prixUnitaire'
                )
            ))
            ->add('tva', 'choice', array(
                'choices'     => TauxTva::getChoices(),
                'empty_value' => '',
                'attr'        => array(
                    'class'   => 'small tva'
                )
            ));
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flair\CoreBundle\Entity\LigneDevis'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ligne_devis_type';
    }
}
