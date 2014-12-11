<?php
session_start();
// El session_start(); ya estaría iniciado en tu script "padre" .. Si se llama directo .. ni se accederá a $_SESSION por ende no existirá y se redireccionará hacia tu página que indiques (puedes usar rutas [url]http://www.tal.tal[/url] por si llamasen al script desde otros sitios ... 
if (!isset($_SESSION['autorizado'])){ 
    header ("Location: http://ideasuv.heliohost.org"); 
    exit; 
}
if ($_SESSION['rol'] != 'Coordinador') {
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
        <link href="web/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="web/css/bootstrap-table.css">
        <!--botones redes sociales-->
        <link href="web/css/bootstrap-social.css" rel="stylesheet" >

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
		<script src="web/js/custom-coordinador.js"></script>

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
                <a class="navbar-brand" href="http://ideasuv.heliohost.org/">Ideas UV</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="scroll-link" data-id="convocatorias">Convocatorias</a></li>
					<li><a href="#" class="scroll-link" data-id="propuestas">Propuestas</a></li>
					<li><a href="#" class="scroll-link" data-id="reportes">Reportes</a></li>
                    <li><a href="#" class="scroll-link" data-id="faqs">FAQ's</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">¡Bienvenido<strong><?php echo ' '.$_SESSION['alias'].'!'; ?></strong> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="micuenta">Mi cuenta</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
		
		<!-- Modal crear/editar usuario, crear/editar convocatoria, crear/editar FAQ's -->
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
							<select class="form-control">
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
							<input type="text" placeholder="Escriba un numero sin puntos" maxlength="40" name="usuario_tipodoc" /> </br></br>
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
		
		<!-- Modal crear/editar convocatoria -->
		<div class="modal fade" id="modalconvocatoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 150px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel1">Crear/Editar Convocatoria</h4>
                    </div>
                    <form id="formconv" onsubmit="return false;" method="post">
                        <div class="modal-body" id="conv_details">
                            <span style="font-weight:bold;">Nombre de la nueva convocatoria</span><br />
                            <input type="text" placeholder="Nuevo nombre" name="nombre_convocatoria" required="true" /><br /><br />
                            <span style="font-weight:bold;" >Descripción de la convocatoria</span><br />
                            <textarea style="resize:none" placeholder="Descripción" name="descripcion_convocatoria" maxlength="800" required="true" rows="6" cols="40" draggable="false"></textarea><br />
                            <span style="font-weight:bold;">Fecha de Inicio</span><br />
                            <input type="date" placeholder="Año/Mes/Día" name="inicio_convocatoria" required="true" /><br /><br />
                            <span style="font-weight:bold;">Fecha de Finalización</span><br />
                            <input type="date" placeholder="Año/Mes/Día" name="fin_convocatoria" required="true" /><br /><br />
							<span>* Campos obligatorios</span>
							<span id="error_conv"></span>
                        </div>
                        <div class="modal-footer">
                            <input style="float: left" type="submit" class="btn btn-success" value="Guardar convocatoria" id="convocatoria"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal crear/editar convocatoria-->
		
		<!-- Modal crear/editar FAQ's -->
		<div class="modal fade" id="modalfaqs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 150px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel1">Crear/Editar FAQ</h4>
                    </div>
                    <form id="formfaqs" onsubmit="return false;" method="post">
                        <div class="modal-body" id="conv_details">
                            <span style="font-weight:bold;">Pregunta</span><br />
                            <input type="text" placeholder="Nuevo nombre" name="pregunta_faq" required="true" /><br /><br />
                            <span style="font-weight:bold;" >Respuesta</span><br />
                            <textarea style="resize:none" placeholder="Descripción" name="respuesta_faq" maxlength="800" required="true" rows="6" cols="40" draggable="false"></textarea><br />
                            <span style="font-weight:bold;">Fecha de Inicio</span><br />
                        </div>
                        <div class="modal-footer">
                            <input style="float: left" type="submit" class="btn btn-success" value="Guardar FAQ" id="faq"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal crear/editar convocatoria-->
		
		<!-- Contenido de la pagina -->
		<!-- convocatorias -->
        <div class="content-section-b" id="convocatorias">
			<div class="container">
				<div class="page-header">
					<h1>Convocatorias  <small>crear, editar, publicar</small></h1>
				</div>
				<input style="float: left" type="submit" class="btn btn-primary convocatoriapopup" value="Crear Convocatoria" id="crearconvocatoria"/>
				<table id="tablaconvocatoria" data-toggle="table" data-url="web/data/data_conv.php" data-height="400" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true">
					<thead>
						<tr>
							<th data-field="nombre" data-sortable="true">Nombre</th>
							<th data-field="descripcion" data-sortable="true">Descripción</th>
							<th data-field="fecha_inicio" data-sortable="true">Creada</th>
							<th data-field="fecha_fin" data-sortable="true">Cierre</th>
							<th data-field="publicada" data-sortable="true">Publicada</th>
							<th data-field="operate" data-formatter="operateFormatter1" data-events="operateEvents1">Opciones</th>
						</tr>
					</thead>
				</table>
				<!--script de carga glyphicon y eventos de click-->
				<script>
					function operateFormatter1(value, row, index) {
						return [
							'<a class="editc ml10" href="javascript:void(0)" title="Editar">',
								'<i class="glyphicon glyphicon-edit"></i>',
							'</a>',
							'<a class="uploadc ml10" href="javascript:void(0)" title="Publicar">',
								'<i class="glyphicon glyphicon-upload"></i>',
							'</a>'
						].join('');
					}
					window.operateEvents1 = {
						'click .editc': function (e, value, row, index) {
							//alert('You click edit icon, row: ' + JSON.stringify(row));
							console.log(value, row, index);
							$('#modalconvocatoria').modal('toggle');
						},
						'click .uploadc': function (e, value, row, index) {
							console.log(value, row, index);
							
							post_data = {'nombreconv': row.nombre};
							
							$.post('../controlador/controladorcoordinador.php', post_data, function(response) {
								console.log('ajax ok');
								if(response.type == 'error'){ //load json data from server and output message    
									console.log('error ' + response.type + " " + response.text);
									alert('Error: ' + response.text);
								} else {
									console.log('No hay error ' + response.type + " " + response.text);
									$('#tablaconvocatoria').bootstrapTable('updateRow', {	index: index,
																							row: {
																								nombre: row.nombre,
																								descripcion: row.descripcion,
																								fecha_inicio: row.fecha_inicio,
																								fecha_fin: row.fecha_fin,
																								publicada: 't'
																							}
																						});
								}
							}, 'json').fail(function() {
								// just in case posting your form failed
								console.log( "Posting failed." );
							});
						}
					};
				</script>
			</div>
		</div><!-- ./convocatorias -->
		
		<!-- Propuestas -->
        <div class="content-section-a" id="propuestas">
			<div class="container">
				<div class="page-header">
					<h1>Propuestas  <small>administrar comentarios</small></h1>
				</div>
				<table id="tablapublicaciones" data-toggle="table" data-url="coordinador/data2.json" data-height="400" data-search="true" data-pagination="true">
					<thead>
						<tr>
							<th data-field="id" data-sortable="true">Nombre</th>
							<th data-field="name" data-sortable="true">Descripción</th>
							<th data-field="price" data-sortable="true"># propuestas</th>
							<th data-field="operate" data-formatter="operateFormatter2" data-events="operateEvents2">Opciones</th>
						</tr>
					</thead>
				</table>
				<!--script de carga glyphicon y eventos de click-->
				<script>
					function operateFormatter2(value, row, index) {
						return [
							'<a class="editcomp ml10" href="javascript:void(0)" title="Administrar comentarios">',
								'<i class="glyphicon glyphicon-list-alt"></i>',
							'</a>'
						].join('');
					}
						window.operateEvents2 = {
						'click .editcomp': function (e, value, row, index) {
							//alert('You click edit icon, row: ' + JSON.stringify(row));
							console.log(value, row, index);
						}
					};
				</script>
			</div>
		</div><!-- ./convocatorias -->
		
		<!-- reportes -->
        <div class="content-section-b" id="reportes">
			<div class="container">
				<div class="page-header">
					<h1>Reportes  <small></small></h1>
				</div>
			</div>
		</div><!-- ./reportes -->
		
		<!-- FAQ'S -->
        <div class="content-section-a" id="faqs">
			<div class="container">
				<div class="page-header">
					<h1>FAQ'S  <small>preguntas frecuentes</small></h1>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</a>
										<a style="float: right" class="editfaq" href="javascript:void(0)" title="editar FAQ">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse">
									<div class="panel-body">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
									</div>
								</div>
							</div><!-- /.panel -->
						</div>
					</div>
				</div>
				<br/>
				<input style="float: left" type="button" class="btn btn-primary faqspopup" value="Añadir FAQ" id="crearfaq"/>
			</div>
		</div><!-- ./FAQ'S -->
		
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
