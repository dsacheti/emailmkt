<?php

namespace EmailMkt\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMkt\Application\Form\CustomerForm;
use EmailMkt\Application\InputFilter\CustomerInputFilter;
use EmailMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container):CustomerForm
    {
        $entityManager = $container->get(EntityManager::class);
        $form = new CustomerForm();
        $form->setHydrator(new DoctrineHydrator($entityManager));
        $form->setObject(new Customer());
        $form->setInputFilter(new CustomerInputFilter());
        $form->setObjectManager($entityManager);
        //inicializando os campos
        $form->init();
        return $form;
    }
}