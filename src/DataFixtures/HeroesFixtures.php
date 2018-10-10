<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Hero;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class HeroesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $slugger = new Slugify();

        $powers = ['Fly', 'Fire', 'Ice', 'Telepathy', 'Telekinesic', 'Thunder', 'Weather', 'Wind'];

        for($i = 0; $i <= 40; $i++) {
            $hero = new Hero();
            $hero->setName($faker->name)
                 ->setSlug($slugger->slugify($hero->getName()))
                 ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>')
                 ->setPicture('https://api.adorable.io/avatars/285/'.$hero->getSlug().'.png')
                 ->setPowers($faker->randomElements($powers));
            $manager->persist($hero);
        }

        $manager->flush();
    }
}
