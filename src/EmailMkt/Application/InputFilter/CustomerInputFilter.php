<?php

namespace EmailMkt\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class CustomerInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' =>StripTags::class]
            ]
        ]);
        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' =>StringTrim::class]
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
                [
                   'name' => EmailAddress::class,
                    'options' => [
                        'messages' =>[
                            EmailAddress::INVALID => 'O endereço de email digitado não é válido.',
                            EmailAddress::INVALID_HOSTNAME =>'O endereço de email digitado não é válido..',
                            EmailAddress::INVALID_LOCAL_PART => 'O endereço de email digitado não é válido.',
                            EmailAddress::INVALID_FORMAT => 'O endereço de email digitado não é válido.',
                            EmailAddress::DOT_ATOM => 'O endereço de email digitado não é válido.',
                            EmailAddress::INVALID_MX_RECORD  => "O endereço de email digitado não é válido.",
                            EmailAddress::INVALID_SEGMENT    => "O endereço de email digitado não é válido.",
                            EmailAddress::QUOTED_STRING      => "O endereço de email digitado não é válido.",
                            EmailAddress::LENGTH_EXCEEDED    => "O endereço de email digitado não é válido."
                        ]
                    ]
                ]
            ]
        ]);
    }

}