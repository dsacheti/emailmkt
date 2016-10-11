<?php

namespace EmailMkt\Application\Action\City;

use EmailMkt\Application\Form\CityForm;
//use EmailMkt\Domain\Entity\City;
use EmailMkt\Domain\Entity\City;
use EmailMkt\Domain\Persistence\CityRepositoryInterface;
use EmailMkt\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;


class CityUpdatePageAction
{

    private $template;

    /**
     * @var CityRepositoryInterface
     *
     */
    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CityForm
     */
    private $form;

    public function __construct(
        CityRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CityForm $form)
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
        //$form = new CityForm();
        $this->form->bind($entity);

        if($request->getMethod() == 'POST'){
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);
            if($this->form->isValid()){
                $entity = $this->form->getData();
                $this->repository->update($entity);

                $flash = $request->getAttribute('flash');
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS,'Cidade atualizada com sucesso!');

                $uri = $this->router->generateUri('city.list');
                return new RedirectResponse($uri);
            }
        }
        return new HtmlResponse($this->template->render("app::city/update",[
            'form' => $this->form
        ]));
    }
}
