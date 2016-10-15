<?php
use EmailMkt\Domain\Persistence\{
    CityRepositoryInterface,CustomerRepositoryInterface,TagRepositoryInterface
};
use EmailMkt\Domain\Service\FlashMessageInterface;
use EmailMkt\Infrastructure\Service;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;
use EmailMkt\Infrastructure\Persistence\Doctrine\Repository\{
    CustomerRepositoryFactory,CityRepositoryFactory,TagRepositoryFactory
};


return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            FlashMessageInterface::class => Service\FlashMessageFactory::class,
            CityRepositoryInterface::class => CityRepositoryFactory::class,
            'doctrine:fixtures_cmd:load'   => \CodeEdu\FixtureFactory::class,
            \EmailMkt\Domain\Service\AuthInterface::class => Service\AuthServiceFactory::class
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            Zend\Authentication\AuthenticationService::class =>'doctrine.authenticationservice.orm_default'
        ],
    ],
];
