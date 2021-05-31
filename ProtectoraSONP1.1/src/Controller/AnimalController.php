<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Enfermedad;
use App\Entity\Revision;
use App\Entity\Vacuna;
use App\Entity\Especie;
use App\Entity\Ficha;
use App\Entity\User;
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
            'animal' => $animalRepository->findAll(),
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
    RevisionRepository $rr, EnfermedadRepository $er, VacunaRepository $vr, AnimalRepository $ar): Response
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
            $n_enf = $formEnfermedad->get("nombreE")->getData();
            $comp_enf = $er->comprobarEnfermedades($n_enf, $ficha);
            /* print_r($comp_enf); */
            /*Control de existencia de enferemedades*/
            if($comp_enf[1] == 0){
                $ficha->getId(); 
                $enfermedad->setFicha($ficha); 
                $em->persist($enfermedad);
                $em->flush();
                $this->addFlash("success", "La enfermedad ha sido registrada correctamente.");
            }else{
                $this->addFlash("warning", "El dato intriducido ya existe en la base de datos.");
            }
        }else if($formVacuna->isSubmitted() && $formVacuna->isValid()){
            $n_vac = $formVacuna->get("nombreV")->getData();
            $comp_vac = $vr->comprobarVacunas($n_vac, $ficha);
            /* print_r($comp_vac); */
            /*Control de existencia de vacunas*/
            if($comp_vac[1] == 0){
                $ficha->getId();
                $vacuna->setFicha($ficha);
                $em->persist($vacuna);
                $em->flush();
                $this->addFlash("success", "La vacuna ha sido registrada correctamente.");
            }else{
                $this->addFlash("warning", "El dato intriducido ya existe en la base de datos.");
            }
        }else if($formRevision->isSubmitted() && $formRevision->isValid()){
            $ficha->getId();
            $revision->setFicha($ficha);
            $em->persist($revision);
            $em->flush();
            $this->addFlash("success", "La revisión ha sido registrada correctamente.");
        }
        
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'animale' => $ar->findAll(),
            'revision' => $rr->findBy(array('ficha' => $ficha)),
            'formE' => $formEnfermedad->createView(),
            'formR' => $formRevision->createView(),
            'formV' => $formVacuna->createView(),
        ]);
    }




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
