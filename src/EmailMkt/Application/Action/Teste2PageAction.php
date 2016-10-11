<?php

namespace EmailMkt\Application\Action;

use EmailMkt\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;


class Teste2PageAction
{

    private $template;

    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository,Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customer = new Customer();
        $customer->setName("Jovair Novaes");
        $customer->setEmail("jnovaes@hotmail.com");

        $this->repository->create($customer);

        $customers = $this->repository->findAll();
        //app::teste2 é o templates/app/teste2.html.twig
        return new HtmlResponse($this->template->render(
            "app::teste2",
            [
                "data"=>"Dados passados para o template",
                "customers" => $customers
            ]));
    }
}
