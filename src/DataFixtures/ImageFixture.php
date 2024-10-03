<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Image;

class ImageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            'image1',
            'image2',
            'image3',
            'image4',
            'image5',
            'image6',
            'image7'
        ];

        foreach ($images as $index => $imageData) {
            $image = new Image();
            $image->setName($imageData);
            $manager->persist($image);
            
            $this->addReference('image_reference_'.$index, $image);
        }

        $manager->flush();
    }
}
