/*Inicio del bloque principal de JQuery*/
$(function(){
    $("#btn_abrir_dialog_enfermedad").click(function(ev){
        ev.preventDefault();
        $("#dialog_enf").dialog("open");
    });

    /* Dialogo Enfermedades */
    $("#dialog_enf").dialog({
        autoOpen: false,
        modal: true
    });
});