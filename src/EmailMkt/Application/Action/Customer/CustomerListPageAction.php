<?php

namespace EmailMkt\Application\Action\Customer;

use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;


class CustomerListPageAction
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

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customers = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        return new HtmlResponse($this->template->render(
            "app::customer/list",
            [
                "customers" => $customers,
                "message" =>$flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS),
                "messageIcon" => 'fa-thumbs-up'
            ]));
    }
}
