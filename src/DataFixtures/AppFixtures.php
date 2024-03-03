<?php

namespace App\DataFixtures;

use App\Entity\Activiter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
  {
    // activiter
    
    $activiter = [];
    for ($i = 0; $i < 50; $i++) {
        $activiter = new Activiter();
        $activiter->setName($this->faker->word())
            ->setPrice(mt_rand(0, 100));

          $manager->persist($activiter);
    }
       $manager->flush();
  }
     
     
}

    