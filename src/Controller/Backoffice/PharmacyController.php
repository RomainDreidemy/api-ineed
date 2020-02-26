<?php

namespace App\Controller\Backoffice;

use App\Entity\Pharmacie;
use App\Form\PharmacyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PharmacyController extends AbstractController
{
    /**
     * @Route("/administration/pharmacy", name="pharmacy")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EntityManagerInterface $entityManager)
    {
        return $this->render('pharmacy/index.html.twig', [
            'pharmacies' => $entityManager->getRepository(Pharmacie::class)->findBy([], ['name' => 'ASC']),
        ]);
    }

    /**
     * @Route("/administration/pharmacy/add", name="pharmacy_add")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPharmacy(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(PharmacyType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The new Pharmacy have been added');
            return $this->redirectToRoute('pharmacy');
        }

        return $this->render('pharmacy/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Add a Pharmacy'
        ]);
    }

    /**
     * @Route("/administration/pharmacy/update/{id}", name="pharmacy_update")
     * @param Pharmacie $pharmacie
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updatePharmacy(Pharmacie $pharmacie,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(PharmacyType::class, $pharmacie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();
            $this->addFlash('success', 'The Pharmacy have been updated');
            return $this->redirectToRoute('pharmacy');
        }

        return $this->render('pharmacy/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Update a Pharmacy'
        ]);
    }

    /**
     * @Route("/administration/pharmacy/delete/{id}", name="pharmacy_delete")
     * @param Pharmacie $pharmacie
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletePharmacy(Pharmacie $pharmacie,EntityManagerInterface $entityManager)
    {
        $entityManager->remove($pharmacie);
        $entityManager->flush();
        $this->addFlash('success', 'The Pharmacy have been removed');
        return $this->redirectToRoute('pharmacy');
    }

    /**
     * @Route("/administration/pharmacy/see/{id}", name="pharmacy_see")
     * @param Pharmacie $pharmacie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seePharmacy(Pharmacie $pharmacie)
    {
        return $this->render('pharmacy/see.html.twig', [
            'pharmacy' => $pharmacie
        ]);
    }
}
