<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Machin extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<2000;$i++){


         $product = new \App\Entity\Machin();
         $product->setDescription('coucou je suis une description');
         $manager->persist($product);
    }
        $manager->flush();
    }
}
