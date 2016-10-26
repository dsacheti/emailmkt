<?php

namespace EmailMkt\Application\Form;


use Zend\Form\Element;
use Zend\Form\Form;

class TagForm extends Form
{
    public function __construct($name = 'tag', array $options = [])
    {
        parent::__construct($name, $options);


        $this->add([
           'name' => 'id',
            'type' => Element\Hidden::class
        ]);
        $this->add([
            'name' => 'nome',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome:'
            ],
            'attributes' => [
                'id' => 'nome'
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