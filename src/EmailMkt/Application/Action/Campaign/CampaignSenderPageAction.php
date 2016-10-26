<?php

namespace EmailMkt\Application\Action\Campaign;

use EmailMkt\Application\Form\CampaignForm;
use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use EmailMkt\Domain\Service\CampaignEmailSenderInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;


class CampaignSenderPageAction
{
    /**
     * @var CampaignRepositoryInterface
     */
    //private $repository;
    /**
     * @var Template\TemplateRendererInterface
     */

    private $template;

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CampaignForm
     */
    private $form;
    /**
     * @var CampaignEmailSenderInterface
     */
    private $emailSender;

    public function __construct(
        CampaignRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form,
        CampaignEmailSenderInterface $emailSender)
    {
        $this->template = $template;
        $this->router = $router;
        $this->form = $form;
        $this->emailSender = $emailSender;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        $this->form->bind($entity);

        if($request->getMethod() == 'POST'){
            $this->emailSender->setCampaign($entity);
            $this->emailSender->send();
            $flash = $request->getAttribute('flash');
            $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS,'Campanha realizada com sucesso!');

            $uri = $this->router->generateUri('campaign.list');
            return new RedirectResponse($uri);

        }
        return new HtmlResponse($this->template->render("app::campaign/sender",[
            'form' => $this->form
        ]));
    }
}
