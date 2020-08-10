<?php 
	include("../administracion.php");
	include("paginacion.php");
	$solicitud = 0;
	include("actualizacion_pro.php");
?>
	<style type="text/css">
		html, body{
 			background-color: white;
 		}

 		.nav-side-menu{
	    	box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.3);
	    }

	    .boton{
			border-radius: 50px;
		}

		.boton:hover, .boton.hover {
		  outline: 0;
		  box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
		}
		
		.boton-actualizar:hover, .boton-actualizar.hover {
		  outline: 0;
		  box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
		}

		.boton-eliminar:hover, .boton-eliminar.hover {
		  outline: 0;
		  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
		}

		.fade{
			padding-right: 0px !important;
		}
	</style>
<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%; background-color: rgba(255,255,255,1)" id="main">
	    <!-- <div id="contenido" class="my-auto"> -->
        
        <div class="col-xl-10 col-lg-11 col-md-12 mx-auto mt-lg-0 py-3 table-responsive" id="opc1">
        <!-- INICIO DE LA TABLA DONDE SE IMPRIMEN LOS PRODUCTOS -->
            <h5 class="text-center font-weight-bold pt-3 pb-2 border-bottom">Productos del Almacen</h5>
            <div class="row justify-content-between mb-2 py-3">
		        <div class="col-lg-6 col-md-12 col-12">
		          <input id="busqueda_nombre" align="left" class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" type='text' name='busqueda' placeholder="nombre">
		          <label class="float-right">Buscar por Nombre:</label>
		        </div>
		        <div class="col-lg-6 col-md-12 col-12">
		          <select class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" name="busqueda_categoria" required="true" id="busqueda_categoria">
		          	<option value="">Seleccione una Opción</option>
                    <option value="Carne">Carne</option>
                    <option value="Panaderia">Panaderia</option>
                    <option value="Charcuteria">Charcuteria</option>
                    <option value="Verdura">Verdura</option>
                    <option value="Bodega">Bodega</option>
                    <option value="Fruta">Fruta</option>
	              </select>
		          <label class="float-right">Buscar por Categoría:</label>
		        </div>
		        <div class="col-lg-6 col-md-12 col-12 mt-3">
		          <input id="busqueda_codigo" align="left" class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" type='number' name='busqueda_codigo' placeholder="codigo">
		          <label class="float-right">Buscar por Código:</label>
		        </div>
		    </div>

            <table class="table table-striped text-center" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.6);">
                <h6>Cantidad de Registrados: <b id="n-registros"><?php echo $bdd_filas ?></b></h6>
                
            	<thead class="thead-success text-white" style="background-color: rgba(220, 53, 69, 1)">
                	<tr>
                		<th scope="col">Eliminar</th>
                		<th scope="col">Código</th>
                		<th scope="col">Nombre</th>
                		<th scope="col">Categoría</th>
                		<th scope="col">Precio</th>
                		<th scope="col">Opciones</th>
                	</tr>
            	</thead>
            	<tbody id="tbody">
                	<?php foreach ($registro as $producto): ?>
                	<tr id="row<?php echo $producto->Codigo; ?>">
                		<td>
                    		<button onclick="eliminar(<?php echo $producto->Codigo; ?>)" id="<?php echo $producto->Codigo; ?>" type="button" class="eliminar my-auto mr-3" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
                    	</td>
                		<th><?php echo $producto->Codigo?></th>
                		<td class="n_p<?php echo $producto->Codigo?>" id="<?php echo $producto->Nombre?>"><?php echo $producto->Nombre?></td>
                		<td class="c_p<?php echo $producto->Codigo?>"><?php echo $producto->Categoria?></td>
                		<td class="p_p<?php echo $producto->Codigo?>" id="<?php echo $producto->Precio?>"><?php echo $producto->Precio?></td>
                		<td>
                    		<button class="btn btn-secondary id_p borde ml-lg-1 mt-xl-0 mt-1 boton-actualizar" data-toggle="modal" data-target="#actualizar" onclick="actualizar(<?php echo $producto->Codigo?>)" id="<?php echo $producto->Codigo?>">Actualizar</button>
                    	</td>
                	</tr>
                	<?php endforeach; ?>  
            	</tbody>
            </table>
        <!-- FIN DE LA TABLA DONDE SE IMPRIMEN LOS PRODUCTOS -->

        <!-- PAGINACIÓN EN LA PARTE INFERIOR DE LA TABLA -->
            <nav aria-label="...">
            	<ul class="pagination justify-content-center" id="num-paginacion">
            		<!-- BOTON DE ANTERIOR -->
                  <?php if ($pagina==1): ?>
                	<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#" tabindex="-1">Anterior</a></li>
                  <?php else: ?>
                	<li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina-1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["categoria"])) echo '&categoria='; else if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>" tabindex="-1">Anterior</a></li>
                  <?php endif; ?>

                	<!-- NUMERACION DE LA PAGINACION -->
                  <?php for($i=1; $i<=$pgn_total; $i++): ?>
                    <?php if ($pagina==$i): ?>
                	<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["categoria"])) echo '&categoria='; else if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>"><?php echo $i; ?></a></li>
                    <?php else: ?>
                	<li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["categoria"])) echo '&categoria='; else if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>"><?php echo $i; ?></a></li>
                	<?php endif; ?>
                  <?php endfor; ?>

                	<!-- BOTON DE SIGUIENTE -->
                  <?php if ($pagina==$pgn_total): ?>
                	<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>
                  <?php else: ?>
                	<li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina+1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["categoria"])) echo '&categoria='; else if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>">Siguiente</a></li>
                  <?php endif; ?>
            	</ul>
            </nav>
        <!-- FIN PAGINACIÓN EN LA PARTE INFERIOR DE LA TABLA -->
        </div>
        
        <!-- MODAL  PARA LA ACTUALIZACION DE LOS DATOS DE UN PRODUCTO -->
            <div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
	                        <h5 class="modal-title text-center" id="titulo">Actualizar Producto</h5>
	                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
                        </div>
                        <form method="post" action="adm_productos.php" enctype="multipart/form-data" id="update">
                        	<div class="modal-body">
                            	<div class="form-group">
                            		<label class="text-dark"><b>Nombre:</b></label>
                            		<input class="form-control" type="text" name="a_nombre" id="a_n" required="true">
                            	</div>
	                            <div class="form-group">
	                            	<label class="text-dark"><b>Precio en Bs:</b></label>
	                            	<input class="form-control" type="text" name="a_precio" id="a_p" required="true">
	                            </div>
	                            <div class="form-group">
	                            	<label class="text-dark"><b>Categoría:</b></label>
	                            	<select class="custom-select" name="a_categoria" required="true" id="a_cat">
			                            <option value="Carne">Carne</option>
			                            <option value="Panaderia">Panaderia</option>
			                            <option value="Charcuteria">Charcuteria</option>
			                            <option value="Verdura">Verdura</option>
			                            <option value="Bodega">Bodega</option>
			                            <option value="Fruta">Fruta</option>
	                            	</select>
	                            </div>
	                            <div class="form-group">
		                            <label class="text-dark"><b>Imagen:</b></label>
		                            <label class="font-weight-light"> (No es necesario actualizarla)</label>
		                            <input class="form-control" type="file" name="a_imagen" id="a_imagen">
		                            <label id="fail-imagen" class="mr-auto d-none" style="color: red">Formato de Imagen Erroneo (JPEG/JPG/PNG)..</label>
		                            <label id="eliminar-imagen" class="mr-auto d-none" style="color: red; cursor: pointer">Presiona para Eliminar Imagen Cargada.</label>
	                            </div>
                        	</div>
                        	<div class="modal-footer">
                        		<input type="hidden" name="codigo" id="cod_actualizar">
		                        <button type="submit" class="btn btn-secondary boton px-5 py-2" name="actualizar" id="btn_actualizar">Actualizar</button>
                        	</div>
                        </form>   
                    </div>
                </div>
            </div>
        <!-- FIN MODAL PARA ACTUALIZAR LOS PRODUCTOS -->
	    
	    <!-- </div> -->
	</div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
</body>
</html>	

<script type="text/javascript" src="validaciones_admproductos.js"></script>
<script type="text/javascript" src="adm_productos.js"></script>

<script type="text/javascript">
	$("#ip").addClass('active');
	$(".ip").removeClass('icono_color');
	$(".ip").addClass('text-white');

	$("#fail-imagen").removeClass('d-none');
	$("#fail-imagen").hide();

	$("#eliminar-imagen").removeClass('d-none');
	$("#eliminar-imagen").hide();

	//VALIDACION DEL ARCHIVO
    $("#a_imagen").change(function() {
        var file = this.files[0];
        var imagen = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagen==match[0]) || (imagen==match[1]) || (imagen==match[2]))){
            $("#a_imagen").val('');
            $("#eliminar-imagen").fadeOut(500);
            $("#fail-imagen").fadeIn(1000);
            return false;
        }
        else
        	$("#fail-imagen").fadeOut(500);
        	$("#eliminar-imagen").fadeIn(1000);
    });

    $("#eliminar-imagen").click(function(event) {
    	$("#eliminar-imagen").fadeOut(500);
    	$("#a_imagen").val('');
    });
</script>