<?php

namespace App\DataFixtures;

use App\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SpecialitesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=consultations_des_centres_de_sante&rows=5200&facet=nom_de_lactivite&facet=specialite&facet=adresse_code_postal&facet=adresse_ville');
        $json = json_decode($api);

        $specialites = [];

        foreach ($json->records as $record){
            $record = $record->fields;

            if(!in_array($record->specialite, $specialites)){
                $specialites[] = $record->specialite;

                $specialite = new Specialite();

                $specialite
                    ->setName($record->specialite)
                    ->setDescription($record->description)
                ;

                $manager->persist($specialite);
            }
        }

        $manager->flush();
    }
}
