<?php 
	ob_start();
	session_start();

	if(isset($_SESSION["usuario"])){
		$u_id = $_SESSION["id"];
		$u_nombre = $_SESSION["usuario"];
		$u_contraseña = $_SESSION["pass"];
		$u_nivel = $_SESSION["tipo"];
	}
	else{
		$u_id = 0;
		$u_nivel = 2;
	}

	require("bin/connect.php");
	//PARA TOMAR LA CANTIDAD DE PRODUCTOS DEL CARRITO
		$sql="SELECT * FROM PRODUCTOS INNER JOIN CARRITO ON PRODUCTOS.CODIGO=CARRITO.CODIGO where ID=:id";
		$query=$bdd->prepare($sql);
		$query->execute(array(":id"=>$u_id));
		$contador = $query->rowCount();
	//FIN PARA TOMAR LA CANTIDAD DE PRODUCTOS DEL CARRITO
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

 		.eliminar, .eliminar-2{
	      font-size: 1.5rem;
	      font-weight: 700;
	      color: #000;
	      opacity: .7;
	      cursor: pointer;
	    }

	    .eliminar:hover, .eliminar:focus, .eliminar-2:hover, .eliminar-2:focus {
	      text-decoration: none;
	      opacity: 0.8;
	    }

	    button.eliminar, button.eliminar-2{
	      padding: 0;
	      background-color: transparent;
	      border: 0;
	      -webkit-appearance: none;
	    }

	    #header{
	    	position: fixed;
	    	top: 0px;
	    	width: 100%;
	    	z-index: 1;
	    }

	    #cerrar_menu{
	    	font-weight: 100;
	    	font-size: 4rem;
	    	color: rgba(0, 0, 0, 0.5);
	    	z-index: 2;
	    }

	    .icono_color{
	    	color: #800C0A;
	    }

		#fade{
		  overflow: auto;
		  background-color: rgba(0, 0, 0, 0.3);
		  position: fixed;
		  top: 0px;
		  width: 100%;
		  height: 100%;
		  z-index: 2
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

		select.error{  /*MODIFICA LOS SELECT QUE HAYAN TENEDIO ALGUN ERROR*/
	      border: 1px solid red;
	      /*background: rgba(230,200,180,0.5);*/
	    }

	    textarea.error{  /*MODIFICA LOS TEXTAREA QUE HAYAN TENEDIO ALGUN ERROR*/
	      border: 1px solid red;
	      /*background: rgba(230,200,180,0.5);*/
	    } 

		.dropdown-item.active{
			background-color: rgba(46,49,146,0.3);
			color: black;
		}
 	</style>

 	<!-- SCRIPT INTERNO DE LA PAGINA -->
 	<script>
	    $(document).ready(function() {

	      $(".dropdown-item").hover(function() {
	      	$(this).css('background-color', 'rgba(46,49,146,0.3)');
	      }, function() {
	      	$(this).css('background-color', 'white');
	      });

	      $("#buscador").keyup(function(event) {
	      	if ($(this).val()!="") {
	      		$("#borrar_busqueda").fadeIn(500);
	      		$("#borrar_busqueda").removeClass('d-none');
	      	}
	      	else
	      		$("#borrar_busqueda").fadeOut(500);
	      });

	      $("#borrar_busqueda").click(function(event) {
	      	$("#buscador").val("");
	      	$(this).fadeOut(500);
	      });

	      $(".header_b").hover(function() {
	      	$(this).css('text-decoration', 'none');
	      }, function() {
	      });

	      $("#fade").click(function(event) {
	      	$("#barra_navegacion").fadeOut(500);
	      	//$("#main_c").removeClass('bgfade');
	      	//$("#header").removeClass('bgfade');
	      	$("#fade").addClass('d-none');
	      });

	      $("#cerrar_menu").click(function(event) {
	      	$("#barra_navegacion").fadeOut(500);
	      	//$("#main_c").removeClass('bgfade');
	      	//$("#header").removeClass('bgfade');
	      	$("#fade").addClass('d-none');
	      });

	      $("#menu_navegacion").click(function(event) {
	      	$("#barra_navegacion").removeClass('d-none');
	      	$("#barra_navegacion").fadeIn(500);
	      	//$("#main_c").addClass('bgfade');
	      	//$("#header").addClass('bgfade');
	      	$("#fade").removeClass('d-none');
	      });
	      	$("#barra_navegacion").hide();

	      $(".icono_head").hover(function() {
	      	var id = $(this).attr('id');
	      	$("."+id).removeClass('icono_color');
	      }, function() {
	      	var id = $(this).attr('id');
	      	$("."+id).addClass('icono_color');
	      });

	      $("#search").click(function(event) {
	      	var busqueda = $("#buscador").val();
	      	location.href = "/AlCampo/Productos/productos.php?producto="+busqueda;
	      });

	      $("#logo-imagen").click(function(event) {
	      	location.href = "/AlCampo";
	      });

	      $("#manual1").click(function(event) { //para mostrar el manual de usuario en otra pestaña
	        open("/AlCampo/Guia.pdf", "Manual de Usuario", "height=100%","width=100%");
	      });

	      $(".user-drop").hover(function() {
	      	var id = $(this).attr('id');
	      	$("#c_"+id).css('text-decoration', 'underline');
	      	$("#i_"+id).removeClass('text-danger');
	      	$("#i_"+id).css('color', '#c82333');
	      }, function() {
	      	var id = $(this).attr('id');
	      	$("#c_"+id).css('text-decoration', 'none');
	      	$("#i_"+id).addClass('text-danger');
	      });

	      $("#btn-login").click(function(event) {
	      	location.href = "/AlCampo/Usuario/registro.php";
	      });

	      $("#btn-cerrar").click(function(event) {
	      	location.href = "/AlCampo/bin/csion.php";
	      });
	    });
  	</script>
</head>
<body>

<!-- BARRA SUPERIOR FRANJA DE BUSQUEDA Y LOGIN -->
	<div class="navbar navbar-fixed-top p-0 bg-light sticky-top" id="header" style="border-bottom: 1px solid rgba(0,0,0,0.2)">
	  <div class="container-fluid py-0 px-sm-4 px-0">
	    <div class="col-12 row justify-content-between px-sm-3 px-0 mx-0">
	      <div class="col-xl-4 col-12 m-auto row m-auto text-sm-justify text-center">
	      	<div class="px-4" id="menu_navegacion" style="cursor: pointer">
		      	<i class="icon-menu d-block text-danger" style="font-size: 30px"></i>
	      		<span class="d-block">Menu</span>
      		</div>
	      	<img src="/AlCampo/Imagenes/logo.png" id="logo-imagen" class="img-fluid mr-md-3 mx-md-0 mx-auto" height="150" width="150" style="cursor: pointer">
	      </div>
	      <div class="col-xl-8 col-12 row px-4 py-0 pt-4 pt-md-0 justify-content-end">
	        <form class="form-inline row ml-auto" action="/AlCampo/Productos/productos.php" method="get">
	        	<div class="form-control">
				    <input size="40" class="mr-sm-2" type="text" placeholder="Buscar.." aria-label="Buscar.." style="border: 0" id="buscador" name="producto">
		            <span class="mr-2 d-none" id="borrar_busqueda" style="cursor: pointer">Borrar..</span>
				    <span id="search" style="cursor: pointer"><i class="fa fa-search"></i></span>
			    </div>
		    </form>
	        <ul class="nav justify-content-end ml-auto ">
	          <li class="nav-item active text-center dropdown">
	          	<a href="" class="mr-3 header_b" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: black !important;">
	          		<i class="icon-user d-block text-danger" style="font-size: 30px"></i>
	          		<?php if (isset($u_nombre)): ?>
	          			<span class="d-block" id="texto-nombre"><?php echo $u_nombre ?></span>
	          		<?php else: ?>
	          			<span class="d-block">Identificate</span>
	          		<?php endif; ?>
	          	</a>
	          	<div class="dropdown-menu py-4 px-4" style="font-size: 12px">
	          	  <?php if(isset($u_nombre)): ?>
			      	<button class="btn btn-danger m-auto" id="btn-cerrar" style="font-size: 12px">Finalizar Sesión Actual</button>
			      <?php else: ?>
			      	<button class="btn btn-danger m-auto" id="btn-login" style="font-size: 12px">Identifícate / Registrate</button>
			      <?php endif; ?>
			      <h1 class="col-12 m-auto py-2" style="border-bottom: 1px solid rgba(0,0,0,0.2);"></h1>
			      <div class="row">
			      	  <span id="ucompras" class="col-12 user-drop">
			      	  	<i id="i_ucompras" class="mt-3 fa fa-box-open fa-lg text-danger"></i>
				        <a href="<?php if(isset($_SESSION["usuario"])) echo '/AlCampo/Compras/compras.php'; else echo '/AlCampo/Usuario/registro.php'; ?>" class="" style="text-decoration: none">
				      	<span class="text-dark" id="c_ucompras"> Consulta tus Compras </span>
				        </a>
				      </span>
				      <span id="uuser" class="col-12 user-drop">
				      	<i id="i_uuser" class="mt-3 fa fa-user-cog fa-lg text-danger"></i>
				        <a href="<?php if(isset($_SESSION["usuario"])) echo '/AlCampo/Usuario/configuracion.php'; else echo '/AlCampo/Usuario/registro.php'; ?>" class="" style="text-decoration: none">
				      	<span class="text-dark" id="c_uuser"> Configurar Usuario </span>
				        </a>
				      </span>
				      <?php if ($u_nivel!=2): ?>
				      <span id="uadm" class="col-12 user-drop">
				      	<i id="i_uadm" class="mt-3 fa fa-book fa-lg text-danger"></i>
				        <a href="/AlCampo/Administracion/home.php" class="" style="text-decoration: none">
				      	<span class="text-dark" id="c_uadm"> Abrir Administración </span>
				        </a>
				      </span>
				      <?php endif ?>
			      </div>
			    </div>
	          </li>
	          <li class="nav-item ml-3 text-center">
	          	<a href="/AlCampo/Carrito/car.php" class="mr-3 header_b" style="color: black !important">
	          		<i class="icon-basket d-block text-danger" style="font-size: 30px"></i>
	          		<span class="d-block">Carrito (<b id="cantidad-carrito"><?php echo $contador ?></b>)</span>
	          	</a>
	          </li>
	        </ul>
	      </div>
	      <!--/.nav-collapse --> 
	    </div>
	    <!-- /container --> 
	  </div>
	  <!-- /navbar-inner --> 
	</div>
<!-- FIN FRANJA SUPERIOR DE BUSQUEDA Y LOGIN -->

<!-- BARRA DE NAVEGACION -->
	<div class="nav-side-menu d-none" id="barra_navegacion" style="z-index: 5">
	    <div class="brand py-2">
	    	<div class="m-auto text-center row justify-content-center py-3">
	    		<button id="cerrar_menu" type="button" class="eliminar-2 my-auto mr-3" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
				<!--<span><i class="icon icon-close m-auto pr-4" style="font-size: 50px"></i></span>-->
		    	<img src="/AlCampo/Imagenes/logoblanco.png" class="img-fluid" width="200" height="200"><br>
	    	</div>
	    </div>
	    <div class="menu-list">
	        <ul id="menu-content" class="menu-content collapse out text-white text-justified d-block">
	            <li class="py-2 mx-4 icono_head" id="ic">
	                <a href="/AlCampo/Productos/productos.php?producto=Carne&forma=1"><i class="fa fa-fish fa-lg ic icono_color"></i><i class="ic icono_color fa fa-caret-right fa-lg"></i> Carnes </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="ip">
	                <a href="/AlCampo/Productos/productos.php?producto=Panaderia&forma=1"><i class="fa fa-bread-slice fa-lg ip icono_color"></i><i class="ip icono_color fa fa-caret-right fa-lg"></i> Panadería </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="ib">
	                <a href="/AlCampo/Productos/productos.php?producto=Bodega&forma=1"><i class="ib icono_color fa fa-candy-cane fa-lg"></i><i class="ib icono_color fa fa-caret-right fa-lg"></i> Bodegon </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="ich">
	                <a href="/AlCampo/Productos/productos.php?producto=Charcuteria&forma=1"><i class="ich icono_color fa fa-cheese fa-lg"></i><i class="ich icono_color fa fa-caret-right fa-lg"></i> Charcutería </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="iv">
	                <a href="/AlCampo/Productos/productos.php?producto=Verdura&forma=1"><i class="iv icono_color fa fa-carrot fa-lg"></i><i class="iv icono_color fa fa-caret-right fa-lg"></i> Verduras </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="if">
	                <a href="/AlCampo/Productos/productos.php?producto=Fruta&forma=1"><i class="if icono_color fa fa-apple-alt fa-lg"></i><i class="if icono_color fa fa-caret-right fa-lg"></i> Frutas </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="iu">
	                <a href="<?php if(isset($_SESSION["usuario"])) echo '/AlCampo/Compras/compras.php'; else echo '/AlCampo/Usuario/registro.php'; ?>"><i class="iu icono_color fa fa-box-open fa-lg"></i><i class="iu icono_color fa fa-caret-right fa-lg"></i> Compras Realizadas </a>
	            </li>
	            <li class="py-2 mx-4 icono_head" id="icon">
	                <a href="<?php if(isset($_SESSION["usuario"])) echo '/AlCampo/Usuario/configuracion.php'; else echo '/AlCampo/Usuario/registro.php'; ?>"><i class="icon icono_color fa fa-user-cog fa-lg"></i><i class="icon icono_color fa fa-caret-right fa-lg"></i> Configuración </a>
	            </li>
	            <?php if ($u_nivel!=2): ?>
		            <li class="py-2 mx-4 icono_head" id="ia">
		                <a href="/AlCampo/Administracion/home.php"><i class="ia icono_color fa fa-book fa-lg"></i><i class="ia icono_color fa fa-caret-right fa-lg"></i> Administracion </a>
		            </li>
	            <?php endif ?>
	            <li class="py-2 mx-4 icono_head" id="ii">
	                <a id="manual1"><i class="ii icono_color fa fa-info-circle fa-lg"></i><i class="ii icono_color fa fa-caret-right fa-lg"></i> Ayuda </a>
	            </li>
	        </ul>
	    </div>
	</div>
<!-- FIN BARRA DE NAVEGACION -->

	<div id="fade" class="d-none"></div>
<!--
</body>
</html>
-->
