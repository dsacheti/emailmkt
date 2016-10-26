<?php

namespace EmailMkt\Application\Action\Campaign;

use EmailMkt\Application\Form\CampaignForm;
use EmailMkt\Domain\Persistence\CampaignRepositoryInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;


class CampaignUpdatePageAction
{

    private $template;

    /**
     * @var CampaignRepositoryInterface
     *
     */
    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CampaignForm
     */
    private $form;

    public function __construct(
        CampaignRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form)
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
        $this->form->bind($entity);

        if($request->getMethod() == 'POST'){
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);
            if($this->form->isValid()){
                $entity = $this->form->getData();
                $this->repository->update($entity);

                $flash = $request->getAttribute('flash');
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS,'Campanha atualizada com sucesso!');

                $uri = $this->router->generateUri('campaign.list');
                return new RedirectResponse($uri);
            }
        }
        return new HtmlResponse($this->template->render("app::campaign/update",[
            'form' => $this->form
        ]));
    }
}
