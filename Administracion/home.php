<?php 
	include("administracion.php");
?>
	<style type="text/css">
		.centrado{
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			min-height: calc(100% - (0.5rem * 2));
		}

		html, body{
 			background-image: url('/AlCampo/Imagenes/abasto3.jpg');
 			background-attachment: fixed;
 			background-repeat: no-repeat;
 			background-size: cover; 
 		}
	</style>
<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12 centrado" style="height: 100%; background-color: rgba(255,255,255,0.9)" id="main">
	    <div id="contenido" class="my-auto">
	    	<div class="col-lg-10 col-md-12 mx-auto px-5">
	          <div class="row text-center">
	            <div class='col-12'>
	              <img src="../Imagenes/logo.png" class="img-fluid">
	              <h1 class='text-primary text-center'>Sección de Administrador</h1>
	          	  <h2 class="font-weight-light fuente text-center">Bienvenido <?php echo $u_nombre ?></h2>
	              <h2 class='text-dark'>Presiona sobre las opciones para realizar distintas tareas.</h2>
	            </div>
	          </div>
	        </div>
	    </div>
	</div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
</body>
</html>	