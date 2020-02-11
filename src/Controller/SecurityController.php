<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/users/add", name="addUser", methods={"POST"})
     */
    public function userAdd(Request $request, EntityManagerInterface $entityManager)
    {
        if($_SERVER['REQUEST_METHOD']==='POST' && empty($_POST)) {
            $_POST = json_decode($request->getContent(), true);
        }

        $is_exist_user = $entityManager->getRepository(User::class)->findOneBy(['email' => $_POST['email']]);

        if(is_null($is_exist_user)){

            $user = new User();

            $user
                ->setEmail($_POST['email'])
                ->setPassword($this->encoder->encodePassword($user, $_POST['password']))
            ;

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json([
                'user' => $user
            ]);
        }else{
            return $this->json([
                'error' => 'Email already use'
            ], 500);
        }
    }
}
