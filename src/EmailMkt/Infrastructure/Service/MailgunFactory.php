<?php
namespace EmailMkt\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;

class MailgunFactory
{
    public function __invoke(ContainerInterface $container): Mailgun
    {
        $key = $container->get('config')['mailgun']['key'];
        //echo 'key:'.$key.' - domain:'.$dm;
        //die();
        return new Mailgun($key);
    }
}