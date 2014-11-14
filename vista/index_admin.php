<?php
session_start();
// El session_start(); ya estaría iniciado en tu script "padre" .. Si se llama directo .. ni se accederá a $_SESSION por ende no existirá y se redireccionará hacia tu página que indiques (puedes usar rutas [url]http://www.tal.tal[/url] por si llamasen al script desde otros sitios ... 
if (!isset($_SESSION['autorizado']) && !isset($_SESSION['alias']) && 
	!isset($_SESSION['rol'])){ 
	header ("Location: http://ideasuv.heliohost.org"); 
	exit; 
}
if ($_SESSION['rol'] != 'Administrador') {
	header ("Location: http://ideasuv.heliohost.org"); 
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href='vista\web\img\LogoIdeasUV.jpg' rel='shortcut icon' type='image/png'>

    <title>Ideas UV - Universidad del Valle</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="web/css/bootstrap.css">
	<link rel="stylesheet" href="web/css/bootstrap-table.css">
	<!--botones redes sociales-->
	 <link rel="stylesheet" href="web/css/bootstrap-social.css">
	
    <!-- Custom Google Web Font -->
    <link href="web/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	
    <!-- Add custom CSS here -->
    <link href="web/css/custom.css" rel="stylesheet">
	
	<!-- JavaScript -->
    <script src="web/js/jquery-1.10.2.js"></script>
    <script src="web/js/bootstrap.js"></script>
	<script src="web/js/bootstrap-table.js"></script>
	<script src="web/js/bootstrap-table-es-AR.js"></script>
    <script src="web/js/custom.js"></script>
	<script src="web/js/custom-admin.js"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<!-- barra de navegacion -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Ideas UV</a>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#" class="scroll-link" data-id="usuarios">Usuarios</a></li>
		  <li><a href="#" class="scroll-link" data-id="roles">Roles</a></li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">¡Bienvenido<strong><?php echo ' '.$_SESSION['alias'].'!'; ?></strong> <b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li><a href="#" id="micuenta">Mi cuenta</a></li>
			  <li class="divider"></li>
			  <li><a href="logout.php">Cerrar sesion</a></li>
			</ul>
		  </li>
		</ul>
	  </div><!-- /.navbar-collapse -->
	  
	</nav>
	
	<!--Modal datos usuario y rol-->
	<!-- Modal crear/editar usuario -->
	<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		<div class="modal-dialog" style="margin-top: 100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel2">Crear/Editar usuario</h4>
				</div>
				<form id="formusuario" method="post">
					<div class="modal-body" id="usuario_details">
						<span >*Nombre Completo</span><br />
						<input type="text" placeholder="Escriba su nombre completo" maxlength="30" name="usuario_nombre" required="true" /> </br></br>
						<span >*Correo institucional</span><br />
						<input type="email" placeholder="example@coreounivalle.edu.co" name="usuario_correo" required="true" /></br></br>
						<span >*Alias</span><br />
						<input type="text" placeholder="miusuario" name="usuario_nick" required/> </br></br>
						<span >*Rol</span><br />
						<select name="usuario_rol" class="form-control">
							<option>Participante</option>
							<option>Coordinador</option>
							<option>Jurado</option>
							<option>Administrador</option>
						</select> </br></br>
						<span >*Contraseña</span><br />
						<input type="password" placeholder="Escriba su contraseña" name="usuario_contrasenia" required="true" /></br></br>
						<span >*Repetir contraseña</span><br />
						<input type="password" placeholder="Repita su contraseña" name="usuario_repcontrasenia" required="true" /> </br></br>
						<span >Correo de facebook (opcional)</span><br />
						<input type="email" placeholder="example@example.com" name="usuario_face" /> </br></br>
						<span >Usuario Twitter (opcional)</span><br />
						<input type="text" placeholder="username" maxlength="40" name="usuario_twitter" /> </br></br>
						<span >Tipo documento (opcional)</span><br />
						<input type="text" placeholder="T.I. o C.C. o C.E." maxlength="40" name="usuario_tipodoc" /> </br></br>
						<span >Numero documento (opcional)</span><br />
						<input type="text" placeholder="Escriba un numero sin puntos" maxlength="40" name="usuario_dcto" /> </br></br>
						<span >Numero de celular (opcional)</span><br />
						<input type="text" placeholder="Escriba un numero sin puntos" maxlength="40" name="usuario_cel" /> </br></br>
						<span>* Campos obligatorios</span>
						<span id="error_usuario"></span>
					</div>
					<div class="modal-footer" >
						<input style="float: left" type="submit" class="btn btn-success" value="Guardar" id="usuario"/>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- ./Modal crear usuario -->
	
	<!-- Modal  crear/editar rol -->
	<div class="modal fade" id="modalrol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		<div class="modal-dialog" style="margin-top: 100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel2">Crear/Editar rol</h4>
				</div>
				<form id="formusuario" method="post">
					<div class="modal-body" id="usuario_details">
						<span >*Nombre Rol</span><br />
						<input type="text" placeholder="Escriba el Rol" maxlength="30" name="rol_nombre" required="true" /> </br></br>
						<span>* Campos obligatorios</span>
						<span id="error_rol"></span>
					</div>
				</form>
				<div class="modal-footer" >
						<input style="float: left" type="submit" class="btn btn-success" value="Guardar" id="rol"/> 
				</div>
			</div>
		</div>
	</div><!-- ./Modal crear rol -->
	<!-- ./Modal datos usuario y rol -->
	
	<!-- Contenido de la pagina -->
	<!-- usuarios -->
	<div class="content-section-b" id="usuarios">
		<div class="container">
			<div class="page-header">
				<h1>Usuarios  <small>crear, editar, eliminar</small></h1>
			</div>
			<input style="float: left" type="submit" class="btn btn-primary usuariopopup" value="Crear usuario" id="crearusuario"/>
			<table id="events-id2" data-toggle="table" data-url="data2.json" data-height="400" data-pagination="true" data-search="true">
				<thead>
					<tr>
						<th data-field="id" data-sortable="true">Alias</th>
						<th data-field="name" data-sortable="true">Correo Univalle</th>
						<th data-field="price" data-sortable="true">Correo Facebook</th>
						<th data-field="operate" data-formatter="operateFormatter1" data-events="operateEvents1">Opciones</th>
					</tr>
				</thead>
			</table>
		<!--script de carga glyphicon y eventos de click-->
			<script>
				function operateFormatter1(value, row, index) {
					return [
						'<a class="editu ml10" href="javascript:void(0)" title="Edit">',
							'<i class="glyphicon glyphicon-edit"></i>',
						'</a>',
						'<a class="removeu ml10" href="javascript:void(0)" title="Remove">',
							'<i class="glyphicon glyphicon-remove"></i>',
						'</a>'
					].join('');
				}
					window.operateEvents1 = {
					'click .editu': function (e, value, row, index) {
						//alert('You click edit icon, row: ' + JSON.stringify(row));
						console.log(value, row, index);
						$('#modalusuario').modal('toggle');
					},
					'click .removeu': function (e, value, row, index) {
						//alert('You click remove icon, row: ' + JSON.stringify(row));
						console.log(value, row, index);
					}
				};
			</script>
		</div>
	</div><!-- ./usuarios -->
	
	<!-- roles -->
	<div class="content-section-a" id="roles">
		<div class="container">
			<div class="page-header">
				<h1>Roles  <small>crear, editar, eliminar</small></h1>
			</div>
			<input style="float: left" type="submit" class="btn btn-primary rolpopup" value="Crear Rol" id="crearrol"/> 
			<table id="tablarol" data-toggle="table" data-url="data1.json" data-height="300">
				<thead>
					<tr>
						<th data-field="id" data-sortable="true">Alias</th>
						<th data-field="name" data-sortable="true">Correo Univalle</th>
						<th data-field="price" data-sortable="true">Correo Facebook</th>
						<th data-field="operate" data-formatter="operateFormatter2" data-events="operateEvents2">Opciones</th>
					</tr>
				</thead>
			</table>
			<script>
				function operateFormatter2(value, row, index) {
					return [
						'<a class="editr ml10" href="javascript:void(0)" title="Edit">',
							'<i class="glyphicon glyphicon-edit"></i>',
						'</a>',
						'<a class="remover ml10" href="javascript:void(0)" title="Remove">',
							'<i class="glyphicon glyphicon-remove"></i>',
						'</a>'
					].join('');
				}
				window.operateEvents2 = {
					'click .editr': function (e, value, row, index) {
						//alert('You click edit icon, row: ' + JSON.stringify(row));
						console.log(value, row, index);
						$('#modalrol').modal('toggle');
					},
					'click .remover': function (e, value, row, index) {
						//alert('You click remove icon, row: ' + JSON.stringify(row));
						console.log(value, row, index);
					}
				};
			</script>
		</div>
    </div><!-- ./roles -->
	<footer>
       <div class="container">
           <div class="row">
               <div class="col-lg-12">
                   <p class="copyright text-muted small">Copyright &copy; Ideas UV 2014. Todos los derechos reservados</p>
               </div>
           </div>
       </div>
   </footer>
</body>
</html>