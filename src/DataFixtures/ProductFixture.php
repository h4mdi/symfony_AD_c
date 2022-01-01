<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $product = new Product();
            $product->setTitle("Produit N°:$i")
                ->setPrice($i*10)
                ->setImage($i.".jpg");

            $manager->persist($product);

        $manager->flush();
    }
}

}