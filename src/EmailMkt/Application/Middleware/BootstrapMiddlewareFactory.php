<?php

namespace EmailMkt\Application\Middleware;

use EmailMkt\Domain\Service\FlashMessageInterface;
use EmailMkt\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();
        $flash = $container->get(FlashMessageInterface::class);
        return new BootstrapMiddleware($bootstrap,$flash);
    }
}
