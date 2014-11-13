$(document).ready(function() {
	
	$(".convocatoriapopup").bind("click", function() {
		$('#modalconvocatoria').modal('toggle');
	});
	
	$(".rolpopup").bind("click", function() {
		$('#modalrol').modal('toggle');
	});
	
	$("#formconv").submit(function() {
        console.log('accion submit');
		// validacion de campos
		var validado = true;
		
		// se deshabilita el submit mientras se envia la info
		$('#convocatoria').attr('disabled','disabled');
		
		//everything looks good! proceed...
		if(validado) {	
        	
            //get input field values data to be sent to server
            post_data = {
                'nombre'     	: $('input[name=nombre_convocatoria]').val(),
                'descripcion'  	: $('textarea[name=descripcion_convocatoria]').val(),
                'inicio' 		: $('input[name=inicio_convocatoria]').val(),
                'fin' 			: $('input[name=fin_convocatoria]').val()
            };
            console.log('post data ok');
            //Ajax post data to server controlador_login.php
            $.post('../controlador/controladorcoordinador.php', post_data, function(response) {
				console.log('ajax ok');
                if(response.type == 'error'){ //load json data from server and output message    
                    //console.log('error ' + response.type + " " + response.text);
					$('#error_conv').html('* ' + response.text);
					// activar submit
					$('#convocatoria').removeAttr('disabled');
                } else {
                	//console.log('No hay error ' + response.type + " " + response.text);
					alert('¡Se ha creado la convocatoria!');
					$('#modalconvocatoria').modal('hide');
					$('#formconv')[0].reset();
					$('#convocatoria').removeAttr('disabled');
                }
            }, 'json').fail(function() {
                // just in case posting your form failed
                console.log( "Posting failed." );
            });
            // to prevent refreshing the whole page page
            return false;
        }
    });
	
});