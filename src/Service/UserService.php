<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function emailIsUsed($email, EntityManagerInterface $entityManager)
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if(!is_null($user)){
            return false;
        }

        return true;
    }
}