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
        return $this->json([
           'Projet' => 'I need (API)',
            'Développeur' => 'Romain Dreidemy',
            'Auth' => $this->getUser() ? true : false
        ]);
    }
}
