<?php

namespace Flair\UserBundle\Form\Type;

use Flair\UserBundle\Form\EventListener\CategorieOrganismeEventSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class IncriptionService
 * @package Flair\UserBundle
 */
class InscriptionServiceOrganismeType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siren', 'text', array("read_only" => true, "label" => "SIREN"));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'inscription_service_organisme_form';
    }

    public function getParent()
    {
        return new InscriptionOrganismeType();
    }
}
