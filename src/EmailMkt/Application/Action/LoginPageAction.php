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

class LoginPageAction
{
    /**
     * @var Router\RouterInterface
     */
    private $router;
    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;
    /**
     * @var LoginForm
     */
    private $form;
    /**
     * @var AuthInterface
     */
    private $autService;

    public function __construct(Router\RouterInterface $router,
        Template\TemplateRendererInterface $template,
        LoginForm $form,
        AuthInterface $autService
    )
    {
        $this->router   = $router;
        $this->template = $template;
        $this->form = $form;
        $this->autService = $autService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $renderParams = [
          'form' => $this->form
        ];
        if ($request->getMethod()=='POST') {
            $data = $request->getParsedBody();
            $this->form->setData($data);
            if ($this->form->isValid()) {
                $user = $this->form->getData();
                if ($this->autService->authenticate($user['email'],$user['password'])) {
                    $uri = $this->router->generateUri('customer.list');
                    return new RedirectResponse($uri);
                }
                $renderParams['message'] = 'Login e/ou senha inválidos';
                $renderParams['messageType'] = 'danger';
                $renderParams['messageIcon'] = 'fa-frown-o';
            }
        }
        return new HtmlResponse($this->template->render('app::login',$renderParams));
    }
}
