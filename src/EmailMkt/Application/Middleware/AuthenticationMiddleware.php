<?php

namespace EmailMkt\Application\Middleware;

use EmailMkt\Domain\Service\AuthInterface;
use EmailMkt\Domain\Service\BootstrapInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;


class AuthenticationMiddleware
{


    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var AuthInterface
     */
    private $authService;

    public function __construct(RouterInterface $router, AuthInterface $authService)
    {


        $this->router = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        //verifica se o usuário está autenticado
        if (!$this->authService->isAuth()) {
            $uri = $this->router->generateUri('auth.login');
            return new RedirectResponse($uri);
        }
        return $next($request,$response);
    }


}
