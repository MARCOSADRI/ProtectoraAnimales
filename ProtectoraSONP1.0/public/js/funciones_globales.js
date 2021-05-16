/*Función que genera un mensaje emergente en la parte superior derecha de la pantalla*/
function fn_mensaje(p_tipo, p_mensaje, p_tiempo){
    /*Creación de los elementos*/
    let contenedor_global = document.getElementById("contenedor_global");
    let contenedor = document.createElement("div"); //Contenedor
    let expresion = document.createElement("div"); //Contenedor figura
    let mensaje = document.createElement("div"); //Contenedor mensaje
    let h3 = document.createElement("h3"); //Mensaje
    let span = document.createElement("span"); //Figura
    /*Asignación de identificadores*/
    contenedor.setAttribute("id", "contenedor");
    expresion.setAttribute("id", "expresion");
    mensaje.setAttribute("id", "mensaje");
    span.setAttribute("id", "check");
    /*Aplicación del mensaje en el campo*/
    h3.innerHTML = p_mensaje;
    /*Introducción de elementos*/
    mensaje.appendChild(h3);
    contenedor.appendChild(expresion);
    contenedor.appendChild(mensaje);
    /*Fondos*/
    if(p_tipo == 'success'){
        span.classList.add("fas");
        span.classList.add("fa-check-circle");
        contenedor.style.backgroundColor = "rgb(91, 173, 91)";
    }else if(p_tipo == 'warning'){
        span.classList.add("fas");
        span.classList.add("fa-exclamation-circle");
        contenedor.style.backgroundColor = "orange";
    }else if(p_tipo == 'alert'){
        span.classList.add("fas");
        span.classList.add("fa-times-circle");
        contenedor.style.backgroundColor = "red";
    }
    expresion.appendChild(span);
    contenedor_global.appendChild(contenedor);

    $(document).ready(function(){
        setTimeout(function(){
            $('#contenedor').fadeOut(800);
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