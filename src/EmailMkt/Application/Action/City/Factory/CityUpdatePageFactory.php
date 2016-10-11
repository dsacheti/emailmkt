<?php

namespace EmailMkt\Application\Action\City\Factory;

use EmailMkt\Application\Action\City\CityUpdatePageAction;
use EmailMkt\Application\Form\CityForm;
use EmailMkt\Domain\Persistence\CityRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;;

class CityUpdatePageFactory
{
    public function __invoke(ContainerInterface $container): CityUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CityRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CityForm::class);
        return new CityUpdatePageAction($repository,$template,$router,$form);
    }
}
