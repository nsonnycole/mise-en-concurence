<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Flair\UserBundle\Entity\Consultation;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ConsultationAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit');
    }

    public function toString($object)
    {
        return $object instanceof Consultation
            ? $object->getNom()
            : 'Consultation'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          ->add('titre', 'text')
          ->add('description', 'textarea');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('titre')
          ->add('statut');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          ->addIdentifier('titre')
          ->add('dateLimite', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('stringStatus', 'text', array(
              'label' => 'Statut',
          ))
	        ->add('dateCreation', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('dateUpdate', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'delete' => array(),
            )
        ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
          ->add('titre')
          ->add('description')
          ->add('dateLimite', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('prixMin')
          ->add('prixMax')
          ->add('periodeDebut')
          ->add('dateDebut', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('periodeLivraison')
          ->add('dateLivraison', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('experienceRequises')
          ->add('certificationRequise')
          ->add('certifications')
          ->add('statut')
          ->add('dateCreation', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ))
          ->add('dateUpdate', 'date', array(
              'format' => 'd/m/Y',
              'locale' => 'fr',
              'timezone' => 'Europe/Paris',
          ));
      }
}
