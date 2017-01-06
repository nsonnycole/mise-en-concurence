<?php

namespace Flair\UserBundle\Form\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Flair\PrestataireBundle\Model\InscriptionPrestataire;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormFactory;

/**
 * Event subscriber pour le formulaire d'inscription pour les prestataires.
 */
class InscriptionPrestataireEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $factory;

    /**
     * @inheritdoc
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

        if ($data instanceof InscriptionPrestataire) {
            $levelOne = $data->getCategorieLevelOne();
        } else {
            $levelOne = @$data['categorieLevelOne'];
        }

        if (!empty($levelOne)) {
            $form->add($this->factory->createNamed('categorieLevelTwo', 'entity', null, array(
                'label'         => 'Sous secteur',
                'required'      => false,
                'choice_label'      => 'nom',
                'class'         => 'FlairCoreBundle:CategoriePrestataire',
                'empty_data'   => 'Entrez un sous secteur d\'activité',
                'auto_initialize' => false,
                'query_builder' => function (EntityRepository $er) use ($levelOne) {
                    return $er->findCategoriesFilles($levelOne);
                }
            )));

            if ($data instanceof InscriptionPrestataire) {
                $levelTwo = $data->getCategorieLevelTwo();
            } else {
                $levelTwo = @$data['categorieLevelTwo'];
            }

            if (!empty($levelTwo)) {
                $form->add($this->factory->createNamed('categorieLevelThree', 'entity', null, array(
                    'label'         => 'Sous secteur',
                    'required'      => false,
                    'choice_label'  => 'nom',
                    'class'         => 'FlairUserBundle:CategoriePrestataire',
                    'empty_data'    => 'Entrez un sous secteur d\'activité',
                    'auto_initialize' => false,
                    'query_builder' => function (EntityRepository $er) use ($levelTwo) {
                        return $er->findCategoriesFilles($levelTwo);
                    }
                )));
            }
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
