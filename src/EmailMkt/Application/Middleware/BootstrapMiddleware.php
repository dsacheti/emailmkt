<?php

namespace EmailMkt\Application\Middleware;

use EmailMkt\Domain\Service\BootstrapInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class BootstrapMiddleware
{
    /**
     * @var BootstrapInterface
     */
    private $bootstrap;
    /**
     * @var FlashMessageInterface
     */
    private $flash;

    public function __construct(BootstrapInterface $bootstrap,FlashMessageInterface $flash)
    {

        $this->bootstrap = $bootstrap;
        $this->flash = $flash;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->bootstrap->create();
        $request = $request->withAttribute('flash',$this->flash);
        //$request = $this->enganacaoDoMethod($request);
        return $next($request,$response);

    }

   /* protected function enganacaoDoMethod(ServerRequestInterface $request)//enganacao=spoofing
    {
        $data = $request->getParsedBody();
        //'??' é o operador de coalescencia nula, nessa expressão temos
        //se _method está em $data[] $method vai ter o mesmo valor, senão, vai ter um valor vazio
        $method = $data['_method'])?? '';
        $method = strtoupper($method);
        if(in_array($method,['PUT','DELETE'])) {
            $request = $request->withMethod($method);
        }
        return $request;
    }*/
}
