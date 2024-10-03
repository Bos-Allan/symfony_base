<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaire;

// src/DataFixtures/CommentaireFixture.php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaire;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentaireFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $commentaires = [
            ['content' => 'Délicieux burger !', 'burger_reference' => 'burger_0'],
            ['content' => 'Je n\'ai pas aimé la sauce.', 'burger_reference' => 'burger_1'],
        ];

        foreach ($commentaires as $commentaireData) {
            $commentaire = new Commentaire();
            $commentaire->setName($commentaireData['content']);
            $commentaire->setBurger($this->getReference($commentaireData['burger_reference']));
            $this->getReference($commentaireData['burger_reference']);
            $manager->persist($commentaire);
            
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            BurgerFixture::class,
        ];
    }
}
