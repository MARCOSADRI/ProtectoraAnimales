
/*Botones*/
let altaPerroButton = document.getElementById("altaPerroButton"); //Botón para mostrar el formulario de alta.

/*Otros elementos*/
let filaOpcionesPrincipal = document.getElementById("filaOpcionesPrincipal"); //Contenedor de todas las opciones.
let formularioAlta = document.getElementById("regionAnadir"); //Contenedor del formualario de ingreso de animal.
let accionBD = document.getElementById("accion");



/*Evento que muestra el formulario de alta de animal*/
altaPerroButton.addEventListener("click", () => {
    formularioAlta.removeAttribute("style");
    filaOpcionesPrincipal.style = "display:none";
    accionBD.value = "alta";
});