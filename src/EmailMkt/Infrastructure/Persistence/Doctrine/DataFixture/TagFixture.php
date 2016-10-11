<?php
namespace EmailMkt\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMkt\Domain\Entity\Tag;
use Faker\Factory as Faker;

//Aqui o AbstractFixture serve para pegar os customers
class TagFixture extends AbstractFixture implements  FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Faker::create();
        foreach (range(1,100) as $key => $value){
            $tag = new Tag();
            $tag->setNome($faker->city);
            $this->addCustomers($tag);
            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function addCustomers(Tag $tag)
    {
        $numCustomers = rand(1,5);
        foreach (range(0,$numCustomers) as $value) {
            //índice do customer:
            $index = rand(0,99);
            $customer = $this->getReference("customer-$index");

           // estrutura para diminuir a chance de pegar um customer repetido
            if ($tag->getCustomers()->exists(function($key,$item) use($customer){
                return ($customer->getId() == $item->getId());
            })){
                $index = rand(0,99);
                $customer = $this->getReference("customer-$index");
            }
            $tag->getCustomers()->add($customer);
        }
    }

    /**
     * Get the order of this fixture
     * quanto menor, mais prioridade
     * mesmo a mais prioritária pode ser colocado um
     * numero alto, porque se aparecer alguma outra
     * com maior prioridade, não vai haver problemas
     *
     */
    public function getOrder()
    {
        return 200;
    }
}