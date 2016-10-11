<?php

namespace EmailMkt\Application\Form;

use EmailMkt\Domain\Entity\City;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class CityForm extends Form
{
    public function __construct($name = 'city', array $options = [])
    {
        parent::__construct($name, $options);
        $this->setHydrator(new ClassMethods());
        $this->setObject(new City());
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
            'name' => 'uf',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'UF:',
                'value_options'=>[
                    'AC'=>'AC',
                    'AL' =>'AL',
                    'AM'=>'AM',
                    'AP'=>'AP',
                    'BA'=>'BA',
                    'CE'=>'CE',
                    'DF'=>'DF',
                    'ES'=>'ES',
                    'GO'=>'GO',
                    'MA'=>'MA',
                    'MT'=>'MT',
                    'MS'=>'MS',
                    'PA'=>'PA',
                    'PB'=>'PB',
                    'PE'=>'PE',
                    'PI'=>'PI',
                    'RO'=>'RO',
                    'PR'=>'PR',
                    'RJ'=>'RJ',
                    'RN'=>'RN',
                    'RR'=>'RR',
                    'RS'=>'RS',
                    'SC'=>'SC',
                    'SE'=>'SE',
                    'SP'=>'SP',
                    'TO'=>'TO'
                ]
            ],
            'attributes' => [
                'id' => 'uf'
            ]
        ]);
        $this->add([
            'name' =>'cep',
            'type' => Element\Text::class,
            'options' =>[
                'label' =>'CEP:'
            ],
            'attributes' =>[
                'id' =>'cep'
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