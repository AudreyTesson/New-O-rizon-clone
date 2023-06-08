<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Bluemmb\Faker\PicsumPhotosProvider;
use Faker\Factory;
use Faker\Provider\fr_FR\Address;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new PicsumPhotosProvider($faker));
        $faker->addProvider(new Address($faker));

        $levels = ["","low", "medium", "high"];

        // Create 50 countries
        $countries = [];
        for ($i=1; $i<51; $i++)
        {
            $country = new Country();

            $country    ->setName($faker->country())
                        ->setVisa($faker->word())
                        ->setVisaIsRequired($faker->boolean())
                        ->setCurrency($faker->currencyCode())
                        ->setImage($faker->imageUrl(640, 480, false))
                        ->setCreatedAt($faker->dateTime());

            $countries[] = $country;

            $manager->persist($country);
        }

        // Create 200 cities

        
        for ($i=1; $i<201; $i++)
        {
            $city = new City();

            // Random selection of one country
            $randomCountry = $countries[mt_rand(0, count($countries)-1)];

            // Random selection of one level
            $randomLevel = $levels[mt_rand(0, count($levels)-1)];

            $city   ->setName($faker->city())
                    ->setArea($faker->numberBetween(1,300000))
                    ->setCost($faker->randomNumber(6, false))
                    ->setEnvironment($faker->word())
                    ->setHousing($randomLevel)
                    ->setLanguage($faker->word())
                    ->setInternet($randomLevel)
                    ->setDemography($faker->numberBetween(1, 40000000))
                    ->setElectricity($randomLevel)
                    ->setTimezone($faker->numberBetween(-12, 12))
                    ->setTemperatureAverage($faker->numberBetween(-50, 50))
                    ->setSunshineRate($randomLevel)
                    ->setImage($faker->imageUrl(640, 480, false))
                    ->setCreatedAt($faker->dateTime())
                    ->setCountry($randomCountry);

            $manager->persist($city);
        }

        // Create 2 users 

            // Create admin
            $admin = new User();

            $admin  ->setEmail('admin@admin.com')
                    ->setPassword('$2y$13$x.pNoMbX5ikG8Vga/M/XueIl1WcQQmIeIwpasn5NL0/TrM8jURoPC')
                    ->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setUsername($faker->userName())
                    ->setRoles(['ROLE_ADMIN']);

            $manager->persist($admin);

            // Create user
            $user = new User();

            $user   ->setEmail('user@user.com')
                    ->setPassword('$2y$13$vdXTZhmBoGkfamUa5gC7iOCQ1lTDgyPbI6B1bXjL2C7QVzfGrwADu')
                    ->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setUsername($faker->userName())
                    ->setRoles(['ROLE_USER']);

            $manager->persist($user);

        $manager->flush();
    }
}
