<?php

namespace EmailMkt\Application\Action\City\Factory;

use EmailMkt\Application\Action\City\CityListPageAction;
use EmailMkt\Domain\Persistence\CityRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CityListPageFactory
{
    public function __invoke(ContainerInterface $container): CityListPageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CityRepositoryInterface::class);
        return new CityListPageAction($repository,$template);
    }
}
