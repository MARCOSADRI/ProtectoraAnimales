
/*Botones*/
/* let btn_alta_animal = document.getElementById("btn_alta_animal"); */ //Botón para mostrar el formulario de alta.
let hola = document.getElementById("btn_administrar_animales"); //Botón que muestra el listado de animales.
let btn_filtrar_animal = document.getElementById("filtro");


/*Campos de texto*/
let input_tipo_form = document.getElementById("accion");

/*Regiones*/
let r_listado_animales = document.getElementById("region_listado_animales"); //Región que contiene la tabla de los animales.
let r_menu_opciones = document.getElementById("region_menu_opciones"); //Contenedor de todas las opciones.





/*Evento que muestra la tabla con el listado de animales y oculta lo demás*/
btn_admin_animal.addEventListener("click", () => {
    r_listado_animales.removeAttribute("style");
    /* btn_filtrar_animal.removeAttribute("style"); */
    r_menu_opciones.style = "display:none";
});