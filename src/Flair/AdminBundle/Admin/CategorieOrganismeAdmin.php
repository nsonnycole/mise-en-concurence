<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Flair\UserBundle\Entity\CategorieOrganisme;

class CategorieOrganismeAdmin extends Admin
{

    public function toString($object)
    {
        return $object instanceof CategorieOrganisme
            ? $object->getNom()
            : 'Catégorie Organisme'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                    'parent' => array('template' => 'FlairAdminBundle::souscategorieOrganisme.html.twig')
                )
            ))
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere($query->getRootAlias() . '.parent IS NULL');

        return $query;
    }
}
