<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMkt\Domain\Entity\City;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CityRepositoryFactory
{
    public function __invoke(ContainerInterface $container): CityRepository
    {
        /**
         * @var EntityManager $entityManager
         */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(City::class);
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
