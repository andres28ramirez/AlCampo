<?php 
	include("../header.php");
	include("../bin/connect.php");
	
	session_start();

	if(!isset($_SESSION["usuario"])){
		header("location:/AlCampo");
	}

	$proceso_configuracion=0;
	$id = $_SESSION['id'];
	include("proceso_usuario.php");

?>

<style type="text/css">
	#banconf{
		background-image: url("../Imagenes/conf_bann.jpg");
		background-size: cover;
		background-position: center;
		height: 12vh;
	}

	body, #header{
		padding-right: 0px !important;
		margin-right: 0px !important;
	}

	.boton{
		border-radius: 50px;
	}

	.boton:hover, .boton.hover {
	  outline: 0;
	  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
	}

	.form-control::placeholder{
		font-style: italic;
	}
</style>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main_c">
	    <div id="contenido" class="row justify-content-center px-0 pb-3" style="background-color: rgba(255,255,255,1); padding-top: 80px;">
	 
	 		<!--CONTENEDOR DE LA CONFIGURACION-->
	    	<div class="container-fluid my-3">
			    <div class="mt-2 mx-auto col-lg-8 col-md-10 col-12 d-none d-lg-block" id="banconf">
			    	<h2 class="text-primary ">Mi Cuenta</h2>
			    	<span class="text-muted font-weight-bold">Visualiza o Modifica tus datos!</span>
			    </div>
			    <!-- CUANDO ESTE MAS CHICO SE VA LA IMAGEN DEL BACKGROUND -->
			    <div class="mt-2 mx-auto col-12 d-lg-none d-md-block text-center">
			    	<h2 class="text-primary ">Mi Cuenta</h2>
			    	<span class="text-muted font-weight-bold">Visualiza o Modifica tus datos!</span>
			    </div>

			    <div class="row mt-4">
			    	<!-- LLEVA EL CODIGO O ID DEL USUARIO PARA LAS MODIFICACIONES -->
			    	<input type="hidden" name="id-persona" id="id-persona" value="<?php echo $id ?>">

			    	<!-- DATOS DE ACCESO O LOGIN -->
				    	<div class="col-lg-6 col-md-10 col-sm-10 col-11 mx-auto">
				    		<h5>Datos de Acceso</h5>
				    		<div class="border px-4 py-3 text-dark row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Email: </span><span class="" id="texto-correo"><?php echo $registro1["Correo"]; ?></span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href="" data-toggle="modal" data-target="#M-email">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR EL EMAIL -->
				    			<div class="modal fade" id="M-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modificar Correo Electrónico:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_correo">
										  <div class="form-group">
							    			<label class="text-dark"><b>Correo Electrónico</b></label>
				    						<input name="correo1" type="text" class="form-control caja-1" id="correo1" aria-describedby="emailHelp" placeholder="<?php echo $registro1["Correo"]; ?>">
				    						<label id="fail-correo" class="mr-auto d-none ml-1" style="color: red">Correo Suministrado ya Pertenece a un Usuario..</label>
							  			  </div>
							  			  <div class="form-group">
							    			<label class="text-dark"><b>Confirmar Correo Electrónico</b></label>
				    						<input name="correo2" type="text" class="form-control caja-1" id="correo2" aria-describedby="emailHelp" placeholder="Confirmar Correo...">
							  			  </div>
							  			  <div class="col-11 m-auto mt-3" style="border-bottom: 1px solid rgba(0,0,0,0.2)"></div>
							              <div class="form-group mt-3">
							                <label class="text-dark"><b>Confirmar Cambios Ingresando la Contraseña</b></label>
							                <input name="contra" type="text" class="form-control caja-1" id="contra1" aria-describedby="emailHelp" placeholder="Contraseña Actual..." required title="Ingrese Contraseña para Confirmar los Cambios.">
							                <label id="" class="mr-auto d-none fail-contraseña ml-1" style="color: red">Contraseña Erronea..</label>
							              </div>
								          <div class="modal-footer">
								        	<button type="submit" class="btn btn-danger boton px-5 py-2"  name="b_correo">Modificar</button>
								          </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACION -->
				    		</div>
				    		<div class="border px-4 py-3 text-dark mt-2 row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Contraseña: </span><span class="">********</span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href=""  data-toggle="modal" data-target="#M-pass">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR LA CONTRASEÑA -->
				    			<div class="modal fade" id="M-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modificar Contraseña de Acceso:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_pass">
										    <div class="form-group">
							    				<label class="text-dark"><b>Contraseña</b></label>
				    							<input name="pass1" type="password" class="form-control caja-1" id="pass1" aria-describedby="emailHelp" placeholder="Contraseña...">
							  			    </div>
								  			<div class="form-group">
								    			<label class="text-dark"><b>Confirmar Contraseña</b></label>
					    						<input name="pass2" type="password" class="form-control caja-1" id="pass2" aria-describedby="emailHelp" placeholder="Confirmar Contraseña...">
								  			</div>
								  			<div class="col-11 m-auto mt-3" style="border-bottom: 1px solid rgba(0,0,0,0.2)"></div>
								            <div class="form-group mt-3">
								                <label class="text-dark"><b>Confirmar Cambios Ingresando la Contraseña</b></label>
								                <input name="contra" type="password" class="form-control caja-1" id="contra2" aria-describedby="emailHelp" placeholder="Contraseña Actual..." required title="Ingrese Contraseña para Confirmar los Cambios.">
								                <label id="" class="mr-auto d-none fail-contraseña ml-1" style="color: red">Contraseña Erronea..</label>
								            </div>
									        <div class="modal-footer">
									        	<button type="submit" class="btn btn-danger boton px-5 py-2" name="b_pass">Modificar</button>
									        </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACIÓN -->
				    		</div>
				    	</div>
			    	<!-- FIN DATOS DE ACCESO O LOGIN -->
			    
			    	<!-- DATOS DEL USUSARIO -->
			    		<?php if($_SESSION["tipo"]!=-1): ?>

				    	<div class="w-100"></div> <!--FORZAR LA SEPARACION-->
				    	
				    	<div class="col-lg-6 col-md-10 col-sm-10 col-11 mx-auto mt-5">
				    		<h5>Datos Personales</h5>
				    		<div class="border px-4 py-3 text-dark row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Nombre: </span><span class="" id="texto2-nombre"><?php echo $registro2["Nombre"]; ?></span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href="" data-toggle="modal" data-target="#M-nombre">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR EL NOMBRE -->
				    			<div class="modal fade" id="M-nombre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modificar Nombre Suministrado:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_nombre">
											<div class="form-group">
								    			<label class="text-dark"><b>Nuevo Nombre</b></label>
					    						<input name="nombre" type="text" class="form-control caja-1" id="nombre" aria-describedby="emailHelp" placeholder="<?php echo $registro2["Nombre"]; ?>">
								  			</div>
									        <div class="modal-footer">
									        	<button type="submit" class="btn btn-danger boton px-5 py-2" name="b_nombre">Modificar</button>
									        </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACIÓN -->
				    		</div>
				    		<div class="border px-4 py-3 text-dark mt-2 row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Apellido: </span><span class="" id="texto-apellido"><?php echo $registro2["Apellido"]; ?></span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href="" data-toggle="modal" data-target="#M-apellido">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR EL APELLIDO -->
				    			<div class="modal fade" id="M-apellido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modficar Apellido Suministrado:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_apellido">
											<div class="form-group">
								    			<label class="text-dark"><b>Nuevo Apellido</b></label>
					    						<input name="apellido" type="text" class="form-control caja-1" id="apellido" aria-describedby="emailHelp" placeholder="<?php echo $registro2["Apellido"]; ?>">
								  			</div>
									        <div class="modal-footer">
									        	<button type="submit" class="btn btn-danger boton px-5 py-2" name="b_apellido">Modificar</button>
									        </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACIÓN -->
				    		</div>
				    	</div>
			    		<?php endif; ?>
			    	<!-- FIN DATOS DEL USUARIO -->

			    	
			    	<!-- DATOS DE DIRECCION DE HOGAR -->

				    	<div class="w-100"></div> <!--FORZAR LA SEPARACION-->
				    	
				    	<div class="col-lg-6 col-md-10 col-sm-10 col-11 mx-auto mt-5 mb-3">
				    		<h5>Dirección de Hogar</h5>
				    		<div class="border px-4 py-3 text-dark row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Municipio: </span><span class="" id="texto-municipio"><?php echo $registro2["Ciudad"]; ?></span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href="" data-toggle="modal" data-target="#M-ciudad">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR LA CIUDAD -->
				    			<div class="modal fade" id="M-ciudad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modificar Ciudad de Hogar:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_ciudad">
											<div class="form-group">
								    			<label class="text-dark"><b>Nueva Ciudad</b></label>
					    						<select class="form-control caja-1" id="ciudad" name="ciudad">
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
									        <div class="modal-footer">
									        	<button type="submit" class="btn btn-danger boton px-5 py-2" name="b_ciudad">Modificar</button>
									        </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACIÓN -->
				    		</div>
				    		<div class="border px-4 py-3 text-dark mt-2 row">
				    			<div class="col-10">
				    				<span class="font-weight-bold">Dirección: </span><span class="" id="texto-direccion"><?php echo $registro2["Direccion"]; ?></span>
				    			</div>
				    			<div class="col-2 text-right">
				    				<a href="" data-toggle="modal" data-target="#M-direccion">Editar</a>
				    			</div>
				    			<!-- MODAL PARA CONFIGURAR LA DIRECCIÓN -->
				    			<div class="modal fade" id="M-direccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Modificar Dirección de Hogar:</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="h-50" action="configuracion.php" method="post" id="f_direccion">
											<div class="form-group">
								    			<label class="text-dark"><b>Nueva Dirección</b></label>
					    						<input name="direccion" type="text" class="form-control caja-1" id="direccion" aria-describedby="emailHelp" placeholder="<?php echo $registro2["Direccion"]; ?>">
								  			</div>
									        <div class="modal-footer">
									        	<button type="submit" class="btn btn-danger boton px-5 py-2" name="b_direccion">Modificar</button>
									        </div>
								  		</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- FIN MODAL DE ACTUALIZACIÓN -->
				    		</div>
				    	</div>
				    <!-- FIN DATOS DE DIRECCION DE HOGAR -->
			    </div>
			</div> 
			<!-- FIN CONTENEDOR DEL CONTENIDO DE CONFIGURACION -->

	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->

<?php  
	include ("../footer.php");
?>

<script type="text/javascript" src="validaciones_formulario.js"></script>
<script type="text/javascript">
	$(".swal-button--confirm").addClass('bg-success');
	$("#ciudad").val("<?php echo $registro2["Ciudad"]; ?>");

	$("#fail-correo").removeClass('d-none');
	$("#fail-correo").hide();

	$(".fail-contraseña").removeClass('d-none');
	$(".fail-contraseña").hide();

	//ANIMACIONES PARA QUITAR LOS MENSAJES DE ERROR
	$("#correo1").keyup(function(event) {
		$("#fail-correo").fadeOut(500);
	});

	$("#contra1").keyup(function(event) {
		$(".fail-contraseña").fadeOut(500);
	});

	$("#contra2").keyup(function(event) {
		$(".fail-contraseña").fadeOut(500);
	});

	//ACOMODAR EL BOTON EN ACTIVO EL DE CONFIGURAR EN LA BARRA LATERAL
	$("#icon").addClass('active');
	$(".icon").removeClass('icono_color');
	$(".icon").addClass('text-white');
</script>