<?php 
	include("../administracion.php");
	include("paginacion.php");
	$solicitud = 0;
	include("proceso_ausuarios.php");
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
        
        <div class="col-xl-10 col-lg-11 col-md-12 mx-auto mt-lg-0 table-responsive">
        <!-- INICIO DE LA TABLA DONDE SE IMPRIMEN LOS PRODUCTOS -->
            <h5 class="text-center font-weight-bold pt-3 pb-2 border-bottom">Usuarios Registrados</h5>
            <div class="row justify-content-between mb-2 py-3">
                <div class="col-lg-6 col-md-12 col-12">
                  <input id="busqueda_nombre" align="left" class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" type='text' name='busqueda' placeholder="nombre">
                  <label class="float-right">Buscar por Nombre:</label>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                  <input id="busqueda_codigo" align="left" class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" type='number' name='busqueda_codigo' placeholder="cédula">
                  <label class="float-right">Buscar por Cédula:</label>
                </div>
            </div>

            <table class="table table-striped text-center" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.6);">
                <h6>Cantidad de Registrados: <b id="n-registros"><?php echo $bdd_filas ?></b></h6>

                <h6 class="text-muted">Dale click a Convertir o Quitar para suministrarle al usuario permisos de administrador.</h6>
                <thead class="thead-success text-white" style="background-color: rgba(220, 53, 69, 1)">
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach ($registro as $usuario): ?>
                    <tr id="row<?php echo $usuario->Ci ?>">
                        <th scope="row">
                            <button type="submit" class="eliminar" aria-label="Close" name="borrar" onclick="eliminar(<?php echo $usuario->Ci?>)">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </th>
                        <td><?php echo $usuario->Nombre?></td>
                        <td><?php echo $usuario->Apellido?></td>
                        <th><?php echo $usuario->Ci?></th>
                        <td><?php echo $usuario->Correo?></td>
                        <td id="boton-<?php echo $usuario->ID?>">
                            <?php if ($usuario->Tipo_Usuario!=2): ?>
                                <button onclick="quitar(<?php echo $usuario->ID?>)" class="btn btn-danger boton-eliminar w-100">Quitar</button>
                            <?php else: ?>
                                <button onclick="convertir(<?php echo $usuario->ID?>)" class="btn btn-secondary boton-actualizar w-100">Convertir</button>
                            <?php endif; ?>
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
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina-1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>" tabindex="-1">Anterior</a></li>
                  <?php endif; ?>

                    <!-- NUMERACION DE LA PAGINACION -->
                  <?php for($i=1; $i<=$pgn_total; $i++): ?>
                    <?php if ($pagina==$i): ?>
                    <li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>"><?php echo $i; ?></a></li>
                    <?php else: ?>
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>"><?php echo $i; ?></a></li>
                    <?php endif; ?>
                  <?php endfor; ?>

                    <!-- BOTON DE SIGUIENTE -->
                  <?php if ($pagina==$pgn_total): ?>
                    <li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina+1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["nombre"])) echo '&nombre='; else if(isset($_GET["codigo"])) echo '&codigo='; }?>">Siguiente</a></li>
                  <?php endif; ?>
                </ul>
            </nav>
        <!-- FIN PAGINACIÓN EN LA PARTE INFERIOR DE LA TABLA -->

        </div>
	</div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
</body>
</html>	

<script type="text/javascript" src="adm_usuarios.js"></script>

<script type="text/javascript">
	$("#iu").addClass('active');
	$(".iu").removeClass('icono_color');
	$(".iu").addClass('text-white');
</script>