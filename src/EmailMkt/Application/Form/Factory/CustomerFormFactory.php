<?php

namespace EmailMkt\Application\Form\Factory;

use EmailMkt\Application\Form\CustomerForm;
use EmailMkt\Application\InputFilter\CustomerInputFilter;
use EmailMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container):CustomerForm
    {
        $form = new CustomerForm();
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Customer());
        $form->setInputFilter(new CustomerInputFilter());
        return $form;
    }
}