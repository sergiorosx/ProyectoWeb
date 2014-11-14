$(document).ready(function() {
	
	$(".loginpopup").bind("click", function() {
		$('#login').modal('toggle');
	});
	
	$('#signup-link').bind("click", function() {
	    $('#login').modal('hide');
	     $('#signup').modal('toggle');
	});

	$('#login-link').bind("click", function() {
	    $('#signup').modal('hide');
	     $('#login').modal('toggle');
	});
	
	$(".micuenta").bind("click", function() {
		//traer informacion con ajax y formatearla en el modal
		$('#modalusuario').modal('toggle');
	});
	 
	 /*
	 // Boostrap Slider
	 $('.carousel').carousel();*/
	 
	// navigation click actions	
	$('.scroll-link').on('click', function(event){
		event.preventDefault();
		var sectionID = $(this).attr("data-id");
		scrollToID('#' + sectionID, 750);
		$('.navbar-nav li').each(function(){
			$(this).removeClass("active");
		});
		$(this).parent().addClass("active");
	});
	
	// scroll to top action
	$('.scroll-top').on('click', function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow'); 		
	});

	// mobile nav toggle
	$('#nav-toggle').on('click', function (event) {
		event.preventDefault();
		$('#main-nav').toggleClass("open");
	});
		
	// scroll function
	function scrollToID(id, speed){
		var offSet = 50;
		var targetOffset = $(id).offset().top - offSet;
		var mainNav = $('#main-nav');
		$('html,body').animate({scrollTop:targetOffset}, speed);
		if (mainNav.hasClass("open")) {
			mainNav.css("height", "1px").removeClass("in").addClass("collapse");
			mainNav.removeClass("open");
		}
	}

	if (typeof console === "undefined") {
	    console = {
	        log: function() { }
	    };
	}

	// Ajax para login de usuario
	$("#formlogin").submit(function() {
        // se limpia el error anterior
        $('#error_login').html('');
		
		// se deshabilita el submit mientras se envia la info
		$('input[type="submit"]').attr('disabled','disabled');

		// validacion de campos
		var validado = true;
		
		$("#formlogin input[required=true]").each(function(){
            if(!$.trim($(this).val())) { //if this field is empty
                validado = false; //set do not proceed flag
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
            	// mostrar mensajes de error adicionales
                validado = false; //set do not proceed flag
                $('#error_login').html('<br/>* Error: correo invalido');
				// activar submit
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
        console.log('valida');
        //everything looks good! proceed...
		if(validado) {	
            
            //get input field values data to be sent to server
            var post_data = {
                'correo'        : $('input[name=login_correo]').val(),
                'contrasena'    : $('input[name=login_contrasenia]').val()
            };
            console.log('validado');
            //Ajax post data to server controladorlogin.php
            $.post('./controlador/controladorlogin.php', post_data, function(response) {  
                console.log('entra a ajax');
                if(response.type == 'error'){ //load json data from server and output message    
                    console.log('errror ' +  response.type + "->" + response.text);
                    $('#error_login').html('* Error: ' + response.text);
					// activar submit
					$('input[type="submit"]').removeAttr('disabled');
                } else {
                    console.log('Bienvenido ' + response.role);
                    $('#login').modal('hide'); //hide form after success
					if (response.role == 'Participante') {
						console.log('redireccion participante');
						window.location.href = './vista/index_participante.php';
					}
					else if (response.role == 'Coordinador'){
						console.log('redireccion coordinador');
						window.location.href = './vista/index_coordinador.php';
					}
					else if (response.role == 'Jurado'){
						console.log('redireccion jurado');
						window.location.href = './vista/index_jurado.php';
					}
					else if (response.role == 'Administrador'){
						console.log('redireccion administrador');
						window.location.href = './vista/index_admin.php';
						console.log('hizo llamado ok');
					}
                }
            }, 'json').fail(function() {
                // just in case posting your form failed
                console.log( "Posting failed." );
            });
            // to prevent refreshing the whole page page
            return false;
        }
		
		return false;
    });



	// Ajax para registro de usuario
	$("#formregistro").submit(function() {
        //se limpia el error anterior
        $('#error_registro').html('');
        
		// se deshabilita el submit mientras se envia la info
		$('input[type="submit"]').attr('disabled','disabled');
		
		// validacion de campos
		var validado = true;
		
		$( "#formregistro input[required=true]").each(function(){
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
                'nombre'     	: $('input[name=registro_nombre]').val(),
                'correoUV'    	: $('input[name=registro_correo]').val(),
                'alias' 		: $('input[name=registro_nick]').val(),
                'contrasena' 	: $('input[name=registro_contrasenia]').val(),
                'valcontrasena'	: $('input[name=re_reg_contrasenia]').val(),
                'correoFB' 		: $('input[name=registro_face]').val(),
                'usuarioTw' 	: $('input[name=registro_twitter]').val()
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
    });
});