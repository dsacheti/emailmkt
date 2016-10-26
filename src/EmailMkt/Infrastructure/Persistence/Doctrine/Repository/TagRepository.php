<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMkt\Domain\Entity\Tag;
use EmailMkt\Domain\Persistence\TagRepositoryInterface;

class TagRepository extends EntityRepository implements TagRepositoryInterface
{

    public function create($entity): Tag
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function update($entity): Tag
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

    public function find($id): Tag
    {
        //acessando o EntityRepository que faz o trabalho
        return parent::find($id);
    }

    public function findAll(): array
    {
       return parent::findAll();
    }
}