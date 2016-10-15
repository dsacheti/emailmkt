<?php

namespace EmailMkt\Application\Action\Tag\Factory;

use EmailMkt\Application\Action\Tag\TagListPageAction;
use EmailMkt\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagListPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        return new TagListPageAction($repository,$template);
    }
}
