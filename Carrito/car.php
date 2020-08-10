<?php 
	include("../header.php");
	
	session_start();

	$solicitud = "imprimir";
	include("procesos_car.php");
?>

<style type="text/css">
	th{
      font-size: 1.1rem;
    }

    body, #header{
		padding-right: 0px !important;
		margin-right: 0px !important;
	}

    .balto{
      padding: 0;
      font-weight: bold;
      background: rgba(0,0,0,0.3);
      border-color: #6c757d;
    }

    .balto:hover{
      color: #fff;
	  background-color: #5a6268;
	  border-color: rgba(0,0,0,0.2);
    }

    .balto:focus, .balto.focus {
	  box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.5);
	}

	.boton-v{
		border-radius: 10px;
	}

	.boton-v:hover, .boton.hover {
	  outline: 0;
	  color: #fff;
	  background-color: #218838;
	  border-color: #1e7e34;
	  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
	}

	.boton{
		border-radius: 50px;
	}

	.boton:hover, .boton.hover {
	  outline: 0;
	  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
	}

    .unidades{
      margin-top: 1px;
      margin-bottom: -1px;
      border: 0;
      background: transparent;
    }

    .ani:hover{
      text-decoration: underline;
      cursor: pointer;
      font-weight: 450;
    }
</style>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main_c">
	    <div id="contenido" class="row justify-content-center px-0 pb-3" style="background-color: rgba(255,255,255,1); padding-top: 80px;">
	    	
	    	<input type="hidden" name="id-usuario" id="id-usuario" value="<?php echo $u_id ?>">

	    	<?php if($contador==0):?> <!-- NO HAY PRODUCTOS -->

		    <!-- MENSAJE DE QUE NO HAY NADA EN EL CARRITO-->
			    <div class="row justify-content-center mt-5 mb-5">
			      <div class='col-12 my-3 py-4'>
			        <p class='display-6 text-dark my-4'><span class='display-5 text-primary'>CARRITO VACIO,</span>
			          <br>No se encuentran Productos Registrados.</p>
			        <h5 class='text-muted'>¡Prueba anexar Productos al Carrito con solo un <a href="../Productos/productos.php?producto=">click</a>!</h5>
			      </div>
			    </div>
		    <!--FIN DE MENSAJE QUE NO HAY NADA EN EL CARRITO -->

		    <?php else:?> <!-- HAY PRODUCTOS -->

		    <!-- ESTO ES PARA MOSTRAR QUE NO HAY NADA AL FINAL -->
    			<div id="carrito-vacio"></div>

		    <!-- CONTENEDOR EL CUAL IMPRIME LA INFORMACIÓN EN LA PARTE SUPERIOR DE LA TABLA-->
			    <div class="col-xl-8 col-lg-9 col-md-10 col-12 mx-auto mt-xl-4 mt-3 pt-4  mb-lg-2 mb-2 tabla-info">
			      <div class="row justify-content-between ">
			        <div class="col-xl-6 col-lg-5 col-12">
			          <h6 class='text-muted'>Producto pedidos (<strong class='text-dark' id="cantidad-texto"><?php echo $contador;?></strong>) - Monto Total: <strong id="precio1" class='text-dark'>...</strong></h6>
			        </div>

			        <?php if($contador>3):?> <!-- SI ES NECESARIO EL DESPLAZARSE AL FINAL Y EL MONTO TOTAL-->
			        <div class="col-xl-6 col-lg-5 col-12 text-lg-right">
			          <h6>Para Vaciar o Pagar carrito:<a href="#final"> Ir al final</a></h6><!-- SE IMPRIME SI HAY MAS DE 4 PRODUCTOS -->
			        </div>
			        <?php endif;?>
			      </div>
			    </div>
		    <!-- FIN CONTENEDOR EL CUAL IMPRIME LA INFORMACIÓN EN LA PARTE SUPERIOR DE LA TABLA-->

		    <!-- TABLA DONDE SE IMPRIMIRAN LOS ARTICULOS DEL CARRITO -->
				<div class="table-responsive col-xl-8 col-lg-9 col-md-10 col-12 mx-auto mt-xl-2 mt-1" id="tabla-carrito">
				    <table class="table text-center">
				        <thead class="thead-light">
				        	<tr>
				        		<th scope="col" >Eliminar</th>
				        		<th scope="col" >Producto</th>
				        		<th scope="col" >Cantidad</th>
				        		<th scope="col" >Precio Unitario</th>
				        		<th scope="col" >Precio Total</th>
				        	</tr>
				        </thead>
				        <?php while($tabla=$query->fetch(PDO::FETCH_ASSOC)):?>
				        <tbody>
				        	<tr id="row<?php echo $tabla['Codigo']?>">
					          <th scope="row">
					              <button id="<?php echo $tabla['Codigo']?>" type="button" class="eliminar" aria-label="Close">
					                <span aria-hidden="true">&times;</span>
					              </button>
					          </th>
			          		  <td><img src="<?php echo $tabla["Imagen"];?>" height="70"><br><?php echo $tabla["Nombre"]; ?></td>
				          	  <td>
					            <input type="button" class="btn text-white borde col-8 balto" id="<?php echo $tabla['Codigo']?>" value="+">
					            <button type="button" class="col-8 unidades" name="<?php echo $tabla['Codigo']?>" id="pro<?php echo $tabla['Codigo']?>"><?php echo $tabla["Cantidad"]; ?></button>
					            <input type="button" class="btn text-white borde col-8 balto" id="<?php echo $tabla['Codigo']?>" value="-">
				          	  </td>
				          	  <td style="color: red; font-weight: 450" id="uni<?php echo $tabla['Codigo']?>"><?php echo $tabla["Precio"]; ?><font size="3"> Bs</font></td>
				          	  <td style="color: red" id="total<?php echo $tabla['Codigo']?>"><strong><?php echo $tabla["Precio"]*$tabla["Cantidad"]; ?><font size="3"> Bs</font></strong></td>
				        	</tr>
				        </tbody>
				        <?php global $monto; $monto+=$tabla["Precio"]*$tabla["Cantidad"]; endwhile; ?>
				    </table>
				</div>
			<!-- FIN TABLA DONDE SE IMPRIMIRAN LOS ARTICULOS DEL CARRITO -->

			<!-- BOTONES PARA PAGAR O VACIAR CARRITO COMO TAMBIEN VISUALIZAR EL MONTO FINAL-->
			    <div class="col-xl-8 col-lg-9 col-md-10 col-12 mx-auto tabla-info pb-4" id="final">
			      <div class="row justify-content-between m-auto">
			        <div>
			          <h5 id="0" class="text-danger col-12 ani">Vaciar carrito</h6>
			        </div>
			        <div class="col-lg-6 col-12 text-lg-right text-md-center">
			          <h5 class="text-muted d-inline">Total a pagar: <span id="precio2" class="text-dark"><?php echo $monto;?> Bs</span></h5>
			          <button id="boton-pagar" class="btn btn-success boton-v px-3 font-weight-bold ml-md-1 ml-0 my-auto">Pagar</button>
			        </div>
			      </div>
			    </div>
		    <!-- FIN BOTONES PARA PAGAR O VACIAR CARRITO -->

			<?php endif;?>

	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->

<!-- MODAL PARA EL PAGO DE LOS PRODUCTOS -->
    <div class="modal fade" id="pagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: auto;">
            <div class="modal-header">
              <h5 class="modal-title">Proceso de Pago del Carrito</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="h-50" action="car.php" method="post" id="register">
              <div class="form-group">
                <label class="text-dark"><b>Método de Pago</b></label>
                <select class="form-control caja-1" id="tipo_pago" name="tipo_pago">
                    <option value="">Seleccione un método de Pago</option>
                    <option value="Crédito">Crédito</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
              </div>
              <div id="transferencia">
                <div class="form-group">
                  <label class="text-dark"><b>Cuenta a Transferir: </b></label>
                  <font size="3" class="text-muted">Banesco Nro: 01160442190207628556</font>
                </div>
                <div class="form-group">
                  <label class="text-dark"><b>Fecha del Pago</b></label>
                  <input name="fecha" type="date" class="form-control caja-1" id="fecha" aria-describedby="emailHelp" placeholder="Fecha de Transferencía">
                </div>
                <div class="form-group">
                  <label class="text-dark"><b>Referencia de Transferencia</b></label>
                  <input name="referencia" type="text" class="form-control caja-1" id="referencia" aria-describedby="emailHelp" placeholder="Número de Referencía">
                </div>
                <div class="form-group">
                  <label class="text-dark"><b>Banco emisor de la Transferencia</b></label>
                  <select class="form-control caja-1" id="banco" name="banco">
                        <option value="">Seleccione un Banco</option>
                        <option value="Banesco">Banesco</option>
                        <option value="Mercantil">Mercantil</option>
                        <option value="BOD">BOD (Banco Occidental de Descuento)</option>
                        <option value="Bancaribe">Bancaribe</option>
                        <option value="BNC">BNC (Banco Nacional de Crédtio)</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Bicentenario">Bicentenario</option>
                        <option value="Provincial">BBVA Provincial</option>
                        <option value="Otro">Otro Banco...</option>
                  </select>
                </div>
              </div>
              <div id="credito">
                <div class="form-group">
                  <label class="text-dark"><b>Número de Tarjeta</b></label>
                  <input name="tarjeta" type="text" class="form-control caja-1" id="tarjeta" aria-describedby="emailHelp" placeholder="Número">
                </div>
                <div class="form-group">
                  <label class="text-dark"><b>Tipo de Tarjeta</b></label>
                  <select class="form-control caja-1" id="tipo_tarjeta" name="tipo_tarjeta">
                        <option value="">Seleccione un tipo de tarjeta</option>
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="Amex">Amex</option>
                        <option value="American Express">American Express</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <label class="text-dark"><b>Forma de retiro de la compra</b></label>
                  <select class="form-control caja-1" id="retiro" name="retiro">
                      <option value="">Seleccione una forma de retiro</option>
                      <option value="Retiro Presencial">Retiro Presencial</option>
                      <option value="Delivery">Delivery</option>
                  </select>
              </div>
              <div class="form-group" id="direction">
                <label class="text-dark"><b>Dirección de Envio:</b></label><br>
                <font size="3" class="text-muted">Proporcione una dirección correcta recuerde que ahi se realizara el envio de su carrito.</font>
                <div class="input-group">
                  <textarea name="comentarios" rows="3" cols="100" id="comentarios"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button name="comprar" id="comprar" type="submit" class="btn btn-danger boton px-5 py-2" value="<?php echo $monto?>">Aceptar</button>
                <!-- <p class="btn btn-primary bg-danger borde mt-3" data-dismiss="modal">Cancelar</p> -->
              </div>
          </form>
            </div>
        </div>
      </div>
    </div>
<!-- FIN MODAL PARA EL PAGO DE LOS PRODUCTOS -->

<?php  
	include ("../footer.php");
?>

<script type="text/javascript" src="car.js"></script>
<script type="text/javascript" src="validaciones_car.js"></script>
<script type="text/javascript">
	function redireccion(){
		location.href = "../Usuario/registro.php?grabar=";
	}
</script>