<?php

namespace EmailMkt\Application\Action;

use EmailMkt\Application\Action\HomePageAction;
use EmailMkt\Application\Form\LoginForm;
use EmailMkt\Domain\Service\AuthInterface;
use EmailMkt\Infrastructure\Service\AuthService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container): LoginPageAction
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->get(TemplateRendererInterface::class);
        $form = $container->get(LoginForm::class);
        $authService = $container->get(AuthInterface::class);
        return new LoginPageAction($router, $template,$form,$authService);
    }
}
