<?php

namespace App\Controller;

use App\Entity\CategorieMaladieChronique;
use App\Entity\Profil;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
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

        dd($centresDeSantes);


        return $this->json([
           'Projet' => 'I need (API)',
            'Développeur' => 'Romain Dreidemy'
        ]);
    }
}
