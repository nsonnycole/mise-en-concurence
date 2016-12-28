<?php

namespace Flair\UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Flair\CoreBundle\Entity\PerimetreIntervention;
use Flair\UserBundle\Form\EventListener\CategoriePrestataireEventSubcriber;
use Flair\UserBundle\Form\Type\InscriptionPrestataireType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire d'inscription pour un prestataire.
 */
class InscriptionServicePrestataireType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siren', 'text', array("read_only" => true, "label" => "SIREN"));

        $builder->addEventSubscriber(new CategoriePrestataireEventSubcriber($builder->getFormFactory()));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'flair_inscription_prestataire_form';
    }

    public function getParent()
    {
        return new InscriptionPrestataireType();
    }
}
