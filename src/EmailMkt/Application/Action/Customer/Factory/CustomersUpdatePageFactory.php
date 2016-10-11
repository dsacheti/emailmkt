<?php

namespace EmailMkt\Application\Action\Customer\Factory;

use EmailMkt\Application\Action\Customer\CustomerUpdatePageAction;
use EmailMkt\Application\Form\CustomerForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;

class CustomersUpdatePageFactory
{
    public function __invoke(ContainerInterface $container): CustomerUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CustomerForm::class);
        return new CustomerUpdatePageAction($repository,$template,$router,$form);
    }
}
