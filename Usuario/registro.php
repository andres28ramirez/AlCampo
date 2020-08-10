<?php 
	//include("../bin/connect.php");
	//include("proceso_usuario.php");
	session_start();

	if(isset($_SESSION["usuario"])){
		header("location:/AlCampo");
	}
	else
		$u_id = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>AlCampo - SuperMarket</title>
	<meta charset="utf-8">
	<meta name="description" content="AlCampo el mejor supermercado de la isla de margarita por LEJOS">
	<meta name="keywords" content="AlCampo a la vanguardia de los productos y alimentos que tu y tu familia necesita">
	<meta name="author" content="Desarrollado por Andres Ramirez">
	<link rel="SHORTCUT ICON" href="/AlCampo/Imagenes/alcampo A.png">
	<!-- CSS de Bootstrap -->
	<link rel="stylesheet" type="text/css" href="/AlCampo/css/bootstrap.css">
	<!-- CSS de Iconos -->
	<link href="/AlCampo/css/fontawesome-free/css/all.min.css" rel="stylesheet">
  	<link href="/AlCampo/css/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<!-- Jquery -->
	<script type="text/javascript" src="/AlCampo/js/jquery-3.3.1.min.js"></script>
	<!-- JS de Bootstrap y Popper-->
	<script type="text/javascript" src="/AlCampo/js/popper.js"></script>
	<script type="text/javascript" src="/AlCampo/js/bootstrap.js"></script>
	<!-- Jquery Validacion de datos -->
	<script type="text/javascript" src="/AlCampo/js/jquery.validate.min.js"></script>
	<!-- Jquery Mensajes de Alerta -->
 	<script type="text/javascript" src="/AlCampo/js/sweetalert.js"></script>
 	<!-- JS de los Charts -->
 	<script type="text/javascript" src="/AlCampo/js/chart.js"></script>
 	<!-- CSS para la particion del side nav bar y el contenido interno -->
 	<link type="text/css" href="/AlCampo/css/style.css" rel="stylesheet">
 	<!-- CSS para la particion del side nav bar y el contenido interno -->
 	<link rel="stylesheet" type="text/css" href="/AlCampo/css/solicitudes.css">

 	<!-- CSS interno de la pagina -->
 	<style type="text/css">

 		html, body{
 			margin: 0px;
 			height: 100%;
 			background-color: white;
 			background-image: url('/AlCampo/Imagenes/abasto3.jpg');
 			background-attachment: fixed;
 			background-repeat: no-repeat;
 			background-size: cover; 
 			font-family: "Tahoma";
 		}

 		.eliminar{
	      font-size: 1.5rem;
	      font-weight: 700;
	      color: #000;
	      opacity: .7;
	      cursor: pointer;
	    }

	    .eliminar:hover, .eliminar:focus {
	      text-decoration: none;
	      opacity: 0.8;
	    }

	    button.eliminar{
	      padding: 0;
	      background-color: transparent;
	      border: 0;
	      -webkit-appearance: none;
	    }

		@font-face{
			font-family: courgette;
			src: url(Fuentes/courgette.ttf);
		}

		@font-face{
			font-family: lobster;
			src: url(Fuentes/lobster.ttf);
		}

		@font-face{
			font-family: greatvibes;
			src: url(Fuentes/greatvibes.ttf);
		}

 		/*MENSAJE DE ERROR EN EL FORMULARIO*/
		label.error{	/*MANIPULO EL CSS DEL LABEL QUE SE ESCRIBE CUANDO HAY UN ERROR*/
			color: red;
			margin-left: 2%;
			opacity: 0.8; 
			display: inline;
		}

		input.error, select.error{	/*MODIFICA LOS INPUT QUE HAYAN TENEDIO ALGUN ERROR*/
			border: 1px solid red;
			background: rgba(230,200,180,0.5);
		}

		.boton{
			border-radius: 50px;
		}

		.boton:hover, .boton.hover {
		  outline: 0;
		  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
		}

		::placeholder{
			font-style: italic;
		}
 	</style>

 	<!-- SCRIPT INTERNO DE LA PAGINA -->
 	<script>
	    $(document).ready(function() {
	    	$("#logo-registro").click(function(event) {
				location.href = "/AlCampo";
			});

			$(".retorno").hover(function() {
				$(this).css('text-decoration', 'underline');
				$(this).css('color', '#dc3545');
			}, function() {
				$(this).css('text-decoration', 'none');
				$(this).css('color', '#E61612');
			});

			$("#mostrar_pass").click(function(event) {
				var texto = $("#ojo").attr('title');
				if(texto=="eye"){
					$("#password").attr('type', 'text');
					$("#ojo").removeClass('fa-eye');
					$("#ojo").addClass('fa-eye-slash');
					$("#ojo").attr('title', 'close-eye');
				}
				else{
					$("#password").attr('type', 'password');
					$("#ojo").removeClass('fa-eye-slash');
					$("#ojo").addClass('fa-eye');
					$("#ojo").attr('title', 'eye');
				}
			});

			$("#form-registro").click(function(event) {
				$("#login-form").hide(500);
				$("#registro-form").fadeIn(1500);
				$("#texto-login").fadeOut(10);
				$("#texto-registro").fadeIn(1500);
			});

			$("#form-login").click(function(event) {
				$("#registro-form").hide(500);
				$("#login-form").fadeIn(1500);
				$("#texto-registro").fadeOut(10);
				$("#texto-login").fadeIn(1500);
			});
			
			$("#email").change(function(event) {
				$("#fail-email").fadeOut(500);
			});

			$("#cedula").change(function(event) {
				$("#fail-cedula").fadeOut(500);
			});

			$("#registro-form").removeClass('d-none');
			$("#registro-form").hide();
			
			$("#texto-registro").removeClass('d-none');
			$("#texto-registro").hide();

			$("#fail-contraseña").removeClass('d-none');
			$("#fail-contraseña").hide();

			$("#fail-correo").removeClass('d-none');
			$("#fail-correo").hide();

			$("#fail-email").removeClass('d-none');
			$("#fail-email").hide();

			$("#fail-cedula").removeClass('d-none');
			$("#fail-cedula").hide();
	    });
  	</script>
</head>
<body>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main_c">

		<div class="row border" style="background-color: white">
			<img src="../Imagenes/logo.png" class="m-auto img-fluid" id="logo-registro" width="200" height="150" style="cursor: pointer">
		</div>

	    <div id="contenido" class="row justify-content-center py-5" style="background-color: rgba(255,255,255,0.8);">
	    	
	    	<input type="hidden" name="id-persona" id="id-persona" value="<?php echo $u_id ?>">

			<div class="col-12 mb-1">
				<div class="col-5 mx-auto p-0 mb-4">
					<a href="/AlCampo" style="text-decoration: none">
						<h5 class="font-weight-bold retorno" style="color: #E61612"><i class="icon icon-arrow-left font-weight-bold"></i>Regresar a AlCampo.com</h5>
					</a>
				</div>
				<div class="col-5 m-auto row justify-content-between p-0" id="texto-login">
					<h4 class="text-dark font-weight-bold" id="is-text">Iniciar Sesión</h4>
					<span class="col-6 ml-auto my-auto" id="is2-text"><span id="is2-text2">Nuevo en AlCampo? </span>
						<a style="text-decoration: none;">
							<h6 class="text-danger font-weight-bold d-inline retorno" id="form-registro" style="cursor: pointer">Registrate..</h6>
						</a>
					</span>
				</div>
				<div class="d-none col-5 m-auto row justify-content-between p-0" id="texto-registro">
					<h4 class="text-dark font-weight-bold col-12" id="is-text">Registro de Usuario</h4>
					<span class="col-12 ml-auto my-auto" id="is2-text"><span id="is2-text2">Ya posees una Cuenta? </span>
						<a style="text-decoration: none;">
							<h6 class="text-danger font-weight-bold d-inline retorno" id="form-login" style="cursor: pointer">Inicia Sesión..</h6>
						</a>
					</span>
				</div>
			</div>

			<div class="col-5 py-4" style="background-color: white; box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.6);">
				<div class="m-auto col-12">
					<form id="login" action="registro.php" method="post">
						<div class="form-group text-justify col-12 row justify-content-center m-auto" id="login-form">
						  	<div class="col-10  mb-3">	
							    <label class="text-dark" style=""><b>Correo Electrónico</b></label>
							    <input type="email" class="form-control" id="correo" name="correo" placeholder="e.g.nombre@ejemplo.com">
							    <label id="fail-correo" class="mr-auto d-none" style="color: red">Correo Inexistente..</label>
						    </div>
						    <div class="col-10 mb-3">
							    <label class="text-dark" style=""><b>Contraseña</b></label>
							    <div class="form-control px-0">
							    	<input type="password" class="col-10" size="" id="password" name="password" style="border: 0px">
							    	<span class="col-2 float-right m-auto" id="mostrar_pass" style="cursor: pointer"><i class="fa fa-eye fa-lg" id="ojo" title="eye" style=""></i></span>
							    </div>
							    <label id="fail-contraseña" class="mr-auto d-none" style="color: red">Contraseña Erronea..</label>
						    </div>

							<div class="form-group col-10 mt-2">
								<input type="hidden" name="solicitud" value="login">
								<button type="submit" class="btn btn-danger boton px-5 py-2" name="btnsubmit">Iniciar Sesión</button>
							</div>
						</div>
					</form>

					<form id="registro" action="registro.php" method="post">
						<div class="d-none form-group text-justify col-12 row justify-content-center m-auto" id="registro-form">
							<div class="col-10 mb-2">
								<h5 class="text-dark font-weight-bold">Detalles de la Cuenta</h5>
							</div>
							<div class="col-10  mb-3">	
							    <label class="text-dark" style=""><b>Correo Electrónico:</b></label>
							    <input type="email" class="form-control" id="email" name="email" placeholder="e.g.nombre@ejemplo.com">
							    <label id="fail-email" class="mr-auto d-none" style="color: red">Correo Existente - Introduzca uno Nuevo..</label>
						    </div>
	    					<div class="col-10 mb-3">
								<label class="text-dark" style=""><b>Contraseña: </b></label>
								<input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Ingrese la Contraseña..">
								<input type="password" class="form-control mt-2" id="confirmar" name="confirmar" placeholder="Confirme la Contraseña..">
							</div>

							<div class="col-10 mb-3" style="border-bottom: 1px solid rgba(0,0,0,0.3)"></div>

							<div class="col-10 mb-2">
								<h5 class="text-dark font-weight-bold">Datos Personales</h5>
							</div>
						  	<div class="col-10  mb-3">	
							    <label class="text-dark" style=""><b>Nombre:</b></label>
							    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su Nombre...">
						    </div>
						    <div class="col-10  mb-3">
							    <label class="text-dark" style=""><b>Apellido:</b></label>
							    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su Apellido..."> 
						    </div>
						    <div class="col-10 mb-3">
							    <label class="text-dark" style=""><b>Cédula:</b></label>
							    <div class="input-group">
									<select class="form-control" id="tcedula">
										<option>V-</option>
										<option>E-</option>
									</select>
									<input id="cedula" name="cedula" type="number" class="form-control w-55 caja-1" placeholder="Ingrese su Cedula.." aria-label="Username" aria-describedby="basic-addon1">
		    					</div>
		    					<label id="fail-cedula" class="mr-auto d-none" style="color: red">Cédula Existente - Introduzca una Nueva..</label>
						    </div>
						    <div class="col-10  mb-3">
							    <label class="text-dark" style=""><b>Municipio:</b></label>
							    <select class="form-control font-italic" id="municipio" name="municipio">
							    	<option value="">Seleccione un Municipio:</option>
							    	<option value="Antolín del Campo">Antolín del Campo</option>
							    	<option value="Arismendi">Arismendi</option>
							    	<option value="Díaz">Díaz</option>
							    	<option value="García">García</option>
							    	<option value="Gómez">Gómez</option>
							    	<option value="Maneiro">Maneiro</option>
							    	<option value="Marcano">Marcano</option>
							    	<option value="Mariño">Mariño</option>
							    	<option value="Península de Macanao">Península de Macanao</option>
							    	<option value="Tubores">Tubores</option>
							    	<option value="Villalba">Villalba</option>
								</select>
						    </div>
						    <div class="col-10  mb-3">
							    <label class="text-dark" style=""><b>Dirección de Hogar:</b></label>
							    <input name="direccion" type="text" class="form-control" id="direccion" placeholder="Ingrese su Dirección...">
						    </div>
						    <div class="form-group col-10 mt-2">
						    	<input type="hidden" name="solicitud" value="registrar">
								<button type="submit" class="btn btn-danger boton px-5 py-2" name="btnsubmit">Crear Cuenta</button>
							</div>
						</div>
					</form>

				</div>
	    	</div>
	    	
	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->

<?php  
	include ("../footer.php");
?>

<script type="text/javascript" src="validaciones_formulario.js"></script>
<script type="text/javascript">
	function redireccion(){
		<?php if (isset($_GET["grabar"])): ?>
			location.href = "/AlCampo/Carrito/car.php";
		<?php else: ?>
			location.href = "/AlCampo";
		<?php endif; ?>
	}

	function redireccion2(){
		<?php if (isset($_GET["grabar"])): ?>
			location.href = "/AlCampo/Usuario/registro.php?grabar=";
		<?php else: ?>
			location.href = "/AlCampo/Usuario/registro.php";
		<?php endif; ?>
	}

	function redireccion3(){
		location.href = "/AlCampo/Administracion/home.php";
	}
</script>