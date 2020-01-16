<?php

namespace App\DataFixtures;

use App\Entity\CentreDeSante;
use App\Entity\Horraire;
use App\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SpeciliteToCdsixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=consultations_des_centres_de_sante&rows=5200&facet=nom_de_lactivite&facet=specialite&facet=adresse_code_postal&facet=adresse_ville');
        $json = json_decode($api);

        foreach ($json->records as $record) {
            $record = $record->fields;


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
