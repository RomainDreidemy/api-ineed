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

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/user/new", name="home")
     */
    public function newUser(EntityManagerInterface $entityManager, Request $request)
    {
        if(!$request->isMethod('POST')){
            return $this->json([
                'Auth' => false
            ]);
        }

        $email = $request->get('email');
        $password = $request->get('password');


        return $this->json([
            'Auth' => true,
            'Email' => $email,
            'Password' => $password
        ]);
    }
}
