<?php

namespace EmailMkt\Application\Action\Campaign;

use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Mailgun\Mailgun;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;


class CampaignListPageAction
{

    private $template;

    /**
     * @var CampaignRepositoryInterface
     */
    private $repository;

    public function __construct(
        CampaignRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        Mailgun $mailGun)
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
        $campaigns = $this->repository->findAll();
        $flash = $request->getAttribute('flash');
        return new HtmlResponse($this->template->render(
            "app::campaign/list",
            [
                "campaigns" => $campaigns,
                "message" =>$flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS),
                "messageIcon" => 'fa-thumbs-up'
            ]));
    }
}
