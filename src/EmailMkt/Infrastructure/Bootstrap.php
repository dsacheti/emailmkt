<?php
namespace EmailMkt\Infrastructure;

use EmailMkt\Domain\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    public function create()
    {
        require __DIR__.'/config/doctrine.php';
    }
}