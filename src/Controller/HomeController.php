<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        $csv = file_get_contents(__DIR__ . '/../../public/datas/maladies-chroniques.csv');

        $maladiesChroniques = explode("\r\n", $csv);

        foreach ($maladiesChroniques as $mc){
            dump($mc);
        }

        dd();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
