<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pain;

class PainFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pain = [
            'Pain complet',
            'Pain de mie',
            'Pain aux céréales',
            'Pain aux noix',
            'Pain aux raisins',
            'Pain aux olives',
            'Pain aux lardons'
        ];
        foreach ($pain as $index => $key) {
            $pain = new Pain();
            $pain->setName($key);
            
            $manager->persist($pain);

            $this->addReference('pain_reference_' . $index, $pain);
        }
        $manager->flush();
    }
}
