<?php
namespace EmailMkt\Domain\Service;

use EmailMkt\Domain\Entity\Campaign;

interface CampaignEmailSenderInterface extends EmailServiceInterface
{
    public function setCampaign(Campaign $campaign);
}