<?php

namespace EmailMkt\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig_Environment;
use Zend\View\HelperPluginManager;


class TwigMiddleware
{

    /**
     * @var \Twig_Environment $twigEnv
     */
    private $twigEnv;

    /**
     * @var HelperPluginManager $helperManager
     */
    private $helperManager;

    public function __construct(\Twig_Environment $twigEnv,HelperPluginManager $helperManager)
    {


        $this->twigEnv = $twigEnv;
        $this->helperManager = $helperManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $helperManager = $this->helperManager;
        //name é um plugin para o formulario qeu não foi encontrado
        $this->twigEnv->registerUndefinedFunctionCallback(function($name) use ($helperManager){
            if (!$helperManager->has($name)) {
                return false;
            }
            $callable = [$helperManager->get($name),'__invoke'];
            $options = ['is_safe' =>['html']];
            return new \Twig_SimpleFunction(null,$callable,$options);
        });
        return $next($request,$response);
    }


}
