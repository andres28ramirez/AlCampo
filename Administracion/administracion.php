<?php 
	ob_start();
	session_start();
	if(($_SESSION["tipo"]==2)||(!isset($_SESSION["usuario"]))){
    	header("location:/AlCampo");
	}
	else{
		$u_id = $_SESSION["id"];
		$u_nombre = $_SESSION["usuario"];
		$u_contraseña = $_SESSION["pass"];
		$u_nivel = $_SESSION["tipo"];
	}
	
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
 			font-family: "Tahoma";
 		}

 		body, #header{
			padding-right: 0px !important;
			margin-right: 0px !important;
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

	    .icono_color{
	    	color: #800C0A;
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

		.filtro:hover, .c_factura:hover, .estado:hover{
	        text-decoration: underline;
	        opacity: 0.8;
	        cursor: pointer;
	    }

	    .opcion:hover{
	        opacity: 0.5;
	        cursor: pointer;
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

	    .nav-side-menu{
	    	box-shadow: 0px 5px 100px -2px rgba(0,0,0,0.3);
	    }

	    ::placeholder{
			font-style: italic;
		}
 	</style>

 	<!-- SCRIPT INTERNO DE LA PAGINA -->
 	<script>
	    $(document).ready(function() {
	    
	      $(".icono_adm").hover(function() {
	      	var id = $(this).attr('id');
	      	$("."+id).removeClass('icono_color');
	      }, function() {
	      	var id = $(this).attr('id');
	      	$("."+id).addClass('icono_color');
	      });

	      $("#logo-imagen").click(function(event) {
	      	location.href = "/AlCampo/Administracion/home.php";
	      });
	    });
  	</script>
</head>
<body>


<!-- BARRA DE NAVEGACION -->
	<div class="nav-side-menu" id="barra_navegacion" style="z-index: 5">
	    <div class="brand py-2">
	    	<div class="m-auto text-center row justify-content-center py-3">
		    	<img src="/AlCampo/Imagenes/logoblanco.png" id="logo-imagen" class="img-fluid" width="200" height="200" style="cursor: pointer">
	    	</div>
	    </div>
	    <div class="menu-list">
	        <ul id="menu-content" class="menu-content collapse out text-white text-justified d-block">
	            <li class="py-2 mx-4 icono_adm" id="ip">
	                <a href="/AlCampo/Administracion/Adm-Productos/adm_productos.php"><i class="fa fa-shopping-basket fa-lg ip icono_color"></i><i class="ip icono_color fa fa-caret-right fa-lg"></i> Productos </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="iu">
	                <a href="/AlCampo/Administracion/Adm-Usuarios/adm_usuarios.php"><i class="fa fa-address-book fa-lg iu icono_color"></i><i class="iu icono_color fa fa-caret-right fa-lg"></i> Usarios </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="ic">
	                <a href="/AlCampo/Administracion/Adm-Compras/adm_compras.php"><i class="ic icono_color fa fa-shopping-cart fa-lg"></i><i class="ic icono_color fa fa-caret-right fa-lg"></i> Compras </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="ie">
	                <a href="/AlCampo/Administracion/Adm-Envios/adm_envios.php"><i class="ie icono_color fa fa-box-open fa-lg"></i><i class="ie icono_color fa fa-caret-right fa-lg"></i> Envios </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="irp">
	                <a href="/AlCampo/Administracion/Adm-Registro/adm_registro.php"><i class="irp icono_color fa fa-tag fa-lg"></i><i class="irp icono_color fa fa-caret-right fa-lg"></i> Registro de Producto </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="ira">
	                <a href="/AlCampo/Administracion/administracion.php?boton=ira"><i class="ira icono_color fa fa-tasks fa-lg"></i><i class="ira icono_color fa fa-caret-right fa-lg"></i> Registro de Actividades </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="im">
	                <a href="/AlCampo/Administracion/administracion.php?boton=im"><i class="im icono_color fa fa-chart-pie fa-lg"></i><i class="im icono_color fa fa-caret-right fa-lg"></i> Estadísticas de Marketing </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="iv">
	                <a href="/AlCampo"><i class="iv icono_color fa fa-backward fa-lg"></i><i class="iv icono_color fa fa-caret-right fa-lg"></i> Volver al Inicio </a>
	            </li>
	            <li class="py-2 mx-4 icono_adm" id="is">
	                <a href="/AlCampo/bin/csion.php"><i class="is icono_color fa fa-sign-out-alt fa-lg"></i><i class="is icono_color fa fa-caret-right fa-lg"></i> Cerrar Sesión </a>
	            </li>
	        </ul>
	    </div>
	</div>
<!-- FIN BARRA DE NAVEGACION -->
	<!-- <div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main">
	    <div id="contenido" class="mb-3">
	    	
	    </div>
	</div>
</body>
</html>	 -->
<!--
</body>
</html>
-->

