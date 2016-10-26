<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;

class CustomerRepositoryFactory
{
    public function __invoke(ContainerInterface $container):CustomerRepository
    {
        /**
         * @var EntityManager $entityManager
         */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Customer::class);
    }

}