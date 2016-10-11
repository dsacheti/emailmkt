<?php

namespace EmailMkt\Application\Action\Customer\Factory;

use EmailMkt\Application\Action\Customer\CustomerListPageAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;

class CustomersListPageFactory
{
    public function __invoke(ContainerInterface $container): CustomerListPageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        return new CustomerListPageAction($repository,$template);
    }
}
