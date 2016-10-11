<?php
declare(strict_types=1);
namespace EmailMkt\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMkt\Domain\Entity\Customer;
use Faker\Factory as Faker;

//AbstractFixture vai permitir colocar os customer em um container
class CustomerFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        foreach (range(1,100) as $key =>$value){
            $customer = new Customer();
            $customer->setName($faker->name);
            $customer->setEmail($faker->email);
            $manager->persist($customer);
            //para o container
            $this->addReference("Customer - $key",$customer);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     * quanto menor, mais prioridade
     * mesmo a mais prioritária pode ser colocado um
     * numero alto, porque se aparecer alguma outra
     * com maior prioridade, não vai haver problemas     *
     *
     */
    public function getOrder(): int
    {
        return 100;
    }
}