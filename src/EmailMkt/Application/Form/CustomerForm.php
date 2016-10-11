<?php

namespace EmailMkt\Application\Form;

use EmailMkt\Application\InputFilter\CustomerInputFilter;
use EmailMkt\Domain\Entity\Customer;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class CustomerForm extends Form
{
    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);


        $this->add([
           'name' => 'id',
            'type' => Element\Hidden::class
        ]);
        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome:'
            ],
            'attributes' => [
                'id' => 'name'
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => Element\Text::class,//o professor deixou Text
            'options' => [
                'label' => 'Email:'
            ],
            'attributes' => [
                'id' => 'email',
                //'type' => 'email'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'submit'
            ]

        ]);
    }

}