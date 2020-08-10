<?php 
	include("../administracion.php");
	$solicitud = 0;
	include("proceso_registro.php");
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
		  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
		}

		.fade{
			padding-right: 0px !important;
		}

        .centrado{
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            min-height: calc(100% - (0.5rem * 2));
        }
	</style>
<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%; background-color: rgba(255,255,255,1)" id="main">
        <div class="row justify-content-center centrado">
            <h5 class="text-center font-weight-bold pt-3 pb-2 border-bottom col-10">Registrar un Producto</h5>

            <!-- FOURMULARIO PARA REGISTRAR EL PRODUCTO -->
            <div class="col-lg-5 col-md-6 col-sm-8" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.3);">
                <form action="adm_registro.php" method="post" id="insert" class="col-11 mx-auto rounded mt-1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="text-dark"><b>Nombre:</b></label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Ingrese el Nombre del Producto..">
                    </div>
                    <div class="form-group">
                        <label class="text-dark"><b>Categoría:</b></label>
                        <select class="custom-select" style="cursor: pointer;" name="cat">
                            <option>Carne</option>
                            <option>Panaderia</option>
                            <option>Charcuteria</option>
                            <option>Verdura</option>
                            <option>Bodega</option>
                            <option>Fruta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-dark"><b>Precio:</b></label>
                        <input type="number" name="pre" id="pre" class="form-control" placeholder="Ingrese el Precio del Producto..">
                    </div>
                    <div class="form-group">
                        <label class="text-dark"><b>Imagen:</b></label>
                        <input type="file" name="fot" data-toggle="tooltip" data-placement="top" title="Solo se aceptan imagenes" accept="image/*" style="color: transparent;" id="archivo">
                        <label class="mt-1" id="t_archivo">Seleccione un Archivo.</label>
                        <label id="eliminar-imagen" class="mr-auto d-none" style="color: red; cursor: pointer">Presiona para Eliminar Imagen Cargada.</label>
                    </div>
                    <div class="form-group text-center mt-1">
                        <button type="submit" class="btn btn-danger boton px-5 py-2" name="b_insert">Agregar</button>
                    </div>  
                </form>
            </div>
            <!-- FIN FOURMULARIO PARA REGISTRAR EL PRODUCTO -->

            <!-- PREVIEW DEL PRODUCTO -->
            <div class="col-lg-6 col-md-6 col-sm-8">
                <label class="text-center font-weight-bold pt-3 col-12">Preview del Producto</label>
                <div class="card col-xl-8 mx-auto mb-md-0 mb-2">
                    <img class="card-img-top" id="p_imagen" src="/AlCampo/Imagenes/cargar.png" alt="Card image cap" height="180">
                    <div class="card-body">
                        <h5 class="card-title d-inline" id="p_nombre">Cebolla</h5>
                        <p class="card-text text-center text-danger font-weight-bold" style="font-size: 2.2rem; margin-top: -8px">
                            <span id="p_precio">800000</span>
                            <span class="font-weight-normal" style="font-size: 1.5rem">Bs</span>
                            <font size="2" class="text-dark"> x Kg</font>
                        </p>
                        <div class="row" style="margin-top: -12px">
                            <input id="#" align="left" class=" col-2 form-control form-control-sm cantidad" type='number' name='cantidad' value='1' min='1'><font size='2' class="m-auto">.und</font>
                            <a id="#" class="text-white btn bg-success btn-success col-8 font-weight-bold borde car">Agregar al Carrito</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN PREVIEW DEL PRODUCTO -->

        </div>
	</div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
</body>
</html>	

<script type="text/javascript" src="validaciones_rproductos.js"></script>
<script type="text/javascript" src="adm_registro.js"></script>
