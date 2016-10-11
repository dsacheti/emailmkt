<?php

namespace EmailMkt\Application\Action;


use EmailMkt\Application\Form\LoginForm;
use EmailMkt\Application\InputFilter\LoginInputFilter;
use EmailMkt\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class LogoutAction
{
    /**
     * @var Router\RouterInterface
     */
    private $router;

    /**
     * @var AuthInterface
     */
    private $autService;

    public function __construct(Router\RouterInterface $router,
        AuthInterface $autService
    )
    {
        $this->router   = $router;
        $this->autService = $autService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->autService->destroy();
        $uri = $this->router->generateUri('auth.login');
        return new RedirectResponse($uri);
    }
}
