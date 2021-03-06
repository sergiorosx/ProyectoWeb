// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
	//console.log('statusChangeCallback');
	//console.log(response);
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
  		// Logged into your app and Facebook. 
  		testAPI();
	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
	  	//document.getElementById('status').innerHTML = 'Loguearse ' + 'en esta aplicación.';
	  	console.log('Loguearse en la app');
	} else {
	  	// The person is not logged into Facebook, so we're not sure if
	  	// they are logged into this app or not.
	  	//document.getElementById('status').innerHTML = 'Ingresar a' + 'Facebook.'; seteo del 
	  	console.log('logearse en facebook');
	}
}


// se activa con el evento onClick, tiene los mismo de la funcion
// checkLoginState + el email del usuario
function facebookLogin() {
	FB.login(function(response){
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		}); // se pide el email del usuario que se loguea
	}, {scope: 'email'});
}


// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
/*function checkLoginState() {
	FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
}*/


window.fbAsyncInit = function() {
	FB.init({
		appId      : '830915323614853',
		cookie     : true,  // enable cookies to allow the server to access 
						    // the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.2' // use version 2.2
	});

	// Now that we've initialized the JavaScript SDK, we call 
	// FB.getLoginStatus().  This function gets the state of the
	// person visiting this page and can return one of three states to
	// the callback you provide.  They can be:
	//
	// 1. Logged into your app ('connected')
	// 2. Logged into Facebook, but not your app ('not_authorized')
	// 3. Not logged into Facebook and can't tell if they are logged into
	//    your app or not.
	//
	// These three cases are handled in the callback function.
	/*FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});*/
};


// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) 
		return;
	js = d.createElement(s); 
	js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
// ESTA APP SE EJECUTA para obtener el nombre de usuario con FB.api
function testAPI() {
	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me', function(response) {
	  	console.log('Successful login for: ' + response.name + '  ' + response.email);
		comprobar(response.email);
	});
}

function comprobar(email){
	// se deshabilita el submit mientras se envia la info
	$('input[type="submit"]').attr('disabled','disabled');
	var post_data = {'correoFacebook':email};
	console.log('correoFacebook ' + email);
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
			}
		}
	}, 'json').fail(function() {
		// just in case posting your form failed
		console.log( "Posting failed." );
	});
}