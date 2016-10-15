<?php

namespace EmailMkt\Application\Action\Tag;

use EmailMkt\Domain\Persistence\TagRepositoryInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;


class TagListPageAction
{

    private $template;

    /**
     * @var TagRepositoryInterface
     */
    private $repository;

    public function __construct(
        TagRepositoryInterface $repository,
        Template\TemplateRendererInterface $template)
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
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null)
    {
        $tags = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        return new HtmlResponse($this->template->render(
            "app::tag/list",
            [
                "tags" => $tags,
                "message" =>$flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS),
                "messageIcon" => 'fa-thumbs-up'
            ]));
    }
}
