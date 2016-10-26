<?php

namespace EmailMkt\Application\Action\Campaign\Factory;

use EmailMkt\Application\Action\Campaign\CampaignListPageAction;
use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignListPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $mailGun = $container->get(Mailgun::class);
        return new CampaignListPageAction($repository,$template,$mailGun);
    }
}
