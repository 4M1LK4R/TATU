 //Funcion Alert_4MK (Titulo, Mensaje, Nombre de Div, Tipo [warning,danger,success,info])
function Alert_4MK(titulo, msg, nom_div, tipo) {
    var codigo = '<div class="alert alert-'+tipo+' alert-dismissible" role="alert">';
    codigo += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    codigo += '<strong>'+titulo+'&nbsp;</strong>'+msg;
    codigo += '</div>';
    $("#" + nom_div).html(codigo);
}

