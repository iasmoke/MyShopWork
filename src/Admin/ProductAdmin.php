<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
        ->add('title')
        ->add('price')
        ->add('isTop')
        ->add('description')
        ->add('category')
    ;
    }
    protected function configureListFields(ListMapper $list)
    {
        $list
        ->add('id')
        ->add('title')
        ->add('price')
        ->add('isTop')
        ->add('description')
    ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('title')
            ->add('price')
            ->add('isTop')
            ->add('description')
        ;
    }
}