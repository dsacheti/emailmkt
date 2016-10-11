<?php

namespace EmailMkt\Application\Action\Customer;

use EmailMkt\Application\Form\CustomerForm;
use EmailMkt\Domain\Entity\Customer;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;


class CustomerDeletePageAction
{

    private $template;

    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CustomerForm
     */
    private $form;

    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CustomerForm $form)
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $renderParams = [
            'form' => $this->form
    ];
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        //$form = new CustomerForm();
        $this->form->bind($entity);
        //se tem dados vindos na requisição e estes vem com o método post
        if($request->getMethod() == 'POST'){
            $this->repository->remove($entity);
            $flash = $request->getAttribute('flash');//pega um objecto do tipo atributo da requisição
            $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS,'Contato excluído!');//seta os valores para este objeto
            $renderParams['messageIcon'] = 'fa-thumbs-up';
            $uri = $this->router->generateUri('customer.list');
            return new RedirectResponse($uri);
        }

        //se não tem dados com o método post:
        return new HtmlResponse($this->template->render("app::customer/delete",$renderParams));
    }
}
