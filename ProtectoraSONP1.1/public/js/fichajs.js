import * as funciones from './funciones_globales.js';

let d_inputs = document.getElementsByClassName("form-control");
/*Evento de muestra de la notificación emergente en caso de que los datos introducidos en la BD sean correctos.*/
window.addEventListener("load", () => {
    /* funciones.fn_mensaje("success", "Datos registrados correctamente.", 2000); */
    document.getElementsByTagName("textarea")[0].innerHTML = ""; //Limpiar TEXTAREA de revisiones.
    
    /*Limpiar inputs*/
    for(let lim of d_inputs){
        lim.value = "";
    }
});









