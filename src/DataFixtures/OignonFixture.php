<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Oignon;

class OignonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oignons = [
            'rouges',
            'frits',
            'confits',
            'caramélisés',
            'grillés',
            'crus',
            'cuits'
        ];

        foreach ($oignons as $index => $oignonData) {
            $oignon = new Oignon();
            $oignon->setName($oignonData);
            $manager->persist($oignon);

            $this->addReference('oignon_reference_' . $index, $oignon);
        }

        $manager->flush();
    }
}
