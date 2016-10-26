<?php


namespace EmailMkt\Infrastructure\Persistence\Doctrine\DataFixture;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMkt\Domain\Entity\Campaign;
use Faker\Factory as Faker;

class CampaignFixture extends AbstractFixture implements FixtureInterface,OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        $template = "<h3>Convite</h3><p>{$faker->paragraph(2)}</p>
<p><a href='http://sites.code.education/curso-php7'>Adquirir</a></p>";
        foreach (range(1,20) as $index => $value) {
            $campaign = new Campaign();
            $campaign
                ->setName($faker->country)
                ->setSubject($faker->sentence(3))
                ->setTemplate($template);

            $manager->persist($campaign);
            //função herdada da AbstractFixture
            $this->addReference("campaign-$index",$campaign);
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
        return 100;
    }
}