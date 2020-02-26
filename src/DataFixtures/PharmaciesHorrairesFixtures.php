<?php

namespace App\DataFixtures;

use App\Entity\Pharmacie;
use App\Entity\PharmacieHorraire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PharmaciesHorrairesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pharmacies = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie-heure.json'));

        foreach ($pharmacies->data->data->member as $p){
            $pharmacie = $manager->getRepository(Pharmacie::class)->findOneBy(['name' => trim($p->name)]);

            foreach ($p->weekday_text as $item){
                $horraires = explode(" ", $item);

                if(sizeof($horraires) !== 6){
                    $horraire = (new PharmacieHorraire())
                        ->setPharmacie($pharmacie)
                        ->setDay(substr($horraires[0], 0, -1))
                        ;
                }else{
                    $timeEnd = new \DateTime($horraires[4]);
                    $timeEnd->modify("+ 12 hour");

                    $horraire = (new PharmacieHorraire())
                        ->setPharmacie($pharmacie)
                        ->setDay(substr($horraires[0], 0, -1))
                        ->setTimeStart(new \DateTime($horraires[1]))
                        ->setTimeEnd($timeEnd)
                    ;
                }

                $manager->persist($horraire);

            }
        }
//         $product = new Product();
//         $manager->persist($product);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            PharmaciesFixtures::class
        ];
    }
}
