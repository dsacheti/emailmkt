<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMkt\Domain\Entity\Customer;
use EmailMkt\Domain\Persistence\CustomerRepositoryInterface;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{

    public function create($entity): Customer
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function update($entity): Customer
    {
        if ($this->getEntityManager()->getUnitOfWork()->getEntityState($entity) !=UnitOfWork::STATE_MANAGED) {
            $this->getEntityManager()->merge($entity);
        }
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function find($id): Customer
    {
        //acessando o EntityRepository que faz o trabalho
        return parent::find($id);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }
}