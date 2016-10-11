<?php

namespace EmailMkt\Application\Form\Factory;

use EmailMkt\Application\Form\CityForm;
use EmailMkt\Application\InputFilter\CityInputFilter;
use EmailMkt\Domain\Entity\City;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CityFormFactory
{
    public function __invoke(ContainerInterface $container): CityForm
    {
        $form = new CityForm();
        $form->setHydrator(new ClassMethods());
        $form->setObject(new City());
        $form->setInputFilter(new CityInputFilter());
        return $form;
    }
}