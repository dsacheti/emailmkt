<?php

namespace EmailMkt\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMkt\Application\Form\CampaignForm;
use EmailMkt\Application\InputFilter\CampaignInputFilter;
use EmailMkt\Domain\Entity\Campaign;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CampaignFormFactory
{
    public function __invoke(ContainerInterface $container):CampaignForm
    {
        $entityManager = $container->get(EntityManager::class);
        $form = new CampaignForm();
        $form->setHydrator(new DoctrineHydrator($entityManager));
        $form->setObject(new Campaign());
        $form->setInputFilter(new CampaignInputFilter());
        $form->setObjectManager($entityManager);
        //inicializando os campos
        $form->init();
        return $form;
    }
}