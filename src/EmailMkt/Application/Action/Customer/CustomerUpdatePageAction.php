<?php

namespace EmailMkt\Application\Action\Customer;

use EmailMkt\Application\Form\CustomerForm;
//use EmailMkt\Domain\Entity\Customer;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;


class CustomerUpdatePageAction
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
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        //$form = new CustomerForm();
        $this->form->bind($entity);
        if($request->getMethod() == 'POST'){
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);
            if($this->form->isValid()){
                $entity = $this->form->getData();
                $this->repository->update($entity);

                $flash = $request->getAttribute('flash');
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS,'Contato modificado com sucesso!');

                $uri = $this->router->generateUri('customer.list');
                return new RedirectResponse($uri);
            }
        }
        return new HtmlResponse($this->template->render("app::customer/update",[
            'form' => $this->form
        ]));
    }
}
