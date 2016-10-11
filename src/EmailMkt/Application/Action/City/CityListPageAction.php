<?php

namespace EmailMkt\Application\Action\City;

use EmailMkt\Domain\Persistence\CityRepositoryInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;


class CityListPageAction
{

    private $template;

    /**
     * @var CityRepositoryInterface
     */
    private $repository;

    public function __construct(CityRepositoryInterface $repository,Template\TemplateRendererInterface $template = null)
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
        $cities = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        return new HtmlResponse($this->template->render(
            "app::city/list",
            [
                "cities" => $cities,
                "message" =>$flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS),
                "messageIcon" => "fa-thumbs-up"
            ]));
    }
}
