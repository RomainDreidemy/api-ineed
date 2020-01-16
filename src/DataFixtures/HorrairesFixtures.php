<?php

namespace App\DataFixtures;

use App\Entity\CentreDeSante;
use App\Entity\Horraire;
use App\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HorrairesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=consultations_des_centres_de_sante&rows=5200&facet=nom_de_lactivite&facet=specialite&facet=adresse_code_postal&facet=adresse_ville');
        $json = json_decode($api);

        foreach ($json->records as $record) {
            $record = $record->fields;

            $check = false;

            if(preg_match('/^[0-9]+:[0-9]+/', $record->heure_de_debut) || preg_match('/^[0-9]+:[0-9]+/', $record->heure_de_fin)) {
                $check = true;
            }

            $horraire = new Horraire();

            $horraire
                ->setCentreDeSante(
                    $manager->getRepository(CentreDeSante::class)->findOneBy([
                        'name' => $record->nom_du_centre_de_sante
                    ])
                )
                ->setSpecialite(
                    $manager->getRepository(Specialite::class)->findOneBy([
                        'name' => $record->specialite
                    ])
                )
                ->setJour($record->jour)
                ->setTimeStart(new \DateTime(($check === true) ? $record->heure_de_debut : '00:00'))
                ->setTimeEnd(new \DateTime(($check === true) ? $record->heure_de_fin : '00:00'))
            ;

            $manager->persist($horraire);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            SpecialitesFixtures::class,
            CentresDeSantesFixtures::class
        ];
    }
}