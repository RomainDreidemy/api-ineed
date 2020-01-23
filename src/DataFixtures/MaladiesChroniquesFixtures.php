<?php

namespace App\DataFixtures;

use App\Entity\CategorieMaladieChronique;
use App\Entity\MaladieChronique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MaladiesChroniquesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $csv = file_get_contents(__DIR__ . '/../../public/datas/maladies-chroniques.csv');

        $maladiesChroniques = explode("\r\n", $csv);

        $alreadyImport = [];

        foreach ($maladiesChroniques as $mc){
            if (!empty(trim($mc))){

                $m = explode(";", $mc);



                if (!in_array($m[0], $alreadyImport)){
                    $categorie = new CategorieMaladieChronique();

                    $categorie
                        ->setName($m[0])
                    ;

                    $manager->persist($categorie);

                    $alreadyImport[] = $m[0];
                }
            }
        }

        $manager->flush();

        foreach ($maladiesChroniques as $mc){
            if (!empty(trim($mc))){
                $m = explode(";", $mc);

                $categorie = $manager->getRepository(CategorieMaladieChronique::class)->findOneBy(
                    [
                        'name' => $m[0]
                    ]
                );

                $maladieChronique = new MaladieChronique();

                $maladieChronique
                    ->setName($m[1])
                    ->setCategorieMaladieChronique($categorie)
                ;

                $manager->persist($maladieChronique);
            }
        }

        $manager->flush();
    }
}
