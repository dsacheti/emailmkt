<?php

namespace EmailMkt\Application\Action\Customer\Factory;

use EmailMkt\Application\Action\Customer\CustomerCreatePageAction;
use EmailMkt\Application\Form\CustomerForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;
use Zend\View\HelperPluginManager;

class CustomersCreatePageFactory
{
    public function __invoke(ContainerInterface $container): CustomerCreatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CustomerForm::class);
        return new CustomerCreatePageAction($repository,$template,$router,$form);
    }
}
