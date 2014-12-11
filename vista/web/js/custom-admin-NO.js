$(document).ready(function() {
	
	$(".usuariopopup").bind("click", function() {
		$('#modalusuario').modal('toggle');
	});
	
	$(".rolpopup").bind("click", function() {
		$('#modalrol').modal('toggle');
	});
	
	// Ajax para registro de usuario ROL ADMINISTRADOR
	$("#formusuario").submit(function() {
        //se limpia el error anterior
        $('#error_registro').html('');
        
		// se deshabilita el submit mientras se envia la info
		$('input[type="submit"]').attr('disabled','disabled');
		
		// validacion de campos
		var validado = true;
		
		$( "#formusuario input[required=true]").each(function(){
            if(!$.trim($(this).val())) { //if this field is empty
                validado = false; //set do not proceed flag
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
                validado = false; //set do not proceed flag
                $('#error_registro').html('<br/>* Error: correo invalido');
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
		});

        //everything looks good! proceed...
		if(validado) {	
        	
            //get input field values data to be sent to server
            post_data = {
                'nombre'     	: $('input[name=usuario_nombre]').val(),
                'correoUV'    	: $('input[name=usuario_correo]').val(),
                'alias' 		: $('input[name=usuario_nick]').val(),
				'rol' 			: $('input[name=usuario_rol]').val(),
                'contrasena' 	: $('input[name=usuario_contrasenia]').val(),
                'valcontrasena'	: $('input[name=usuario_repcontrasenia]').val(),
                'correoFB' 		: $('input[name=usuario_face]').val(),
                'usuarioTw' 	: $('input[name=usuario_twitter]').val(),
				'tipodoc' 		: $('input[name=usuario_tipodoc]').val(),
				'numdoc' 		: $('input[name=usuario_dcto]').val(),
				'numcel' 		: $('input[name=usuario_cel]').val()
            };
            
            //Ajax post data to server controlador_login.php
            $.post('./controlador/controladorlogin.php', post_data, function(response) {  
                if(response.type == 'error'){ //load json data from server and output message    
                    console.log('error ' + response.type + " " + response.text);
                    $('#error_registro').html('* ' + response.text);
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
                } else {
                	console.log('No hay error ' + response.type + " " + response.text);
                    $("#signup").modal('hide'); //hide form after success
					alert('usuario ' + response.alias + ' creado exitosamente!! Ya puede Iniciar sesion');
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
                }
            }, 'json').fail(function() {
                // just in case posting your form failed
                console.log( "Posting failed." );
            });
            // to prevent refreshing the whole page page
            return false;
        }
    });//Fin Registro usuario por ROL
});