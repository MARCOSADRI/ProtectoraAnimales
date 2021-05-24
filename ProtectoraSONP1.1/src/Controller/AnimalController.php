<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Enfermedad;
use App\Entity\Revision;
use App\Entity\Vacuna;
use App\Entity\Especie;
use App\Entity\Ficha;
use App\Entity\Raza;
use App\Entity\Tamano;
use App\Form\AnimalType;
use App\Form\EnfermedadType;
use App\Form\RevisionType;
use App\Form\VacunaType;
use App\Repository\AnimalRepository;
use App\Repository\EnfermedadRepository;
use App\Repository\RevisionRepository;
use App\Repository\VacunaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/animal")
 */
class AnimalController extends AbstractController
{
    /**
     * @Route("/", name="animal_index", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository): Response
    {
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="animal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $animal = new Animal();
        $ficha = new Ficha(); /*Creación de la instancia de Ficha para que se inserte simultaneamente*/

        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $file = $form['foto']->getData(); //Se recoge el fichero de la foto
            $extension = $file->guessExtension(); //Se recoge la extensión del fichero
            $file_name = time().".".$extension;  //Nombre del fichero
            $file->move("img", $file_name); //Se mueve el fichero a la carpeta de imagenes

            $animal->setFoto($file_name);

            /*Inserciones a la tabla de ficha*/
            $ficha->setFallecido(false);
            $ficha->setEsterilizado(false);
            $entityManager->persist($ficha);

            /*Inserciones en la tabla de animal*/
            $animal->setFicha($ficha); //Coge el objeto de ficha
            $entityManager->persist($animal);
            $entityManager->flush();

            /*Redirección*/
            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /*Controlador que muestra la ficha del animal. Se le pasa como parámetro el ID de la ficha referenciado
    en la tabla de animales*/

    /**
     * @Route("/{ficha}", name="animal_show", methods={"GET","POST"})
     */
    public function show(Request $request, Ficha $ficha, Animal $animal,
    VacunaRepository $vr, RevisionRepository $rr, EnfermedadRepository $er): Response
    {
        $enfermedad = new Enfermedad();
        $revision = new Revision();
        $vacuna = new Vacuna();
        /* $animal = new Animal(); */

        $formEnfermedad = $this->createForm(EnfermedadType::class, $enfermedad); //Formulario enferemedad
        $formEnfermedad->handleRequest($request);

        $formRevision = $this->createForm(RevisionType::class, $revision); //Formulario revisión
        $formRevision->handleRequest($request);

        $formVacuna = $this->createForm(VacunaType::class, $vacuna); //Formulario vacuna
        $formVacuna->handleRequest($request);

        /*Llamada a Entity Manager*/
        $em = $this->getDoctrine()->getManager();

        /*Formulario Enfermedad*/
        if($formEnfermedad->isSubmitted() && $formEnfermedad->isValid()){
            $ficha->getId(); //Se obtiene el ID de la ficha del animal actual.
            $enfermedad->setFicha($ficha); //Inserción del campo en Enfermedades.
            $em->persist($enfermedad);
            $em->flush();
        }else if($formRevision->isSubmitted() && $formRevision->isValid()){
            $ficha->getId();
            $revision->setFicha($ficha);
            $em->persist($revision);
            $em->flush();
        }else if($formVacuna->isSubmitted() && $formVacuna->isValid()){
            $ficha->getId();
            $vacuna->setFicha($ficha);
            $em->persist($vacuna);
            $em->flush();
        }else{

        }


        

        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'revision' => $rr->findBy(array('ficha' => $ficha)),
            'vacuna' => $vr->findBy(array('ficha' => $ficha)),
            'enfermedad' => $er->findBy(array('ficha' => $ficha)),
            'formE' => $formEnfermedad->createView(),
            'formR' => $formRevision->createView(),
            'formV' => $formVacuna->createView(),
        ]);
    }
















    /**
     * @Route("/{ficha}/enfermedad", name="app_registro_enfermedad", methods={"GET","POST"})
     */
    /* public function anadirEnfermedad(Request $request): Response
    {
        $enfermedad = new Enfermedad();

        $formEnfermedad = $this->createForm(EnfermedadType::class, $enfermedad);
        $formEnfermedad->handleRequest($request);

        if($formEnfermedad->isSubmitted() && $formEnfermedad->isValid()){
            $em = $this->getDoctrine()->getManager();
        }
        return $this->render('animal/show.html.twig', [
            'enfermedad' => $enfermedad,
            'formE' => $formEnfermedad->createView(),
        ]);
    } */


    /**
     * @Route("/{ficha}/edit", name="animal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Animal $animal): Response
    {
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animal_delete", methods={"POST"})
     */
    public function delete(Request $request, Animal $animal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animal_index');
    }
}
