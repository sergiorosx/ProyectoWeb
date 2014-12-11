$(document).ready(function() {
	
	$(".usuariopopup").bind("click", function() {
		$('#crearusuario').modal('toggle');
	});
	
	$(".rolpopup").bind("click", function() {
		$('#modalrol').modal('toggle');
	});
	
	// Ajax para registro de usuario ROL ADMINISTRADOR
	$("#formcrearusuario").submit(function() {
        
		//se limpia el error anterior
        $('#error_usuario').html('');
        
		// se deshabilita el submit mientras se envia la info
		$('#formcrearusuario input[type="submit"]').attr('disabled','disabled');
		
		// validacion de campos
		var validado = true;
		
		// validacion de campos requeridos
		$( "#formcrearusuario input[class=requerido]").each(function(){
		
            if(!$.trim($(this).val())) { //if this field is empty
                validado = false;
				$('#error_usuario').html('<br/>* Error: un campo obligatorio esta vacio');
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
                validado = false; //set do not proceed flag
                $('#error_usuario').html('<br/>* Error: correo invalido');
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
		});
		
		// validacion de campos no requeridos
		$( "#formcrearusuario input[class=norequerido]").each(function(){
            if($.trim($(this).val())) { //if this field is not empty
				//check invalid email
				var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
					validado = false; //set do not proceed flag
					$('#error_usuario').html('<br/>* Error: correo invalido');
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
				}
			}
		});

        //everything looks good! proceed...
		if(validado) {
            //get input field values data to be sent to server
            post_data = {
                'nombre'     	: $('#formcrearusuario input[name=usuario_nombre]').val(),
                'correoUV'    	: $('#formcrearusuario input[name=usuario_correo]').val(),
                'alias' 		: $('#formcrearusuario input[name=usuario_nick]').val(),
				'rol' 			: $('#formcrearusuario select[name=usuario_rol]').val(),
                'contrasena' 	: $('#formcrearusuario input[name=usuario_contrasenia]').val(),
                'valcontrasena'	: $('#formcrearusuario input[name=usuario_repcontrasenia]').val(),
                'correoFB' 		: $('#formcrearusuario input[name=usuario_face]').val(),
                'usuarioTw' 	: $('#formcrearusuario input[name=usuario_twitter]').val(),
				'tipodoc' 		: $('#formcrearusuario select[name=usuario_tipodoc]').val(),
				'documento' 	: $('#formcrearusuario input[name=usuario_dcto]').val(),
				'celular' 		: $('#formcrearusuario input[name=usuario_cel]').val(),
				'accion'		: $('#formcrearusuario #usuario').val()
            };
			console.log(JSON.stringify(post_data));
            
            //Ajax post data to server controlador_login.php
            $.post('../controlador/controladoradmin.php', post_data, function(response) { 
				console.log('ajax');
                if(response.type == 'error'){ //load json data from server and output message    
                    console.log('error');
					$('#error_crearusuario').html('* ' + response.text);
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
                } else {
                    $("#signup").modal('hide'); //hide form after success
					alert('usuario ' + response.alias + ' ha sido creado');
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
					console.log('creado');
                }
            }, 'json').fail(function() {
                // just in case posting your form failed
                console.log( "Posting failed." );
            });
            // to prevent refreshing the whole page page/**/
            return false;
        }
		return false;
    });//Fin Registro usuario por ROL
});