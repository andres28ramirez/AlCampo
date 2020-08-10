<?php 
	include("../header.php");
	$solicitud = "impresion";
	include("proceso_compras.php");
?>
	
	<style type="text/css">
		.filtro:hover, .c_factura:hover, .estado:hover{
	      text-decoration: underline;
	      opacity: 0.8;
	      cursor: pointer;
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
	</style>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main_c">
	    <div id="contenido" class="row justify-content-center px-0 pb-3" style="background-color: rgba(255,255,255,1); padding-top: 80px;">
	    
	    	<?php if($total==0):?>
    			<!-- MENSAJE DE QUE NO HAY NADA EN EL CARRITO -->
      				<?php if(!isset($_POST["filtrar"])):?>
				      <div class="row justify-content-center mt-4 mb-4 py-5">
				        <div class='col-12'>
				          <p class='display-6 text-dark my-4'><span class='display-5 text-primary'>REGISTRO DE COMPRAS VACIO,</span>
				            <br>No se encuentran compras realizadas o almacenadas.</p>
				          <h5 class='text-muted'>¡Sigue Disfrutando de AlCampo SuperMarket, ir al <a href="/AlCampo">inicio</a>!</h5>
				        </div>
				      </div>
      				<?php else: ?>
				      <div class="row justify-content-center mt-4 mb-4 py-5" style="height: 100%">
				        <div class='col-12'>
				          <p class='display-6 text-dark my-4'><span class='display-5 text-primary'>REGISTRO DE COMPRAS VACIO,</span>
				            <br>No se encuentran compras realizadas segun el filtro efectuado.</p>
				          <h5 class='text-muted'>¡Trata con una nueva busqueda!, Retornar a la Sección de <a href="compras.php">Compras</a>.</h5>
				        </div>
				      </div>
      				<?php endif; ?>
    			<!--  FIN DE MENSAJE QUE NO HAY NADA EN EL CARRITO -->
    
    		<?php else :?>
    			<!-- ESTO ES PARA MOSTRAR QUE NO HAY NADA AL FINAL -->
    			<div id="compras-vacias"></div>

			    <!-- CONTENEDOR EL CUAL IMPRIME LA INFORMACIÓN EN LA PARTE SUPERIOR DE LA TABLA-->
				    <div class="col-xl-9 col-lg-9 col-md-10 col-12 mx-auto mt-xl-2 mt-2 mb-lg-1 mb-1 pt-3 tabla-info">
				      <div class="row justify-content-center">
				        <h5 class='text-primary'>Para verificar las compras al detalle presione click sobre el código o estado de la factura.</h5>
				      </div>
				    </div>
				    <div class="col-xl-9 col-lg-9 col-md-10 col-12 mx-auto mt-xl-1 mt-1 mb-lg-2 mb-2 tabla-info">
				      <div class="row justify-content-between">
				        <div class="col-xl-6 col-lg-5 col-12 align-bottom">
				          <h6 class='text-muted'>Número de Compras registradas <?php echo $mensaje ?>(<strong class='text-dark' id="cantidad-texto"><?php echo $total ?></strong>)</h6>
				        </div>
				        <?php if(isset($_POST["filtrar"])):?>
				        <div class="col-xl-7 col-lg-5 col-12 align-left">
				          <h6 class='text-muted'>Vaciar Filtro:<a href="compras.php"> Click aqui!</a></h6>
				        </div>
				        <?php endif; ?>
				        <div class="col-xl-5 col-lg-5 col-12 text-lg-right">
				          <h6>Aplicar Filtros:<span style="font-size: 1.5rem;">
				            <i class="fa fa-sort-amount-up text-danger ml-1 filtro" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
				          </span></h6>
				          <!-- PARA APLICAR FILTROS CON UN MODAL -->
				        </div>
				      </div>
				    </div>
			    <!-- FIN CONTENEDOR DE LA INFORMACIÓN -->

    			<!-- MODAL PARA APLICAR LOS FILTROS DE BUSQUEDA -->
				    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				      <div class="modal-dialog modal-lg">
				        <div class="modal-content">
				          <div class="modal-header">
				            <h5 class="modal-title">Filtros de Busqueda</h5>
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				              <span aria-hidden="true">&times;</span>
				            </button>
				          </div>
				          <div class="modal-body">
				            <form class="h-50" action="compras.php" method="post" id="register">
				              <div class="form-group col-6 float-left">
				                <label class="text-dark"><b>Método de Pago:</b></label>
				                <select class="form-control" id="pago" name="pago">
				                  <option value="0">Seleccione el Método de Pago</option>
				                  <option value="Transferencia">Transferencia</option>
				                  <option value="Crédito">Crédito</option>
				                </select>
				              </div>
				              <div class="form-group col-6 float-left">
				                <label class="text-dark"><b>Método de Retiro:</b></label>
				                <select class="form-control" id="retiro" name="retiro">
				                  <option value="0">Seleccione el Método de Retiro</option>
				                  <option value="Delivery">Delivery</option>
				                  <option value="Retiro Presencial">Retiro Presencial</option>
				                </select>
				              </div>
				              <div class="form-group col-12 float-left">
				                <label class="text-dark"><b>Por Monto:</b></label>
				                <div class="input-group">
				                    <select class="form-control" id="forma" name="forma">
				                      <option value="0">Seleccione una Busqueda por Monto</option>
				                      <option value="mayor">Montos mayores a...</option>
				                      <option value="menor">Montos menores a...</option>
				                      <option value="entre">Montos entre:</option>
				                    </select>
				                    <input id="monto1" name="monto1" type="number" class="form-control mont" placeholder="Monto" aria-label="Username" aria-describedby="basic-addon1" disabled>
				                    <input id="monto2" name="monto2" type="number" class="form-control mont" placeholder="Monto Mayor" aria-label="Username" aria-describedby="basic-addon1" disabled>
				                </div>
				              </div>
				              <div class="modal-footer">
				                <label class="error mr-3" id="errorm"></label>
				                <button type="submit" class="btn btn-danger boton px-5 py-2" name="filtrar" id="filtrar">Filtrar</button>
				              </div>
				            </form>
				          </div>
				        </div>
				      </div>
				    </div>
			    <!-- FIN DEL MODAL DE LOS FILTROS -->

			    <!-- TABLA DONDE SE MUESTRAN LAS COMPRAS REALIZADAS -->
				    <div class="table-responsive col-xl-9 col-lg-9 col-md-10 col-12 mx-auto" id="tabla-compras">
					    <table class="table p-0 col-12 table-striped text-center table-bordered" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
					      <thead class="thead-success">
					        <tr>
					          <th scope="col">Eliminar</th>
					          <th scope="col">Código de Factura</th>
					          <th scope="col">Fecha de la Compra</th>
					          <th scope="col">Método de Retiro</th>
					          <th scope="col">Método de Pago</th>
					          <th scope="col">Monto de la Factura</th>
					          <th scope="col">Estado de la Compra</th>
					        </tr>
					      </thead>
					      <tbody>
					        <?php foreach ($bdd->query($sql) as $factura): ?> <!-- Impresion de las facturas -->
					          <?php if($factura["ver"]==1):?>
						        <tr id="row<?php echo $factura['C_Factura']; ?>">
						          <th scope="row">
						            <button id="<?php echo $factura['C_Factura']; ?>" type="button" class="eliminar" aria-label="Close">
						              <span aria-hidden="true">&times;</span>
						            </button>
						          </th>
						          <td>
						              <span class="text-primary c_factura" id="<?php echo $factura['C_Factura']; ?>" ><?php echo $factura["C_Factura"]; ?></span>
						          </td>
						          <td><?php echo $factura["Fecha"]; ?></td>
						          <td><?php echo $factura["Cancelacion"]; ?></td>
						          <td><?php echo $factura["Modalidad"]; ?></td>
						          <td style="color: red">
						          	<strong><?php echo $factura["Monto"]; ?><font size="3"> Bs</font></strong>
						          </td>
						          <td>
						            <span class="text-primary estado" id="<?php echo $factura['C_Factura']; ?>" >Información</span>
						          </td> <!-- DEBE IMPRIMIR ALGO SOBRE COMO VA EL ENVIO -->
						        </tr>
					          <?php endif; ?>
					        <?php endforeach; ?>
					      </tbody>
					    </table>
				    </div>
				<!-- FIN TABLA DONDE SE MUESTRAN LAS COMPRAS REALIZADAS -->
			<?php endif; ?>

	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->

<?php  
	include ("../footer.php");
?>

<script type="text/javascript" src="validaciones_compras.js"></script>
<script type="text/javascript" src="compras.js"></script>

<?php if (isset($_GET["mensaje"])): ?>
	<script type="text/javascript">
		swal({
	        title: 'Pago del Carrito realizado Correctamente!',
	        icon: 'success',
	        closeOnClickOutside: false,
	        button: 'Aceptar',
        });
		$(".swal-button--confirm").addClass('bg-success');
		$(".swal-button--confirm").addClass('m-auto');
	</script>
<?php endif; ?>