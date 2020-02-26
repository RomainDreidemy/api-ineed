<?php

namespace App\Controller\Backoffice;

use App\Entity\Arrondissement;
use App\Form\ArrondissementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArrondissementController extends AbstractController
{
    /**
     * @Route("/administration/arrondissements", name="arrondissement_list")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $arrondissements = $entityManager->getRepository(Arrondissement::class)->findBy([], ['postal_code' => 'ASC']);

        return $this->render('arrondissement/index.html.twig', [
            'controller_name' => 'ArrondissementController',
            'arrondissements' => $arrondissements
        ]);
    }

    /**
     * @Route("/administration/arrondissements/see/{id}", name="arrondissement_see")
     * @param Arrondissement $arrondissement
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seeArrondissement(Arrondissement $arrondissement)
    {
        return $this->render('arrondissement/see.html.twig', [
            'arrondissement' => $arrondissement
        ]);
    }


    /**
     * @Route("/administration/arrondissements/add", name="arrondissement_add")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addArrondissement(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(ArrondissementType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The new arrondissement have been added');
            return $this->redirectToRoute('arrondissement_list');
        }

        return $this->render('arrondissement/add-update.html.twig', [
            'title' => 'Create an arrondissement',
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/administration/arrondissements/update/{id}", name="arrondissement_update")
     * @param Arrondissement $arrondissement
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateArrondissement(Arrondissement $arrondissement,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(ArrondissementType::class, $arrondissement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The arrondissement have been updated');
            return $this->redirectToRoute('arrondissement_list');
        }

        return $this->render('arrondissement/add-update.html.twig', [
            'title' => 'Update an arrondissement',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/arrondissements/delete/{id}", name="arrondissement_delete")
     * @param Arrondissement $arrondissement
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteArrondissement(Arrondissement $arrondissement,EntityManagerInterface $entityManager)
    {
        $entityManager->remove($arrondissement);
        $entityManager->flush();
        $this->addFlash('success', 'The arrondissement ' . $arrondissement->getPostalCode() . ' have been remove');
        return $this->redirectToRoute('arrondissement_list');
    }
}
