<?php
use \Zend\View;
use \EmailMkt\Infrastructure;
use EmailMkt\Application\Form;
$forms = [
    //ao iniciar dependencies vai para o ServiceManager(Container)
    'dependecies' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            View\HelperPluginManager::class => Infrastructure\View\HelperPluginManagerFactory::class,
            //Zend\View\HelperPluginManager::class => EmailMkt\Infrastructure\View\HelperPluginManagerFactory::class,
            //Form\CustomerForm::class => Form\Factory\CustomerFormFactory::class,
            //Form\CityForm::class => Form\Factory\CityFormFactory::class

        ]
    ],
    //ao inicar view_helpers vai para config
    'view_helpers' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            'identity' => View\Helper\Service\IdentityFactory::class
        ]
    ]
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm,$forms);