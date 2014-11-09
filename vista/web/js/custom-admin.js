$(document).ready(function() {
	
	$(".usuariopopup").bind("click", function() {
		$('#modalusuario').modal('toggle');
	});
	
	$(".rolpopup").bind("click", function() {
		$('#modalrol').modal('toggle');
	});
	
	$("#micuenta").bind("click", function() {
		//traer informacion con ajax y formatearla en el modal
		$('#modalusuario').modal('toggle');
	});
	
});