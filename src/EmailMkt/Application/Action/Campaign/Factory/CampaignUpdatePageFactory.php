<?php

namespace EmailMkt\Application\Action\Campaign\Factory;

use EmailMkt\Application\Action\Campaign\CampaignUpdatePageAction;
use EmailMkt\Application\Form\CampaignForm;
use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;;

class CampaignUpdatePageFactory
{
    public function __invoke(ContainerInterface $container): CampaignUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CampaignForm::class);
        return new CampaignUpdatePageAction($repository,$template,$router,$form);
    }
}
