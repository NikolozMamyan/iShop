<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $productData = [
            [
                'id' => 1,
                'name' => 'Smartphone',
                'price' => 500,
                'stock' => 100,
                'description' => 'Smartphone dernier cri avec un écran AMOLED de 6.5 pouces, triple caméra arrière, processeur octa-core et une batterie longue durée.',
            ],
            [
                'id' => 2,
                'name' => 'Laptop',
                'price' => 1200,
                'stock' => 50,
                'description' => 'Ordinateur portable ultraportable avec un écran tactile de 13 pouces, processeur Intel Core i7, SSD rapide et autonomie de batterie jusqu\'à 10 heures.',
            ],
            [
                'id' => 3,
                'name' => 'Casque audio',
                'price' => 100,
                'stock' => 200,
                'description' => 'Casque audio circum-auriculaire sans fil avec annulation active du bruit, qualité audio haute résolution et confortable pour de longues sessions d\'écoute.',
            ],
            [
                'id' => 4,
                'name' => 'Montre connectée',
                'price' => 300,
                'stock' => 80,
                'description' => 'Montre connectée étanche avec écran tactile couleur, suivi d\'activité physique, fréquence cardiaque en temps réel et notifications smartphone.',
            ],
            [
                'id' => 5,
                'name' => 'Tablette',
                'price' => 400,
                'stock' => 75,
                'description' => 'Tablette Android haut de gamme avec un écran IPS de 10 pouces, processeur octa-core, 4 Go de RAM et compatibilité 4G LTE.',
            ],
            [
                'id' => 6,
                'name' => 'Écouteurs sans fil',
                'price' => 80,
                'stock' => 150,
                'description' => 'Écouteurs sans fil Bluetooth avec une autonomie de 10 heures et une qualité sonore cristalline.',
            ],
            [
                'id' => 7,
                'name' => 'Clavier mécanique',
                'price' => 150,
                'stock' => 90,
                'description' => 'Clavier mécanique rétro-éclairé avec switches Cherry MX et une construction robuste en aluminium.',
            ],
            [
                'id' => 8,
                'name' => 'Souris gamer',
                'price' => 70,
                'stock' => 120,
                'description' => 'Souris de gaming haute précision avec capteur optique réglable et 6 boutons programmables.',
            ],
            [
                'id' => 9,
                'name' => 'Enceinte Bluetooth',
                'price' => 120,
                'stock' => 100,
                'description' => 'Enceinte Bluetooth portable avec une puissance de sortie de 20W et une batterie rechargeable intégrée.',
            ],
            [
                'id' => 10,
                'name' => 'Disque dur externe',
                'price' => 200,
                'stock' => 60,
                'description' => 'Disque dur externe USB 3.0 de 1 To avec une vitesse de transfert rapide et une conception élégante en aluminium.',
            ],
        ];
        
        foreach ($productData as $data) {
            $product = new Product();
            $product ->setName($data['name']);
            $product ->setPrice($data['price']);
            $product ->setStock($data['stock']);
            $product ->setDescription($data['description']);
            
            $manager->persist($product);

        }
       
        $manager->flush();
    }
}
