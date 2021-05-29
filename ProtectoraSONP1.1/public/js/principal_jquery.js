$(function () {
    $('#filtro1').hide();
    $('#filtro').click(function (e) {
        e.preventDefault();
        $('#dialog').dialog('open');
    });
    $('#dialog').dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            'Filtrar': function () {
        //Recorre la tabla leyendo las características de los animales a comparar     
                $('tbody tr').each(function(p){
            //Recorre el Formulario con las Características que se han indicado y Compara con la fila
                    $('form li select').each(function(i){
                        if ($(this).val() != '*'){ 
                            if($('tbody tr').eq(p).children().eq(i+2).text() != $(this).val()){
                                $('tbody tr').eq(p).hide();
                            }
                        }
                    });
                });
                $('form')[0].reset;
                $(this).dialog('close');
                /*Desactiva el Buscador y activa un Botón
                para realizar nuevas busquedas con otros criterios*/
                $('#filtro').hide();
                $('#filtro1').show();
            },
            'Cancel': function () {
                $(this).dialog('close');
            }
        }               
    });
    /*Recarga la página con el resultado obtenido para realizar
    otra busqueda por nuevos criterios*/
    $('#filtro1').click(function () {
        if (confirm('Seguro desea realiar Nueva Busqueda??.. Perderá los datos actuales.')) {
            location.reload();
        }
    })
});

