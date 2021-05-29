<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $userPassword;

    /*Constructor*/
    public function __construct(UserPasswordEncoderInterface $userPassword)
    {
        $this->userPassword = $userPassword;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('adri1');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPassword->encodePassword($user, 'admin'));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setUsername('adri2');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->userPassword->encodePassword($user, 'user'));
        $manager->persist($user);
        $manager->flush();
    }
}
