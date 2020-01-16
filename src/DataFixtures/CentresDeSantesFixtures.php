<?php

namespace App\DataFixtures;

use App\Entity\Arrondissement;
use App\Entity\CentreDeSante;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CentresDeSantesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=consultations_des_centres_de_sante&rows=5200&facet=nom_de_lactivite&facet=specialite&facet=adresse_code_postal&facet=adresse_ville');
        $json = json_decode($api);

        $centresDeSantes = [];

        foreach ($json->records as $record){
            $record = $record->fields;

            if(!in_array($record->nom_du_centre_de_sante, $centresDeSantes)){
                $centresDeSantes[] = $record->nom_du_centre_de_sante;

                $centreDeSante = new CentreDeSante();

                $centreDeSante
                    ->setName($record->nom_du_centre_de_sante)
                    ->setAddress($record->adresse_rue)
                    ->setTelephone(
                        str_replace(' ', '',$record->numero_de_telephone)
                    )
//                    ->setWebsite()
                    ->setLatitude($record->latitude)
                    ->setLongitude($record->longitude)
                    ->setArrondissement(
                        $manager->getRepository(Arrondissement::class)->findOneBy([
                            'postal_code' => ($record->adresse_code_postal == 750012) ? 75012 : $record->adresse_code_postal
                        ])
                    )
                ;

                $manager->persist($centreDeSante);
            }
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
