<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Flair\UserBundle\Entity\Prestataire;

class PrestataireAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit');
    }

    public function toString($object)
    {
        return $object instanceof Prestataire
            ? $object->getNom()
            : 'Prestataire';
    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('nom')
          ->add('adresse')
          ->add('ville');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          ->addIdentifier('nom')
          ->add('adresse')
          ->add('ville')
          ->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
                'delete' => array(),
            )
        ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('dateCreation', 'date', array(
                'format' => 'd/m/Y',
                'locale' => 'fr',
                'timezone' => 'Europe/Paris',
            ))
            ->add('ape')
            ->add('entreprise.siren')
            ->add('siret')
            ->add('rna')
            ->add('adresse')
            ->add('complementAdresse')
            ->add('codePostal')
            ->add('ville')
            ->add('telephone')
            ->add('mobile')
            ->add('prenomContact')
            ->add('nomContact');
      }

}
