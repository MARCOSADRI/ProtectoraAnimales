<?php

namespace App\Controller;

use App\Entity\Tamano;
use App\Entity\User;
use App\Entity\Ficha;
use App\Entity\Animal;
use App\Repository\EspecieRepository;
use App\Repository\FichaRepository;
use App\Repository\RazaRepository;
use App\Repository\TamanoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/nousar")
 */

class ProtectoraController extends AbstractController
{
    private $userPassword;

    /*Constructor*/
    public function __construct(UserPasswordEncoderInterface $userPassword)
    {
        $this->userPassword = $userPassword;
    }

    /**
     * @Route("/", name="protectora")
     */
    public function index(): Response
    {
        return $this->render('protectora/bienvenida.html.twig', [
            'controlador_bienvenida' => 'ProtectoraController',
        ]);
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
        return $this->render('protectora/registro.html.twig', [
            'controladorRegistro' => $user,
        ]);
    }

    /**
     * @Route("/principal/{id}", name="app_pagina_principal")
     */
    public function pagina_principal(int $id, Request $request, TamanoRepository $tamRepo,
    EspecieRepository $espeRepo, RazaRepository $razaRepo, FichaRepository $fichaRepo): Response
    {
        $animal = new Animal();
        $ficha = new Ficha();

        /*Captura de datos del formulario a través de la clase REQUEST*/
        $nombreA = $request->request->get("nombre", null); //string
        $especieA = $request->request->get("especie", null); //int
        $razaA = $request->request->get("raza", null); //int
        $tamano = $request->request->get("tamano", null); //int
        $edadA = $request->request->get("edad", null); //string
        $sexoA = $request->request->get("sexo", null); //string
        $fotoA = $request->request->get("file", null); //string
        $campo_auxiliar = $request->get("accion", null); //string


        if($nombreA !== null && $especieA !== null && $razaA !== null && $tamano !== null && $edadA !== null &&
        $campo_auxiliar !== null && $sexoA !== null && $fotoA !== null){
            if(!empty($nombreA) && !empty($especieA) && !empty($razaA) && !empty($tamano) && !empty($edadA) &&
            !empty($campo_auxiliar) && !empty($sexoA) && !empty($fotoA)){
                /*Llamada del Entity Manager*/
                $em = $this->getDoctrine()->getManager();
                /*Comprobación del campo auxiliar para realizar una determinada acción*/
                if($campo_auxiliar == "alta"){
                    /*Inserciones en FICHA*/
                    /*Datos por defecto en una ficha al dar de alta a un animal*/
                    $ficha->setEsterilizado(false);
                    $ficha->setFallecido(false);
                    /*Obtención de identificadores foráneos*/
                    $idTamano = $tamRepo->obtenerIdTamano2($id);
                    $idEspecie = $espeRepo->obtenerIdTamano($especieA);
                    $idRaza = $razaRepo->obtenerIdTamano($razaA);
                    

                    /* $id = implode($tamRepo->obtenerIdTamano2($em)[0]);
                    print($id); */


                    /*Inserciones en ANIMAL*/
                    $animal->setNombreA($nombreA);
                    $animal->setTamano($idTamano);
                    $animal->setRaza($idRaza);
                    $animal->setEspecie($idEspecie);
                    $animal->setEdad($edadA);
                    $animal->setSexo($sexoA);
                    $animal->setFoto($fotoA);
                    
                    /*Inserciones a las tablas*/
                    $em->persist($ficha);
                    $em->persist($animal);
                    $em->flush();
                }
            }
        }
        return $this->render('protectora/pagina_principal.html.twig', [
            'paginaPrincContr' => $animal, $ficha,
        ]);
    }
}
