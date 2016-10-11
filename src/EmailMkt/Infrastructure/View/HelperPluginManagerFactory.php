<?php

namespace EmailMkt\Infrastructure\View;

use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class HelperPluginManagerFactory
{
    public function __invoke(ContainerInterface $container): HelperPluginManager
    {
        $config = $container->get('Config');
        $viewHelpers = $config['view_helpers'];
        $manager = new HelperPluginManager($container,$viewHelpers);
        $phpRenderer = new PhpRenderer();
        $phpRenderer->setHelperPluginManager($manager);

        return $manager;
    }


}
