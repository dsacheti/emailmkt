<?php

namespace EmailMkt\Application\Action\Customer;

use EmailMkt\Application\Form\CustomerForm;
use EmailMkt\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;
use Zend\Hydrator\ClassMethods;

//use Zend\Form\Form;



class CustomerCreatePageAction
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

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse|RedirectResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $renderParams = [
          'form' => $this->form
        ];
        if($request->getMethod() == 'POST'){
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);
            if($this->form->isValid()){
                $entity = $this->form->getData();
                $this->repository->create($entity);

                $flash = $request->getAttribute('flash');
                $flash->setMessage('success','Contato cadastrado com sucesso!');

                $uri = $this->router->generateUri('customer.list');
                return new RedirectResponse($uri);
            }
            $renderParams['message'] = 'Erro ao criar o contato';
            $renderParams['messageType'] = 'danger';
            $renderParams['messageIcon'] = 'fa-frown-o';


        }
        return new HtmlResponse($this->template->render("app::customer/create",$renderParams));
    }
}
