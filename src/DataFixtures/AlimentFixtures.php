<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AlimentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $aliment_1 = new Aliment();
        $aliment_1->setNom("Carotte")
            ->setCalorie(80)
            ->setImage("carotte.png")
            ->setLipide(12.34)
            ->setGlucide(3.90)
            ->setProteine(2.9)
            ->setPrix(23.9);
        $manager->persist($aliment_1);
        $aliment_2 = new Aliment();
        $aliment_2->setNom("Tomate")
            ->setCalorie(52)
            ->setImage("tomate.png")
            ->setLipide(11.34)
            ->setGlucide(2.90)
            ->setProteine(1.9)
            ->setPrix(21.9);
        $manager->persist($aliment_2);
        $aliment_3 = new Aliment();
        $aliment_3->setNom("salade")
            ->setCalorie(33)
            ->setImage("salade.png")
            ->setLipide(11.34)
            ->setGlucide(3.90)
            ->setProteine(21.9)
            ->setPrix(20.9);
        $manager->persist($aliment_3);
        $aliment_4 = new Aliment();
        $aliment_4->setNom("Oignon")
            ->setCalorie(12)
            ->setImage("oignon.png")
            ->setLipide(9.34)
            ->setGlucide(3.90)
            ->setProteine(1.9)
            ->setPrix(22.9);
        $manager->persist($aliment_4);
        $aliment_5 = new Aliment();
        $aliment_5->setNom("mangue")
            ->setCalorie(30)
            ->setImage("mangue.png")
            ->setLipide(2.34)
            ->setGlucide(4.90)
            ->setProteine(12.9)
            ->setPrix(21.9);
        $manager->persist($aliment_5);


        $manager->flush();
    }
}
