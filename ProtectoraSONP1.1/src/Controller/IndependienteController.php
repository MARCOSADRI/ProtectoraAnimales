<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndependienteController extends AbstractController
{
    /**
     * @Route("/independiente", name="independiente", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('independiente/index.html.twig', [
            'controller_name' => 'IndependienteController',
        ]);
    }
}
