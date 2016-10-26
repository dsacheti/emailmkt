<?php

namespace EmailMkt\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class TagInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'nome',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' =>StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'É necessário preencher este campo!',
                            NotEmpty::INVALID => 'O tipo de informação preenchido não pode ser aceito por este campo.'
                        ]
                    ]
                ],

            ]
        ]);
    }

}