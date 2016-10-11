<?php

namespace EmailMkt\Application\Middleware;

use EmailMkt\Infrastructure\View\HelperPluginManagerFactory;
use EmailMkt\Infrastructure\View\Twig\TwigRenderer;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\View\HelperPluginManager;

class TwigMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return TwigMiddleware
     */
    public function __invoke(ContainerInterface $container): TwigMiddleware
    {
        /** @var TwigRenderer $container */
        $twigRenderer = $container->get(TemplateRendererInterface::class);
        $twigEnv = $twigRenderer->getTemplate();
        $helperManager = $container->get(HelperPluginManager::class);
        return new TwigMiddleware($twigEnv,$helperManager);
    }
}
