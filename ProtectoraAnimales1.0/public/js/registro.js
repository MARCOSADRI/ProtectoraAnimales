let formulario = document.getElementsByTagName("span")[1];
/*Evento que al seleccionar con el puntero el campo de contraseña, genera otro campo
para confirmar la contraseña.*/
let campo = document.getElementById("clave");
/* campo.addEventListener("click", generarCampo); */ //Evento al hacer click
/* campo.addEventListener("onkeyup", generarCampo); */ //Evento al
$(document).ready(function(){
    $('#nombre').blur(function(){
        $('#nombre').off('blur');
        let nLabel = document.createElement("label");
        let nInput = document.createElement("input");
        let h5 = document.createElement("h5");
        nLabel.setAttribute("for", "nuevaContra");
        nLabel.classList.add("mt-2");
        h5.innerHTML = "Confirmar nueva contraseña.";
        nInput.setAttribute("type", "password"); 
        nInput.setAttribute("name", "claveConf");
        nInput.setAttribute("id", "nuevaContra");
        nInput.classList.add("form-control");
        nLabel.appendChild(h5);
        formulario.appendChild(nLabel);
        formulario.appendChild(nInput);
    });
});
