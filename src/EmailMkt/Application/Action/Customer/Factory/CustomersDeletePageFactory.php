<?php

namespace EmailMkt\Application\Action\Customer\Factory;

use EmailMkt\Application\Action\Customer\CustomerDeletePageAction;
use EmailMkt\Application\Form\CustomerForm;
use EmailMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;

class CustomersDeletePageFactory
{
    public function __invoke(ContainerInterface $container): CustomerDeletePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(CustomerForm::class);
        return new CustomerDeletePageAction($repository,$template,$router,$form);
    }
}
