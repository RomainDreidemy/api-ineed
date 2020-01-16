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
        $pharmacies = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie.json'));

        foreach ($pharmacies as $p){
            $p = $p->fields;
            dd($p);
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
