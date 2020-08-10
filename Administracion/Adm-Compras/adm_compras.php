<?php 
	include("../administracion.php");
	include("paginacion.php");
	$solicitud = 0;
	include("proceso_acompras.php");
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
            <h5 class="text-center font-weight-bold pt-3 pb-2 border-bottom">Compras Registradas</h5>
            <div class="row justify-content-center mb-2 py-3">
                <div class="col-lg-6 col-md-12 col-12">
                  <input id="busqueda_codigo" align="left" class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" type='number' name='busqueda_codigo' placeholder="codigo">
                  <label class="float-right">Buscar por Código:</label>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                  <select class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" name="busqueda_retiro" required="true" id="busqueda_retiro">
                    <option value="">Seleccione una Opción</option>
                    <option value="Retiro Presencial">Retiro Presencial</option>
                    <option value="Delivery">Delivery</option>
                  </select>
                  <label class="float-right">Buscar por Retiro:</label>
                </div>
                <div class="col-12 mt-3"></div>
                <div class="col-lg-6 col-md-12 col-12">
                  <select class="float-right ml-2 col-sm-6 col-12 form-control form-control-sm" name="busqueda_pago" required="true" id="busqueda_pago">
                    <option value="">Seleccione una Opción</option>
                    <option value="Crédito">Crédito</option>
                    <option value="Transferencia">Transferencia</option>
                  </select>
                  <label class="float-right">Buscar por Pago:</label>
                </div>
            </div>

            <table class="table table-striped text-center" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.6);">
                <h6>Cantidad de Registrados: <b id="n-registros"><?php echo $bdd_filas ?></b></h6>

                <h6 class="text-muted">Presione sobre el código de la Factura para ver al detalle la compra.</h6>
                <thead class="thead-success text-white" style="background-color: rgba(220, 53, 69, 1)">
                    <tr>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Código de Factura</th>
                        <th scope="col">Fecha de la Compra</th>
                        <th scope="col">Método de Retiro</th>
                        <th scope="col">Método de Pago</th>
                        <th scope="col">Monto de la Factura</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach ($registro as $factura): ?>
                    <tr id="row<?php echo $factura->C_Factura; ?>">
                        <th scope="row"> 
                            <button onclick="eliminar(<?php echo $factura->C_Factura; ?>,<?php echo $factura->ver; ?>)" type="button" class="eliminar" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </th>
                        <td>
                            <span class="text-primary c_factura" onclick="mostrar(<?php echo $factura->C_Factura ?>)" data-toggle="modal" data-target="#modaldr"><?php echo $factura->C_Factura; ?></span>
                        </td>
                        <td><?php echo $factura->Fecha; ?></td>
                        <td><?php echo $factura->Cancelacion; ?></td>
                        <td><?php echo $factura->Modalidad; ?></td>
                        <td style="color: red"><strong><?php echo $factura->Monto; ?><font size="3"> Bs</font></strong></td>
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
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina-1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["pago"])) echo '&pago='; else if(isset($_GET["codigo"])) echo '&codigo='; else if(isset($_GET["retiro"])) echo '&retiro='; }?>" tabindex="-1">Anterior</a></li>
                  <?php endif; ?>

                    <!-- NUMERACION DE LA PAGINACION -->
                  <?php for($i=1; $i<=$pgn_total; $i++): ?>
                    <?php if ($pagina==$i): ?>
                    <li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["pago"])) echo '&pago='; else if(isset($_GET["codigo"])) echo '&codigo='; else if(isset($_GET["retiro"])) echo '&retiro='; }?>"><?php echo $i; ?></a></li>
                    <?php else: ?>
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $i; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["pago"])) echo '&pago='; else if(isset($_GET["codigo"])) echo '&codigo='; else if(isset($_GET["retiro"])) echo '&retiro='; }?>"><?php echo $i; ?></a></li>
                    <?php endif; ?>
                  <?php endfor; ?>

                    <!-- BOTON DE SIGUIENTE -->
                  <?php if ($pagina==$pgn_total): ?>
                    <li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link text-dark" href="?pagina=<?php echo $pagina+1; if(isset($_GET["busqueda"])){ echo '&busqueda='.$_GET["busqueda"]; if(isset($_GET["pago"])) echo '&pago='; else if(isset($_GET["codigo"])) echo '&codigo='; else if(isset($_GET["retiro"])) echo '&retiro='; }?>">Siguiente</a></li>
                  <?php endif; ?>
                </ul>
            </nav>
        <!-- FIN PAGINACIÓN EN LA PARTE INFERIOR DE LA TABLA -->
        </div>

        <!-- MODAL CON LA INFORMACION SOBRE LA COMPRA HECHA POR EL USUARIO -->
            <div class="modal fade" id="modaldr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="height: auto;">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalles de la Compra</h5>
                            <button type="button" class="close r-cerrar" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span id="respuesta_d"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- FIN MODAL CON LA INFORMACION SOBRE LA COMPRA HECHA POR EL USUARIO -->

	</div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
</body>
</html>	

<script type="text/javascript" src="adm_compras.js"></script>

<script type="text/javascript">
	$("#ic").addClass('active');
	$(".ic").removeClass('icono_color');
	$(".ic").addClass('text-white');
</script>