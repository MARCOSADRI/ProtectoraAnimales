/*Inicio del bloque principal de JQuery*/
$(function(){
    /*Abrir FORM enferemedades*/
    $("#btn_abrir_dialog_enfermedad").click(function(ev){
        ev.preventDefault();
        $("#dialog_enf").dialog("open");
    });

    /*Abrir FORM revisiones*/
    $("#btn_abrir_dialog_revision").click(function(ev){
        ev.preventDefault();
        $("#dialog_rev").dialog("open");
    });

    /*Abrir FORM vacuna*/
    $("#btn_abrir_dialog_vacuna").click(function(ev){
        ev.preventDefault();
        $("#dialog_vac").dialog("open");
    });


    /*DIÁLOGOS*/
    /* Diálogo de enfermedades */
    $("#dialog_enf").dialog({
        autoOpen: false,
        modal: true
    });

    /*Diáogo de revisiones*/
    $("#dialog_rev").dialog({
        autoOpen: false,
        modal: true
    });

    /*Diáogo de revisiones*/
    $("#dialog_vac").dialog({
        autoOpen: false,
        modal: true
    });
});