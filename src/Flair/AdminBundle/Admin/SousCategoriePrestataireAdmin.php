<?php

namespace Flair\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Flair\UserBundle\Entity\CategorieOrganisme;

class SousCategoriePrestataireAdmin extends Admin
{
    //protected $parentAssociationMapping = 'categorie_organisme';

    public function toString($object)
    {
        return $object instanceof CategoriePrestataire
            ? $object->getNom()
            : 'Sous-Catégorie Prestataire'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          ->add('nom', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('nom');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          ->addIdentifier('nom')
          ->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
                'delete' => array(),
            )
        ));
    }

    public function createQuery($context = 'list')
    {
        $request = $this->getRequest();

        $id = $request->attributes->get('id');

        $query = parent::createQuery($context);
        $query->andWhere($query->getRootAlias() . '.parent = :id');
        $query->setParameter('id', $id);

        return $query;
    }

}
