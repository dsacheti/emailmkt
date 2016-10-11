<?php

namespace EmailMkt\Application\Form;

use EmailMkt\Application\InputFilter\CustomerInputFilter;
use EmailMkt\Domain\Entity\Customer;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class LoginForm extends Form
{
    public function __construct($name = 'login', array $options = [])
    {
        parent::__construct($name, $options);
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
            'name' => 'password',
            'type' => Element\Password::class,//o professor deixou Text
            'options' => [
                'label' => 'Senha:'
            ],
            'attributes' => [
                'id' => 'password'
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