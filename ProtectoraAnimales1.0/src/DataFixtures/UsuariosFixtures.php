<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsuariosFixtures extends Fixture
{
    private $userPassword;

    public function __construct(UserPasswordEncoderInterface $userPassword)
    {
        $this->userPassword = $userPassword;
    }
    public function load(ObjectManager $manager)
    {
        $usuario = new User();
        $usuario->setUsername('adri1');
        $usuario->setRoles(['ROLE_ADMIN']);
        /*Establecimiento de la contraseña*/
        $usuario->setPassword($this->userPassword->encodePassword($usuario, 'usuario'));
        $manager->persist($usuario);
        $manager->flush();

        $usuario = new User();
        $usuario->setUsername('adri2');
        $usuario->setRoles(['ROLE_USER']);
        /*Establecimiento de la contraseña*/
        $usuario->setPassword($this->userPassword->encodePassword($usuario, 'admin'));
        $manager->persist($usuario);
        $manager->flush();
    }
}
