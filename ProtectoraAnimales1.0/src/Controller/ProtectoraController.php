<?php

namespace App\Controller;

use App\Entity\Animales;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProtectoraController extends AbstractController
{
    /**
     * @Route("/", name="app_pagina_principal")
     */
    public function index(): Response
    {
        return $this->render('protectora/index.html.twig', [
            'indexContr' => 'ProtectoraController',
        ]);
    }

    /**
     * @Route("/principal", name="app_pagina_principal")
     */
    public function pagina_principal(Request $request): Response
    {
        $animal = new Animales();

        /*Captura de datos del formulario a través de la clase REQUEST*/
        $nombreA = $request->request->get("nombre", null);
        $especieA = $request->request->get("especie", null);
        $razaA = $request->request->get("raza", null);
        $tamanoA = $request->request->get("tamano", null);
        $edadA = $request->request->get("edad", null);
        $campo_auxiliar = $request->get("accion", null);

        if($nombreA !== null && $especieA !== null && $razaA !== null && $tamanoA !== null && $edadA !== null &&
        $campo_auxiliar !== null){
            if(!empty($nombreA) && !empty($especieA) && !empty($razaA) && !empty($tamanoA) && !empty($edadA) &&
            !empty($campo_auxiliar)){
                /*Llamada del Entity Manager*/
                $em = $this->getDoctrine()->getManager();
                /*Comprobación del campo auxiliar para realizar una determinada acción*/
                if($campo_auxiliar === 'alta'){
                    $animal->setNombreA($nombreA);
                    $animal->setEspecie($especieA);
                    $animal->setRaza($razaA);
                    $animal->getTamano($tamanoA);
                    $animal->getEdad($edadA);
                    $em->persist($animal);
                    $em->flush();
                }
            }
        }




        
        return $this->render('protectora/pagina_principal.html.twig', [
            'paginaPrincContr' => 'ProtectoraController',
        ]);
    }
}

