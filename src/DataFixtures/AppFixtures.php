<?php

namespace App\DataFixtures;

use App\Factory\RecordFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        RecordFactory::new()->createMany(50);
    }
}
