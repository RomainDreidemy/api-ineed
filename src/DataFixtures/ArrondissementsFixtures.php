<?php

namespace App\DataFixtures;

use App\Entity\Arrondissement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArrondissementsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=arrondissements&lang=fr&rows=30&sort=-c_ar');
        $json = json_decode($api);

        foreach ($json->records as $arrondissement){
            $arrond = new Arrondissement();

            $arrond
                ->setName(
                    ($arrondissement->fields->c_ar == 1) ? '1er arrondissement' : $arrondissement->fields->c_ar . 'eme arrondissement'
                )
                ->setPostalCode(
                    (strlen($arrondissement->fields->c_ar) == 1) ? '7500' . $arrondissement->fields->c_ar : '750' . $arrondissement->fields->c_ar
                )
            ;

            $manager->persist($arrond);
        }

        $manager->flush();
    }
}
