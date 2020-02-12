<?php

namespace App\Controller\Backoffice;

use App\Entity\User;
use App\Form\UserAddType;
use App\Form\UserUpdateType;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    /**
     * @Route("/administration/users", name="users_list")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $users = $entityManager->getRepository(User::class)->findBy([],  ['email' => 'ASC']);

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/administration/users/see/{id}", name="users_see")
     */
    public function seeUser(User $user,EntityManagerInterface $entityManager)
    {
        return $this->render('user/see.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/administration/users/add", name="users_add")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function addUser(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(UserAddType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $userService = new UserService();

            if($userService->emailIsUsed($data->getEmail(), $entityManager)){
                $encodePassword = $this->passwordEncoder->encodePassword($data, $data->getPassword());

                $data->setPassword($encodePassword);

                $entityManager->persist($data);
                $entityManager->flush();

                $this->addFlash('success', 'The new user have been add');
                return $this->redirectToRoute('users_list');
            }else{
                $this->addFlash('danger', 'Email already used');
            }
        }

        return $this->render('user/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Add an user'
        ]);
    }

    /**
     * @Route("/administration/users/update/{id}", name="users_update")
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function updateUser(User $user,EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(UserUpdateType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $userService = new UserService();

            if($user->getEmail() !== $data->getEmail()){
                $isUsed = $userService->emailIsUsed($data->getEmail(), $entityManager);
            }else{
                $isUsed = true;
            }

            if($isUsed){

                $entityManager->persist($data);
                $entityManager->flush();

                $this->addFlash('success', 'The user have been updated');
                return $this->redirectToRoute('users_list');
            }else{
                $this->addFlash('danger', 'Email already used');
            }
        }

        return $this->render('user/add-update.html.twig', [
            'form' => $form->createView(),
            'title' => 'Update an user'
        ]);
    }

    /**
     * @Route("/administration/users/delete/{id}", name="users_delete")
     */
    public function deleteUser(User $user, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash('success', 'The user have been remove');
        return $this->redirectToRoute('users_list');
    }
}
