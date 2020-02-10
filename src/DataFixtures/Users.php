<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Users extends Fixture
{
    private $encode;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encode = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i > 10; $i++){
            $user = new User();

            $user
                ->setEmail('test' . $i . '@gmail.com')
                ->setPassword($this->encode->encodePassword($user, 'testUser'))
            ;

            $manager->persist($user);
        }

        $user = new User();

        $user
            ->setEmail('romaindreidemy@gmail.com')
            ->setPassword($this->encode->encodePassword($user, 'Etxzh93r'))
            ->setRoles(['ROLE_ADMIN'])
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
