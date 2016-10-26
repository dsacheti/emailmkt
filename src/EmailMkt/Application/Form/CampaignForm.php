<?php

namespace EmailMkt\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use EmailMkt\Application\InputFilter\CustomerInputFilter;
use EmailMkt\Domain\Entity\Customer;
use EmailMkt\Domain\Entity\Tag;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class CampaignForm extends Form implements ObjectManagerAwareInterface
{
    private $objectManager;
    //o construtor deste formulário está diferente por usar o object manager
    //para poder pegar o object manager é preciso inicializar os campos primeiro
    //por isso eles são iniciados no método init
    public function __construct($name = 'campaign', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
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
            'name' => 'subject',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Assunto:'
            ],
            'attributes' => [
                'id' => 'subject'
            ]
        ]);
        $this->add([
            'name' => 'tags',
            'type' => ObjectSelect::class,
            'attributes' => [
                'multiple' => 'multiple'

            ],
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class' => Tag::class,
                'property' => 'nome',
                'label' => 'Tags'
            ]
        ]);
        $this->add([
            'name' => 'template',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Template'
            ],
            'attributes' =>[
                'id' => 'template'
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

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    //o ObjectManager é uma interface da qual deriva o EntityManager
    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }
}