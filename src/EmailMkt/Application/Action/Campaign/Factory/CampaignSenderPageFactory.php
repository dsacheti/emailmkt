<?php

namespace EmailMkt\Application\Action\Campaign\Factory;

use EmailMkt\Application\Action\Campaign\CampaignSenderPageAction;
use EmailMkt\Application\Form\CampaignForm;
use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use EmailMkt\Domain\Service\CampaignEmailSenderInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;;

class CampaignSenderPageFactory
{
    public function __invoke(ContainerInterface $container): CampaignSenderPageAction
    {
        $repository = $container->get(CampaignRepositoryInterface::class);
        $template = $container->get(TemplateRendererInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CampaignForm::class);
        $emailSender = $container->get(CampaignEmailSenderInterface::class);
        return new CampaignSenderPageAction($repository,$template,$router,$form,$emailSender);
    }
}
