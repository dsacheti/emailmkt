<?php

namespace EmailMkt\Application\Form\Factory;

use EmailMkt\Application\Form\LoginForm;
use EmailMkt\Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class LoginFormFactory
{
    public function __invoke(ContainerInterface $container): LoginForm
    {
        $form = new LoginForm();
        //$form->setHydrator(new ClassMethods());
        //$form->setObject(new Customer());
        $form->setInputFilter(new LoginInputFilter());
        return $form;
    }
}