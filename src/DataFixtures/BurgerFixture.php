<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BurgerFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $burgers = [
            //en theorie oignon peut avoir plusieurs a voir apres
            ['name' => 'Burger Poulet', 'price' => 10, 'oignon' => 'oignon_reference_1', 'sauce' => 'sauce_reference_1', 'image' => 'image_reference_1', 'pain' => 'pain_reference_1'],

            ['name' => 'Burger Poisson', 'price' => 11, 'oignon' => 'oignon_reference_3', 'sauce' => 'sauce_reference_2','image' => 'image_reference_2', 'pain' => 'pain_reference_2'],
            ['name' => 'Burger Boeuf', 'price' => 12, 'oignon' => 'oignon_reference_2', 'sauce' => 'sauce_reference_3','image' => 'image_reference_3', 'pain' => 'pain_reference_2'],
            ['name' => 'Burger Végétarien', 'price' => 8, 'oignon' => 'oignon_reference_2', 'sauce' => 'sauce_reference_5','image' => 'image_reference_4', 'pain' => 'pain_reference_2'],
            ['name' => 'Burger Vegan', 'price' => 9, 'oignon' => 'oignon_reference_1', 'sauce' => 'sauce_reference_1','image' => 'image_reference_5', 'pain' => 'pain_reference_2'],
            ['name' => 'Burger Saumon', 'price' => 15, 'oignon' => 'oignon_reference_4', 'sauce' => 'sauce_reference_2','image' => 'image_reference_6', 'pain' => 'pain_reference_2'],
            ['name' => 'Burger Thon', 'price' => 14, 'oignon' => 'oignon_reference_5', 'sauce' => 'sauce_reference_4','image' => 'image_reference_0', 'pain' => 'pain_reference_2'],
        ];

        foreach ($burgers as $index => $burgerData) {
            $burger = new Burger();
            $burger->setName($burgerData['name']);
            $burger->setPrice($burgerData['price']);

            $burger->addOignon($this->getReference($burgerData['oignon']));

            //$burger->addCommentaire($this->getReference('commentaire_reference'));
            $burger->setPain($this->getReference($burgerData['pain']));
            $burger->addSauce($this->getReference($burgerData['sauce']));	
            //faire avec name ? 
            $burger->setImage($this->getReference($burgerData['image']));

            $this->addReference('burger_'.$index, $burger);
            $manager->persist($burger);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OignonFixture::class,
            SauceFixture::class,
            PainFixture::class,
            ImageFixture::class,
        ];
    }
}