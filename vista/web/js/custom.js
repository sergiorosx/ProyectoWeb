$(document).ready(function(){
	
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
	$("input#ingresar").click(function() {

		// validacion de campos
		var validado = true;
		
		$( "#formlogin input[required=true]").each(function(){
            
            if(!$.trim($(this).val())) { //if this field is empty
            	// mostrar mensajes de error adicionales
                validado = false; //set do not proceed flag
            }
            
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
            	// mostrar mensajes de error adicionales
                validado = false; //set do not proceed flag
            }
        });


		if(validado) //everything looks good! proceed...
        {	
            //get input field values data to be sent to server
            post_data = {
                'correo'     : $('input[name=login_correo]').val(),
                'contrasenia'    : $('input[name=login_contrasenia]').val()
            };
           
            //Ajax post data to server controlador_login.php
            $.post('controlador_login.php', post_data, function(response){  
                if(response.type == 'error'){ //load json data from server and output message    
                    output = '<div class="error">' + response.text + '</div>';
                } else{
                    output = '<div class="success">' + response.text + '</div>';
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val('');
                    $("#contact_form #contact_body").slideUp(); //hide form after success
                }
                $("#contact_form #contact_results").hide().html(output).slideDown();
            }, 'json');
        }
    });



	// Ajax para registro de usuario
	$("input#registro").click(function() {

		// validacion de campos
		var validado = true;
		
		$( "#formregistro input[required=true]").each(function(){
            
            if(!$.trim($(this).val())) { //if this field is empty
            	// mostrar mensajes de error adicionales
                validado = false; //set do not proceed flag
            }
            
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
            	// mostrar mensajes de error adicionales
                validado = false; //set do not proceed flag
            }
		});


		if(validado) //everything looks good! proceed...
        {	
        	alert('datos de registro validados');
            //get input field values data to be sent to server
            post_data = {
                'nombre'     : $('input[name=registro_nombre]').val(),
                'correoUV'    : $('input[name=registro_correo]').val(),
                'alias' : $('input[name=registro_nick]').val(),
                'contrasenia' : $('input[name=registro_contrasenia]').val(),
                'valcontrasenia' : $('input[name=registro_valcontrasenia]').val(),
                'correoFB' : $('input[name=registro_face]').val(),
                'usuarioTw' : $('input[name=registro_registrotwitter]').val()
            };
/*
            //Ajax post data to server controlador_login.php
            $.post('controlador_login.php', post_data, function(response){  
                if(response.type == 'error'){ //load json data from server and output message    
                    output = '<div class="error">' + response.text + '</div>';
                } else{
                    output = '<div class="success">' + response.text + '</div>';
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val('');
                    $("#contact_form #contact_body").slideUp(); //hide form after success
                }
                $("#contact_form #contact_results").hide().html(output).slideDown();
            }, 'json');*/
        }
    });

});