<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sauce;

class SauceFixture extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $sauces = [
            'tomate',
            'barbecue',
            'blanche',
            'curry',
            'piquante',
            'moutarde',
            'aïoli'
        ];

        foreach ($sauces as $index => $sauceData) {
            $sauce = new Sauce();
            $sauce->setName($sauceData);
            $manager->persist($sauce);
            $this->setReference('sauce_reference_'. $index,  $sauce);
        }

        $manager->flush();
    }
}
