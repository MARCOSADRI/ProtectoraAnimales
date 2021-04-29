<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistroController extends AbstractController
{
    private $userPassword;

    /*Constructor*/
    public function __construct(UserPasswordEncoderInterface $userPassword)
    {
        $this->userPassword = $userPassword;
    }
    /**
     * @Route("/registro", name="app_registro", methods={"GET","POST"})
     */
    public function registrar_usuario(Request $request): Response
    {
        $user = new User();
        /*Capturas de los datos de los formularios*/
        $username = $request->request->get('nombre', null);
        $password = $request->request->get('clave', null);
        $passConfirmada = $request->request->get('claveConf', null);

        if($username !== null && $password !== null && $passConfirmada !== null){
            if(!empty($username) && !empty($password) && !empty($passConfirmada)){
                /*Llamada al EntityManager*/
                $em = $this->getDoctrine()->getManager();
                /*Control de que las dos contraseñas coincidan*/
                if($passConfirmada == $password){
                    $user->setUsername($username);
                    $user->setRoles(['ROLE_USER']);
                    $user->setPassword($this->userPassword->encodePassword($user, $password));
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash("success", "Usuario añadido correctamente");
                }else{
                    $this->addFlash("danger", "Las contraseñas no coinciden");
                }
            }
        }
        return $this->render('registro/registro.html.twig', [
            'controladorRegistro' => $user,
        ]);
    }
}
