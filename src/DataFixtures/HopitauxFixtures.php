<?php

namespace App\DataFixtures;

use App\Entity\Arrondissement;
use App\Entity\Hopital;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HopitauxFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $csv = file_get_contents(__DIR__ . '/../../public/datas/hopitaux.csv');

        $hopitaux = explode("\r\n", $csv);

        foreach ($hopitaux as $h){
            $h = explode(';', $h);
            $h[3] = str_replace(' ', '', $h[3]);

            $hopital = new Hopital();

            $hopital
                ->setName($h[0])
                ->setAddress($h[1])
                ->setTelephone($h[3])
                ->setArrondissement(
                    $manager->getRepository(Arrondissement::class)->findOneBy(
                        [
                            'postal_code' => $h[2]
                        ]
                    )
                )
                ->setLatitude($h[4])
                ->setLongitude($h[5])
            ;
             $manager->persist($hopital);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArrondissementsFixtures::class
        ];
    }
}
