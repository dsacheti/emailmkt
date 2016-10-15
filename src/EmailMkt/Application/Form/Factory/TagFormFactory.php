<?php

namespace EmailMkt\Application\Form\Factory;

use EmailMkt\Application\Form\TagForm;
use EmailMkt\Application\InputFilter\TagInputFilter;
use EmailMkt\Domain\Entity\Tag;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class TagFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $form = new TagForm();
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Tag());
        $form->setInputFilter(new TagInputFilter());
        return $form;
    }
}