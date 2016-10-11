<?php

namespace EmailMkt\Application\Action;

use EmailMkt\Application\Action\HomePageAction;
use EmailMkt\Application\Form\LoginForm;
use EmailMkt\Domain\Service\AuthInterface;
use EmailMkt\Infrastructure\Service\AuthService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LogoutFactory
{
    public function __invoke(ContainerInterface $container): LogoutAction
    {
        $router   = $container->get(RouterInterface::class);
        $authService = $container->get(AuthInterface::class);
        return new LogoutAction($router,$authService);
    }
}
