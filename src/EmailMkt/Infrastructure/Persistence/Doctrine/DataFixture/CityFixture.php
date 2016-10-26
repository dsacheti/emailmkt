<?php

namespace EmailMkt\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMkt\Domain\Entity\City;
use Faker\Factory as Faker;

class CityFixture implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $uf=[
        'AC'=>'AC',
        'AL' =>'AL',
        'AM'=>'AM',
        'AP'=>'AP',
        'BA'=>'BA',
        'CE'=>'CE',
        'DF'=>'DF',
        'ES'=>'ES',
        'GO'=>'GO',
        'MA'=>'MA',
        'MT'=>'MT',
        'MS'=>'MS',
        'PA'=>'PA',
        'PB'=>'PB',
        'PE'=>'PE',
        'PI'=>'PI',
        'RO'=>'RO',
        'PR'=>'PR',
        'RJ'=>'RJ',
        'RN'=>'RN',
        'RR'=>'RR',
        'RS'=>'RS',
        'SC'=>'SC',
        'SE'=>'SE',
        'SP'=>'SP',
        'TO'=>'TO'
    ];
        $faker = Faker::create();
        foreach (range(1,50) as $value){
            $city = new City();
            $city->setName($faker->city);
            $city->setUf($faker->randomElement($uf));
            $city->setCep($faker->regexify('[0-9]{5}\-[0-9]{3}'));
            $manager->persist($city);
        }

        $manager->flush();
    }
}