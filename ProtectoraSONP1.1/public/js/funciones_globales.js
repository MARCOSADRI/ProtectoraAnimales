/*Función que genera un mensaje emergente en la parte superior derecha de la pantalla*/
function fn_mensaje(p_tipo, p_mensaje, p_tiempo){
    /*Contenedor sobre el que se va a cargar el mensaje*/
    let container_fluid = document.getElementsByClassName("container-fluid")[0];
    let ui = document.getElementsByTagName("body")[0];
    /*Creación de los elementos*/
    let c_princ = document.createElement("div"); //C. Principal
    let c_icono = document.createElement("div"); //C. Icono
    let c_mensaje = document.createElement("div"); //C. Mensaje
    let span = document.createElement("span"); //Span del icono según el tipo

    let h3 = document.createElement("h3"); //H3 del texto

    /*Asignación de identificadores*/
    c_princ.id = "mensaje_emergente";
    c_icono.id = "icono_mensaje";
    c_mensaje.id = "cadena_mensaje";

    h3.innerHTML = p_mensaje; //Inserción del mensaje en la página.
    
    c_mensaje.appendChild(h3); //Inserción del H3 al contenedor del mensaje.
    
    //Fondos de los mensajes
    if(p_tipo == 'success'){
        span.classList.add("fas");
        span.classList.add("fa-check-circle");
        c_princ.style.backgroundColor = "rgb(91, 173, 91)";
    }else if(p_tipo == 'warning'){
        span.classList.add("fas");
        span.classList.add("fa-exclamation-circle");
        c_princ.style.backgroundColor = "orange";
    }else if(p_tipo == 'alert'){
        span.classList.add("fas");
        span.classList.add("fa-times-circle");
        c_princ.style.backgroundColor = "red";
    }
    c_icono.appendChild(span); //Inserción del icono del mensaje al contenedor principal.
    c_princ.appendChild(c_icono); //Inserción del contenedor del icono en el contenedor principal.
    c_princ.appendChild(c_mensaje); //Inserción del contenedor del mensaje al contenedor principal.
    ui.appendChild(c_princ) //Inserción al cuerpo de la página el mensaje.

    $(document).ready(function(){
        setTimeout(function(){
            $("#mensaje_emergente").fadeOut(1000)
        }, p_tiempo);
    });
}

















/*Función que genera un campo de texto con los atributos que se espacifiquen en los parámetros*/
/* function fn_crearCampo(p_valor_for, p_nombre_campo, p_tipo_input, p_valor_id){
    let nLabel = document.createElement("label");
    let nInput = document.createElement("input");
    let h5 = document.createElement("h5");
    nLabel.setAttribute("for", p_valor_for);
    nLabel.classList.add("mt-2");
    h5.innerHTML = p_nombre_campo;
    nInput.setAttribute("type", p_tipo_input); 
    nInput.setAttribute("id", p_valor_id);
    nInput.classList.add("form-control");
    nLabel.appendChild(h5);
    formulario.appendChild(nLabel);
    formulario.appendChild(nInput);
} */

export{
    fn_mensaje,
}