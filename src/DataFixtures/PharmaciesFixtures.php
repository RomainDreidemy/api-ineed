<?php

namespace App\DataFixtures;

use App\Entity\Pharmacie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PharmaciesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pharmacies = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie.json'));

        foreach ($pharmacies as $p){
            $p = $p->fields;

            $pharmacie = new Pharmacie();

            $pharmacie
                ->setName($p->rs)
                ->setAddress(($p->numvoie ?? '') . ' ' . ($p->typvoie ?? '') . ' ' . ($p->voie ?? ''))
                ->setTelephone($p->telephone ?? 0)
                ->setTelecopie($p->telecopie ?? 0)
                ->setLatitude($p->lat)
                ->setLongitude($p->lng)
            ;
            $manager->persist($pharmacie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            ArrondissementsFixtures::class
        ];
    }
}
