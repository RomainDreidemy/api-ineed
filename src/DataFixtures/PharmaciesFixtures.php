<?php

namespace App\DataFixtures;

use App\Entity\Arrondissement;
use App\Entity\Pharmacie;
use App\Entity\PharmacieHorraire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PharmaciesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pharmacies = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie-heure.json'));

        foreach ($pharmacies->data->data->member as $p){

            $pharmacie = new Pharmacie();

            $pharmacie
                ->setName($p->name ?? null)
                ->setAddress($p->address ?? null)
                ->setTelephone($p->telephone ?? null)
                ->setTelecopie($p->telecopie ?? null)
                ->setLatitude($p->latitude ?? null)
                ->setLongitude($p->longitude ?? null)
                ->setArrondissement(
                    $manager->getRepository(Arrondissement::class)->findOneBy(
                        [
                            'postal_code' => $p->Arrondissement
                        ]
                    )
                )
                ->setOpenNight($p->open_night ?? null)
                ->setOpenSunday($p->open_sunday ?? null)
                ->setOpenAll($p->open_all ?? null)
                ->setPlaceId($p->place_id ?? '')
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
