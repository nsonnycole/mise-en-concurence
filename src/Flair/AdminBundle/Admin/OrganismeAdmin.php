<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Flair\UserBundle\Entity\Organisme;

class OrganismeAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit');
    }

    public function toString($object)
    {
        return $object instanceof Organisme
            ? $object->getNom()
            : 'Organisme'; 
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('nom')
          ->add('ape')
          ->add('entreprise.siren');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          ->addIdentifier('nom')
          ->add('entreprise.siren')
          ->add('categorie.nom')
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
            ->add('ape')
            ->add('entreprise.siren')
            ->add('siret')
            ->add('rna')
            ->add('adresse')
            ->add('codePostal')
            ->add('complementAdresse')
            ->add('ville')
            ->add('telephone')
            ->add('mobile')
            ->add('categorie.nom')
            ->add('prenomContact')
            ->add('nomContact');
      }

}
