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
        $csv = file_get_contents(__DIR__ . '/../../public/datas/hopitaux.csv');

        $hopitaux = explode("\r\n", $csv);

        foreach ($hopitaux as $h){
            $h = explode(';', $h);
            $h[3] = str_replace(' ', '', $h[3]);
            dump($h);
        }
        dd();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
