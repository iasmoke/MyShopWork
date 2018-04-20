<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('lastLogin')
            ;
    }
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('lastLogin')
            ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('lastLogin')
            ;
    }
}