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

        foreach ($json->records as $record) {
            $record = $record->fields;

            if(!isset($centresDeSantes[$record->nom_du_centre_de_sante])){
                $centresDeSantes[$record->nom_du_centre_de_sante] = [
                    'name' => $record->nom_du_centre_de_sante,
                    'address' => $record->adresse_rue,
                    'telephone' => str_replace(' ', '',$record->numero_de_telephone),
                    'latitude' => $record->latitude,
                    'longitude' => $record->longitude,
                    'cp' => $record->adresse_code_postal,
                    'time_start' => $record->heure_de_debut,
                    'time_end' => $record->heure_de_fin
                ];
            }else{
                if($centresDeSantes[$record->nom_du_centre_de_sante]['time_start'] > $record->heure_de_debut){
                    $centresDeSantes[$record->nom_du_centre_de_sante]['time_start'] = $record->heure_de_debut;
                }

                if($centresDeSantes[$record->nom_du_centre_de_sante]['time_end'] < $record->heure_de_fin){
                    $centresDeSantes[$record->nom_du_centre_de_sante]['time_end'] = $record->heure_de_fin;
                }
            }
        }


        foreach ($centresDeSantes as $record){

            $centreDeSante = new CentreDeSante();

            $centreDeSante
                ->setName($record['name'])
                ->setAddress($record['address'])
                ->setTelephone($record['telephone'])
//                    ->setWebsite()
                ->setLatitude($record['latitude'])
                ->setLongitude($record['longitude'])
                ->setArrondissement(
                    $manager->getRepository(Arrondissement::class)->findOneBy([
                        'postal_code' => ($record['cp'] == 750012) ? 75012 : $record['cp']
                    ])
                )
                ->setTimeStart(new \DateTime($record['time_start']))
                ->setTimeEnd(new \DateTime($record['time_end']))
            ;

            $manager->persist($centreDeSante);
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
