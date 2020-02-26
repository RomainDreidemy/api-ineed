<?php

namespace App\Controller\Backoffice;

use App\Entity\CentreDeSante;
use App\Form\HealthCenterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CentreDeSanteController extends AbstractController
{
    /**
     * @Route("administration/health-center", name="health_center")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EntityManagerInterface $entityManager)
    {
        return $this->render('centre_de_sante/index.html.twig', [
            'health_centers' => $entityManager->getRepository(CentreDeSante::class)->findBy([], ['name' => 'ASC']),
        ]);
    }

    /**
     * @Route("administration/health-center/add", name="health_center_add")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addHealthCenter(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(HealthCenterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            $this->addFlash('success', 'The new health center have been added');
            return $this->redirectToRoute('health_center');
        }

        return $this->render('centre_de_sante/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Add a health center'
        ]);
    }

    /**
     * @Route("administration/health-center/update/{id}", name="health_center_update")
     * @param CentreDeSante $centreDeSante
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateHealthCenter(CentreDeSante $centreDeSante,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(HealthCenterType::class, $centreDeSante);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            $this->addFlash('success', 'The health center have been updated');
            return $this->redirectToRoute('health_center');
        }

        return $this->render('centre_de_sante/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Update a health center'
        ]);
    }

    /**
     * @Route("administration/health-center/delete/{id}", name="health_center_remove")
     * @param CentreDeSante $centreDeSante
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteHealthCenter(CentreDeSante $centreDeSante, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($centreDeSante);
        $entityManager->flush();
        $this->addFlash('success', 'The health center ' . $centreDeSante->getName() . ' have been removed');
        return $this->redirectToRoute('health_center');
    }

    /**
     * @Route("administration/health-center/see/{id}", name="health_center_see")
     * @param CentreDeSante $centreDeSante
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seeHealthCenter(CentreDeSante $centreDeSante,EntityManagerInterface $entityManager)
    {
       return $this->render('centre_de_sante/see.html.twig', [
           'health_center' => $centreDeSante
       ]);
    }
}
