<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $api = file_get_contents('https://opendata.paris.fr/api/records/1.0/search/?dataset=consultations_des_centres_de_sante&rows=5200&facet=nom_de_lactivite&facet=specialite&facet=adresse_code_postal&facet=adresse_ville');
        $json = json_decode($api);

        dd($json->records);

        $specialites = [];
        $centresDeSantes = [];

        foreach ($json->records[0] as $record){
            if(!in_array($record['specialite'], $specialites)){
                $specialites[] = $record['specialite'];
                $centresDeSantes[] = $record['Oto-rhino-laryngologie'];
            }
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
