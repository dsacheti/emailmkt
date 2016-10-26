<?php
declare(strict_types=1);

namespace EmailMkt\Infrastructure\Service;

use EmailMkt\Domain\Entity\Campaign;
use EmailMkt\Domain\Service\CampaignEmailSenderInterface;
use Mailgun\Mailgun;
use Mailgun\Messages\BatchMessage;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignEmailSender implements CampaignEmailSenderInterface
{
    /**
     * @var Campaign
     */
    private $campaign;
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;
    /**
     * @var array
     */
    private $mailGunConfig;
    /**
     * @var Mailgun
     */
    private $mailgun;

    public function __construct(TemplateRendererInterface $templateRenderer, Mailgun $mailgun, array $mailGunConfig)
    {
        $this->templateRenderer = $templateRenderer;
        $this->mailGunConfig = $mailGunConfig;
        $this->mailgun = $mailgun;
    }

    public function setCampaign(Campaign $campaign): CampaignEmailSender
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function send()
    {
        //toArray() é um método de Collection do Doctrine
        $tags = $this->campaign->getTags()->toArray();
        $batchMessage = $this->getBatchMessage();
        foreach ($tags as $tag) {
            $batchMessage->addTag($tag->getNome());
            $customers = $tag->getCustomers()->toArray();
            foreach ($customers as $customer) {
                $name = (!$customer->getName()or $customer->getName() == '')
                    ? $customer->getEmail():$customer->getName();
                $batchMessage->addToRecipient($customer->getEmail(),['full_name' => $name]);
            }
        }
        $batchMessage->finalize();
    }

    protected function getBatchMessage(): BatchMessage
    {
        $batchMessage = $this->mailgun->BatchMessage($this->mailGunConfig['domain']);
        //pode lançar até 3 campanhas no mesmo BatchMessage - no máximo
        $batchMessage->addCampaignId("envio-{$this->campaign->getId()}");
        //quem envia - segundo parametro como array pode ser full_name,first_name,last_name
        $batchMessage->setFromAddress("nacenei@yahoo.com.br",['full_name'=> 'Dalcinei Sacheti']);
        $batchMessage->setSubject($this->campaign->getSubject());
        //para usar o template é preciso usar o setHtmlBody
        $batchMessage->setHtmlBody($this->getHtmlBody());

        return $batchMessage;
    }

    protected function getHtmlBody(): string
    {
        $template = $this->campaign->getTemplate();
        return $this->templateRenderer->render('app::campaign/_campaign_template',
            [
                'content' => $template
            ]
        );
    }
}