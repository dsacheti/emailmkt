<?php
use EmailMkt\Application\Action\Customer\{
    CustomerListPageAction,CustomerCreatePageAction,CustomerUpdatePageAction,CustomerDeletePageAction
};
use EmailMkt\Application\Action\Customer\Factory as Customer;
use EmailMkt\Application\Action\City\{
    CityCreatePageAction,CityListPageAction,CityUpdatePageAction,CityDeletePageAction
};
use EmailMkt\Application\Action\City\Factory as City;
use EmailMkt\Application\Action\{
    PingAction,TestePageAction,HomePageAction,LoginPageAction,LogoutAction,Teste2PageAction,
    HomePageFactory,Teste2PageFactory,LoginPageFactory,LogoutFactory
};

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            PingAction::class => PingAction::class,
            TestePageAction::class => TestePageAction::class,
        ],
        'factories' => [
            HomePageAction::class => HomePageFactory::class,
            Teste2PageAction::class => Teste2PageFactory::class,
            LoginPageAction::class => LoginPageFactory::class,
            LogoutAction::class => LogoutFactory::class,
            //Customer
            CustomerListPageAction::class => Customer\CustomersListPageFactory::class,
            CustomerCreatePageAction::class => Customer\CustomersCreatePageFactory::class,
            CustomerUpdatePageAction::class => Customer\CustomersUpdatePageFactory::class,
            CustomerDeletePageAction::class => Customer\CustomersDeletePageFactory::class,
            //City
            CityCreatePageAction::class => City\CityCreatePageFactory::class,
            CityListPageAction::class => City\CityListPageFactory::class,
            CityUpdatePageAction::class => City\CityUpdatePageFactory::class,
            CityDeletePageAction::class => City\CityDeletePageFactory::class,


         ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => PingAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            //o nome é importante para acoplar ao nome não à url
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => \EmailMkt\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'auth.login',
            'path' => '/auth/login',
            'middleware' => LoginPageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'auth.logout',
            'path' => '/auth/logout',
            'middleware' => LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            //o nome é importante para acoplar ao nome não à url
            'name' => 'teste2',
            'path' => '/teste2',
            'middleware' => Teste2PageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            //o nome é importante para acoplar ao nome não à url
            'name' => 'customer.list',
            'path' => '/admin/customers',
            'middleware' => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            //o nome é importante para acoplar ao nome não à url
            'name' => 'customer.create',
            'path' => '/admin/customer/create',
            'middleware' => CustomerCreatePageAction::class,
            'allowed_methods' => ['GET','POST']
        ],
        [
            'name' => 'customer.update',
            'path' => '/admin/customer/update/{id}',
            'middleware' => CustomerUpdatePageAction::class,
            'allowed_methods' => ['GET','POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'customer.delete',
            'path' => '/admin/customer/delete/{id}',
            'middleware' => CustomerDeletePageAction::class,
            'allowed_methods' => ['GET','POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            //o nome é importante para acoplar ao nome não à url
        'name' => 'city.create',
        'path' => '/admin/city/create',
        'middleware' => CityCreatePageAction::class,
        'allowed_methods' => ['GET','POST']
        ],
        [
            //o nome é importante para acoplar ao nome não à url
            'name' => 'city.list',
            'path' => '/admin/cities',
            'middleware' => CityListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'city.update',
            'path' => '/admin/city/update/{id}',
            'middleware' => CityUpdatePageAction::class,
            'allowed_methods' => ['GET','POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'city.delete',
            'path' => '/admin/city/delete/{id}',
            'middleware' => CityDeletePageAction::class,
            'allowed_methods' => ['GET','POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ]
    ],
];
