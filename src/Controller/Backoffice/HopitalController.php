<?php

namespace App\Controller\Backoffice;

use App\Entity\Hopital;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HopitalController extends AbstractController
{
    /**
     * @Route("/administration/hopital", name="hopital")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        return $this->render('hopital/index.html.twig', [
            'hopitaux' => $entityManager->getRepository(Hopital::class)->findBy([], ['name' => 'ASC']),
        ]);
    }
}
