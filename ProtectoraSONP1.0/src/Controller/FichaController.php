<?php

namespace App\Controller;

use App\Entity\Enfermedad;
use App\Entity\Ficha;
use App\Form\FichaType;
use App\Repository\FichaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ficha")
 */
class FichaController extends AbstractController
{
    /**
     * @Route("/", name="ficha_index", methods={"GET"})
     */
    public function index(FichaRepository $fichaRepository): Response
    {
        return $this->render('ficha/index.html.twig', [
            'fichas' => $fichaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/newenfermedad", name="ficha_enfermedad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ficha = new Ficha();
        $enfermedad = new Enfermedad();

        $form = $this->createForm(FichaType::class, $ficha);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficha);
            $entityManager->flush();

            return $this->redirectToRoute('ficha_index');
        }

        return $this->render('ficha/new.html.twig', [
            'ficha' => $ficha,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ficha_show", methods={"GET"})
     */
    public function show(Ficha $ficha): Response
    {
        return $this->render('ficha/show.html.twig', [
            'ficha' => $ficha,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ficha_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ficha $ficha): Response
    {
        $form = $this->createForm(FichaType::class, $ficha);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ficha_index');
        }

        return $this->render('ficha/edit.html.twig', [
            'ficha' => $ficha,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ficha_delete", methods={"POST"})
     */
    public function delete(Request $request, Ficha $ficha): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficha->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ficha);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ficha_index');
    }
}
