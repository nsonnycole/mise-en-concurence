<?php

namespace Flair\UserBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormFactory;

/**
 * Category event subscriber.
 */
class CategorieOrganismeEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $factory;

    /**
     * Creates a category event subscriber.
     *
     * @param \Symfony\Component\Form\FormFactory $factory The form factory.
     */
    public function __construct(FormFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Manages categories.
     *
     * @param \Symfony\Component\Form\FormEvent $event The form event.
     */
    public function preBind(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (is_array($data)) {
            $levelOne = @$data['categorieLevelOne'];
        } elseif (!empty($data)) {
            $levelOne = $data->getCategorieLevelOne();
        }

        if (!empty($levelOne)) {
            $form->add($this->factory->createNamed('categorieLevelTwo', 'entity', null, array(
                'label'         => 'Sous secteur',
                'required'      => false,
                'property'      => 'nom',
                'class'         => 'FlairUserBundle:CategorieOrganisme',
                'empty_value'   => 'Entrez un sous secteur d\'activité',
                'auto_initialize' => false,
                'query_builder' => function (EntityRepository $er) use ($levelOne) {
                    return $er->findCategoriesFilles($levelOne);
                }
            )));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT   => 'preBind',
            FormEvents::PRE_SET_DATA => 'preBind'
        );
    }
}
