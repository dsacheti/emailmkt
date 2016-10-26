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
        //$faker = Faker::create();
        foreach ($this->getData() as $index =>$value){
            $customer = new Customer();
            $customer->setName($value['name']);
            $customer->setEmail($value['email']);
            $manager->persist($customer);
            //para o container
            $this->addReference("customer-$index",$customer);
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

    public function getData()
    {
        return [
            ['name' => 'Dsnei','email' =>'dalcinei@gmail.com'],
            ['name' => 'Dsnei1','email' =>'dalci_sacheti@hotmail.com'],
            ['name' => 'Dsnei2','email' =>'nacenei@yahoo.com.br'],
            ['name' => 'Dsnei3','email' =>'R.VICRO@yahoo.com.br'],
            ['name' => 'Dsnei4','email' =>'dalcinei.sacheti@gmail.com']
        ];
    }
}