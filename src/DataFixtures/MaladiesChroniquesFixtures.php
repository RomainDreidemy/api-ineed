<?php

namespace App\DataFixtures;

use App\Entity\MaladieChronique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MaladiesChroniquesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $csv = file_get_contents(__DIR__ . '/../../public/datas/maladies-chroniques.csv');

        $maladiesChroniques = explode("\r\n", $csv);

        foreach ($maladiesChroniques as $mc){
            if (!empty(trim($mc))){
                $maladieChronique = new MaladieChronique();

                $maladieChronique
                    ->setName($mc)
                ;

                $manager->persist($maladieChronique);
            }
        }

        $manager->flush();
    }
}
