<?php

namespace EmailMkt\Application\Action\City\Factory;

use EmailMkt\Application\Action\City\CityDeletePageAction;
use EmailMkt\Application\Form\CityForm;
use EmailMkt\Domain\Persistence\CityRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CityDeletePageFactory
{
    public function __invoke(ContainerInterface $container): CityDeletePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CityRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CityForm::class);
        return new CityDeletePageAction($repository,$template,$router,$form);
    }
}
