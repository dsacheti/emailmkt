<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMkt\Domain\Entity\User;
use Faker\Factory as Faker;

class UserFixture implements FixtureInterface,OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //administrador
//        $user = new User();
//        $user->setName('Admin');
//        $user->setEmail('ad@min.com.br');
//        $user->setPlainPassword(12345);
//        $manager->persist($user);
        //outros usuários para teste
        $faker = Faker::create();
        foreach (range(1,10) as $value){
            $user = new User();
            $user->setName($faker->name);
            $user->setEmail($faker->email);
            //é ruim o faker atribuir senha aleatória e não sabermos,
            //e não adianta consultar banco por uma senha hasheada
            $user->setPlainPassword('alepo');
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}