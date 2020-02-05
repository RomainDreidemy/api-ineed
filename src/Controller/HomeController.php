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
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager)
    {

        $pharmacies = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie.json'));
        $pharmaciesHorraire = json_decode(file_get_contents(__DIR__ . '/../../public/datas/pharmacie-heure.json'));

//        dump($pharmacies);

        dd($pharmaciesHorraire->data->data->member);

//        return $this->render('home/index.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
    }
}
