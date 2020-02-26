<?php

namespace App\Controller\Backoffice;

use App\Entity\Profil;
use App\Entity\User;
use App\Form\ProfilAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/administration/profils", name="profils_list")
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $profils = $entityManager->getRepository(Profil::class)->findAll();

        return $this->render('profil/index.html.twig', [
            'profils' => $profils,
        ]);
    }

    /**
     * @Route("/administration/user/{id}/profils/add", name="profils_add")
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addProfil(User $user,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(ProfilAddType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $data->setUser($user);

            $entityManager->persist($data);

            $entityManager->flush();

            $this->addFlash('success', 'The profil have been add for the user ' . $user->getId());

            return $this->redirectToRoute('users_see', ['id'=> $user->getId()]);
        }

        return $this->render('profil/add-update.html.twig', [
            'title' => 'Add a profil',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/update/{id}", name="profils_update")
     * @param Profil $profil
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateProfil(Profil $profil,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(ProfilAddType::class, $profil);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);

            $entityManager->flush();

            $this->addFlash('success', 'The profil have been updated');

            return $this->redirectToRoute('users_see', ['id'=> $profil->getUser()->getId()]);
        }

        return $this->render('profil/add-update.html.twig', [
            'title' => 'Update a profil',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/profils/delete/{id}", name="profils_delete")
     * @param Profil $profil
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProfil(Profil $profil, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($profil);
        $entityManager->flush();
        $this->addFlash('success', 'The profil have been remove');
        return $this->redirectToRoute('users_see', ['id' => $profil->getUser()->getId()]);
    }

    /**
     * @Route("/administration/profils/see/{id}", name="profils_see")
     * @param Profil $profil
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seeProfil(Profil $profil, EntityManagerInterface $entityManager)
    {
        return $this->render('profil/see.html.twig', [
            'profil' => $profil
        ]);
    }

}
