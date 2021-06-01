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
use App\Repository\FichaRepository;
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
    /*Controlador encargado de mostrar la pantalla principal, tanto en modo de administrado como en el 
    modo de usuario normal. Como parámetro se proporciona el repositorio de la entidad de los animales para poder
    realizar la muestra completa de todos los elementos de la entidad. 
    El controlador redirige hacia la plantilla animal/index.html.twig*/

    /**
     * @Route("/", name="animal_index", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository): Response
    {   
        return $this->render('animal/index.html.twig', [
            'animal' => $animalRepository->findAll(),
            /* 'ficha' => $ficha, */
        ]);
    }

    /*Controlador que permite el ingreso de un nuevo animal en la aplicación. Como parámetro, se proporciona 
    el elemento Request para poder realizar el registro de datos en la base de datos a través del formulario.
    En él, se dará de alta el animal, a la misma vez que se realizará la inserción de la ficha del animal.
    El formulario empleado para el alta del animal se creará a partir del archivo AnimalType.php, en el que se 
    creará el formulario y posteriormente se tratará automaticamente en el controlador gracias al método
    handleRequest(). Finalmente el controlador redirige a la plantilla animal/new.html.twig*/

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
    en la tabla de animales. A partir de ello, se podrán visualizar todas las características del animal que se 
    seleccione. Como parámetros del controlador, se puede observar la clase Request para tratar los datos procedentes
    de los diferentes formulario, la clase ficha, para poder filtrar los datos del animal a través de la ficha, los 
    repositorios de revision, vacuna y enfermedad, con el objetivo de que a la hora de registrar alguna de las tres
    opciones, comprobar previamente la existencia de un dato repetido en la base de datos a través de la llamada a las
    diferentes consultas definidas en los mismos. Por último el repositorio de animal, para mostrar los datos pertinentes
    del animal en cada página de ficha del animal.
    */

    /**
     * @Route("/{ficha}", name="animal_show", methods={"GET","POST"})
     */
    public function show(Request $request, Ficha $ficha,  
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
            'animale' => $ar->findAll(),
            'revision' => $rr->findBy(array('ficha' => $ficha)),
            'formE' => $formEnfermedad->createView(),
            'formR' => $formRevision->createView(),
            'formV' => $formVacuna->createView(),
        ]);
    }


    /*Controlador encargado de editar los datos de un animal existente, muestra en el formulario los datos 
    ya establecidos en el animal basandose en el identificador de ficha proporcionado como parámetro. 
    Los parámetros proporcionados al controlador son la clase Request, para actualizar los nuevos datos 
    introducidos. Por otra parte el repositorio de animales para mostrar todos los datos de un animal.
    El controlador redirige a la plantilla animal/edit.html.twig*/

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

    /*Controlador encargado de adoptar una animal existente. Añade el identificador del usuario normal 
    que hay registrado en la aplicación actualmente. 
    Los parámetros proporcionados al controlador son la clase Request, para registrar el dato introducido.
    Además se referencia como parámetro una instancia de Animal para poder realizar el cambio sobre dicha entidad.
    El controlador redirige hacia el controlador animal_index (Página principal)*/
    
    /**
     * @Route("/{ficha}", name="animal_adoptar", methods={"POST"})
     */
    public function adoptarAnimal(Request $request, Animal $animal): Response
    {
        $user = $this->getUser(); //OBTENGO AL USUARIO ACTUALMENTE LOGUEADO
        if ($this->isCsrfTokenValid('adoptar'.$animal->getFicha(), $request->request->get('_token'))) {
           
           $animal->setUsuario($user);
           $this->getDoctrine()->getManager()->flush();
        }

       return $this->redirectToRoute('animal_index');
    }

    /*Controlador encargado de eliminar los datos de un animal existente a partir del parámetro de ruta.
    Los parámetros proporcionados al controlador son la clase Request, para actualizar los nuevos datos 
    introducidos. Por otra parte una instancia de la clase Animal para realizar la acción sobre tal entidad.
    El controlador redirige hacia el controlador animal_index (Página principal)*/

    /**
     * @Route("/{ficha}", name="animal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Animal $animal): Response
    {
        echo "esto entra";
        if ($this->isCsrfTokenValid('delete'.$animal->getFicha(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            /* $id_animal = $ar->findOneBy(array('ficha' => $request->request->get('_token'))); */
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animal_index');
    }
}
