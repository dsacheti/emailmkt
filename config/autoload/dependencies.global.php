<?php
//essa maneira com chaves só pode ser usada no php7
use EmailMkt\Domain\Persistence\{
    CityRepositoryInterface,CustomerRepositoryInterface,TagRepositoryInterface,
    CampaignRepositoryInterface
};
use EmailMkt\Domain\Service\{
    AuthInterface,FlashMessageInterface,CampaignEmailSenderInterface
};
use EmailMkt\Infrastructure\Service\{
    MailgunFactory, AuthServiceFactory,FlashMessageFactory,CampaignEmailSenderFactory
};
use Mailgun\Mailgun;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;
use EmailMkt\Infrastructure\Persistence\Doctrine\Repository\{
    CustomerRepositoryFactory,CityRepositoryFactory,TagRepositoryFactory,
    CampaignRepositoryFactory
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
            FlashMessageInterface::class => FlashMessageFactory::class,
            CityRepositoryInterface::class => CityRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            CampaignRepositoryInterface::class => CampaignRepositoryFactory::class,
            'doctrine:fixtures_cmd:load'   => \CodeEdu\FixtureFactory::class,
            AuthInterface::class => AuthServiceFactory::class,
            CampaignEmailSenderInterface::class => CampaignEmailSenderFactory::class,
            Mailgun::class => MailgunFactory::class
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            Zend\Authentication\AuthenticationService::class =>'doctrine.authenticationservice.orm_default'
        ],
    ],
];
