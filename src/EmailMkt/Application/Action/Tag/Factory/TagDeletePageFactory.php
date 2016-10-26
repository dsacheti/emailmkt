<?php

namespace EmailMkt\Application\Action\Tag\Factory;

use EmailMkt\Application\Action\Tag\TagDeletePageAction;
use EmailMkt\Application\Form\TagForm;
use EmailMkt\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagDeletePageFactory
{
    public function __invoke(ContainerInterface $container): TagDeletePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        $router = $container->get(RouterInterface::class);
        $form = $container->get(TagForm::class);
        return new TagDeletePageAction($repository,$template,$router,$form);
    }
}
