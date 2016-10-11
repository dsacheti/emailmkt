<?php

namespace EmailMkt\Application\Action;

use Doctrine\ORM\EntityManager;
use EmailMkt\Application\Action\Teste2PageAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;

class Teste2PageFactory
{
    public function __invoke(ContainerInterface $container): Teste2PageAction
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new Teste2PageAction($container->get(CustomerRepositoryInterface::class),$template);
    }
}
