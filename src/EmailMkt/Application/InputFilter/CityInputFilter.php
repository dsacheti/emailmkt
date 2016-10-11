<?php

namespace EmailMkt\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class CityInputFilter extends InputFilter
{
    public function __construct()
    {

        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' =>StripTags::class]
            ],
            'validators'=>[
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' =>true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo não pode estar vazio',
                            NotEmpty::INVALID =>'Os dados digitados são inválidos'
                        ]
                    ]
                ]
             ]
        ]);

        $this->add([
            'name' => 'cep',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class]
            ]
        ]);
    }

}