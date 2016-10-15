<?php

namespace EmailMkt\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class TagInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' =>StripTags::class]
            ],
            'validators' => [
                'name' => NotEmpty::class,
                'options' =>[
                    'messages' => [
                        NotEmpty::IS_EMPTY => 'Este campo deve ser preenchido'
                    ]
                ]
            ]
        ]);
    }

}