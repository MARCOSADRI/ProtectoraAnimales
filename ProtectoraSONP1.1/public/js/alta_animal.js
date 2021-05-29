let contImg = document.getElementById("contenedor_imagen");
let file = document.getElementById("animal_foto");
document.getElementsByTagName("div")[30].style = "display:none";

/*Evento: Al clickar la foto, se abre el seleccionador de archivos*/
contImg.addEventListener("click", () => {
    file.click();
});

/*Previsualización de imágen, EVENTO ONCHANGE*/
file.onchange = function(){
    let file = this.files[0];
    let reader = new FileReader();
    reader.onloadend = function(){
        contImg.style = "background-image: url("+reader.result+")"
    }
    if(file){
        reader.readAsDataURL(file);
    }else{ //Imagen por defecto.
        contImg.style = "background-image: url('../img/insertar_imagen.png')";
    }
}