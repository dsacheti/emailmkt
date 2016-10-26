<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMkt\Domain\Entity\Campaign;
use Interop\Container\ContainerInterface;

class CampaignRepositoryFactory
{
    public function __invoke(ContainerInterface $container):CampaignRepository
    {
        /**
         * @var EntityManager $entityManager
         */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Campaign::class);
    }

}