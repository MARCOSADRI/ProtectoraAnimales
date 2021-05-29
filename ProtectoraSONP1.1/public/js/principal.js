
/*Botones*/
let btn_alta_animal = document.getElementById("btn_alta_animal"); //Botón para mostrar el formulario de alta.
let btn_admin_animal = document.getElementById("btn_administrar_animales"); //Botón que muestra el listado de animales.



/*Campos de texto*/
let input_tipo_form = document.getElementById("accion");

/*Regiones*/
let r_listado_animales = document.getElementById("region_listado_animales"); //Región que contiene la tabla de los animales.
let r_menu_opciones = document.getElementById("region_menu_opciones"); //Contenedor de todas las opciones.


/* let formularioAlta = document.getElementById("regionAnadir"); */ //Contenedor del formualario de ingreso de animal.
/* let contenedorImagen = document.getElementsByClassName("contenedor_imagen")[0]; */ //Contenedor de la imagen del animal.
/*Evento que muestra el formulario de alta de animal*/
/* altaPerroButton.addEventListener("click", () => {
    formularioAlta.removeAttribute("style");
    filaOpcionesPrincipal.style = "display:none";
    accionBD.value = "alta";
}); */




/*Evento que muestra la tabla con el listado de animales y oculta lo demás*/
btn_admin_animal.addEventListener("click", () => {
    r_listado_animales.removeAttribute("style");
    r_menu_opciones.style = "display:none";
});