<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMkt\Application\Action\Teste2PageAction;
use EmailMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    //funciona da mesma maneira que __invoke, mas só funciona para o zend/servicemanager
//    public function createService(ServiceLocatorInterface $serviceLocator)
//    {
//
//        $entityManager = $serviceLocator->get(EntityManager::class);
//        return $entityManager->getRepository(Customer::class);
//    }
}
