<?php

namespace App\Controller\Backoffice;

use App\Entity\Hopital;
use App\Form\HopitalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/administration/hopital/add", name="hopital_add")
     */
    public function addHopital(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(HopitalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The new Hospital have been added');
            return $this->redirectToRoute('hopital');
        }

        return $this->render('hopital/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Add a hospital'
        ]);
    }

    /**
     * @Route("/administration/hopital/update/{id}", name="hopital_update")
     */
    public function updateHopital(Hopital $hopital,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(HopitalType::class, $hopital);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The Hospital have been updated');
            return $this->redirectToRoute('hopital');
        }

        return $this->render('hopital/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Update a hospital'
        ]);
    }

    /**
     * @Route("/administration/hopital/remove/{id}", name="hopital_remove")
     */
    public function removeHopital(Hopital $hopital,EntityManagerInterface $entityManager)
    {
        $entityManager->remove($hopital);
        $entityManager->flush();
        $this->addFlash('success', 'The Hospital have been removed');
        return $this->redirectToRoute('hopital');
    }
    /**
     * @Route("/administration/hopital/see/{id}", name="hopital_see")
     */
    public function seeHopital(Hopital $hopital,EntityManagerInterface $entityManager)
    {
        return $this->render('hopital/see.html.twig', [
            'hopital' => $hopital
        ]);
    }

}
