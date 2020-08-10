<?php 
	include("../header.php");
	require("../bin/connect.php");
  require("paginacion.php");
	//session_start();

?>

<style type="text/css">
  body{
    background-image: none;
    background-color: white;
  }
</style>

<script>
    $(document).ready(function() {

      $(".swal-button--confirm").addClass('bg-success');

      $(".car").click(function(event) {
        var boton= $(this).attr("id");  //YA AQUI TOMARIA EL ID Y CON ESO TRABAJO
        $(".cantidad").each(function(index, el) {
          var pro = $(this).attr("id");
          if(boton == pro){
            var valor = parseInt($(this).val());
            if(valor<=0){ //ERROR POR SI PUSO VALORES NEGATIVOS
              $(this).val(1);
              swal({
                  title: 'No puede Ingresar Unidades menores a 1.',
                  text: 'Pruebe Ingresar otra Cantidad.',
                  icon: 'error',
                  button: 'Aceptar',
                });
            }
            else{ //ENVIO AQUI EL JSON CON LOS DATOS DEL PRODUCTO COMPRADO
              $.ajax({
                data : {
                  'codigo' : boton,
                  'id': $("#id-usuario").val(),
                  'cantidad' : $(this).val()
                },
                url : 'proceso_productos.php',
                type : 'post',
                beforeSend: function(){
                },
                success : function(busqueda){
                  var product=JSON.parse(busqueda);
                  console.log(product);
                  swal({
                    title: 'Producto insertado correctamente al carrito',
                    icon: 'success',
                    button: 'Aceptar',
                  });
                  $(".swal-button--confirm").addClass('bg-success');
                  $(".swal-button--confirm").addClass('m-auto');
                  $(".swal-title").addClass('font-weight-normal');
                  var texto = $("#cantidad-carrito").text();
                  texto = parseInt(texto);
                  texto++;
                  if(busqueda==1)
                    $("#cantidad-carrito").text(texto);
                }
              });
            }
          }
        });
      });

    });
</script>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12" style="height: 100%;" id="main_c">
	    <div id="contenido" class="row justify-content-center pb-3" style="background-color: white; padding-top: 150px;">
	      
        <input type="hidden" name="id-usuario" id="id-usuario" value="<?php echo $u_id ?>">

        <!-- PAGINACION DE LOS PRODUCTOS -->
          <?php if ($bdd_filas!=0): ?>
            <div class='row justify-content-between w-80 pag'>
              <div class='col-xl-4 col-lg-4 col-md-5 col-sm-12'>
                <h6 class='text-muted mb-lg-3 mb-2'>Cantidad de Productos: <strong class='text-dark'><?php echo $bdd_filas ?></strong></h6>
              </div>
              <div class='col-xl-4 col-lg-3 col-md-4 col-sm-12 text-right'>
                <h6 class='text-muted mb-lg-3 mb-2'><?php echo $empezar ?>-<?php echo $empezarf ?> / Página:
                  <?php for ($i=1; $i < $pgn_total+1 ; $i++): ?>
                    <?php if ($i==$pagina): ?>
                      <a class='text-dark' href='productos.php?producto=<?php echo $producto; if(isset($_GET["forma"])) echo "&forma=".$_GET["forma"]; ?>&pagina=<?php echo $i ?>'><strong> <?php echo $i ?></strong></a>
                    <?php else: ?>
                      <a class='text-muted' href='productos.php?producto=<?php echo $producto; if(isset($_GET["forma"])) echo "&forma=".$_GET["forma"]; ?>&pagina=<?php echo $i ?>'>  <?php echo $i ?></a>
                    <?php endif; ?>
                  <?php endfor; ?>
                </h6>
              </div>
            </div>
          <?php endif; ?>
        <!-- FIN PAGINACION DE LOS PRODUCTOS -->

        <!--  ESTRUCTURA DE IMPRESION DE UN PRODUCTO  -->
          <?php foreach ($productos as $product): ?>
            <div class="card col-xl-3 col-lg-4 col-md-5 col-sm-6 col-10 mb-2 mx-md-2 mx-0">
              <img class="card-img-top" src="<?php echo $product->Imagen ?>" alt="Card image cap" height="180">
              <div class="card-body">
                <h5 class="card-title d-inline"><?php echo $product->Nombre ?></h5>
                <p class="card-text text-center text-danger font-weight-bold" style="font-size: 2.2rem; margin-top: -8px"><?php echo $product->Precio ?>
                  <span class="font-weight-normal" style="font-size: 1.5rem">Bs</span>
                  <?php if ($product->Categoria!="Bodega"): ?>
                    <font size="2" class="text-dark"> x Kg</font>
                  <?php else: ?>
                    <font size="2" class="text-dark"> x Und</font>
                  <?php endif; ?>
                </p>
                <div class="row" style="margin-top: -12px">
                  <input id="<?php echo $product->Codigo ?>" align="left" class=" col-2 form-control form-control-sm cantidad" type='number' name='cantidad' value='1' min='1'><font size='2' class="m-auto">.und</font>
                  <a id="<?php echo $product->Codigo ?>" class="text-white btn bg-success btn-success col-8 font-weight-bold borde car">Agregar al Carrito</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
	    	<!-- FIN ESTRUCTURA DE IMPRESION DE UN PRODUCTO  -->

        <!-- PAGINACION DE LOS PRODUCTOS -->
          <?php $total=$empezarf-$empezar; ?>
          <?php if (($bdd_filas!=0)AND($total>=6)): ?>
            <div class='row justify-content-between w-80 pag' style="padding-bottom: 40px">
              <div class='col-xl-4 col-lg-4 col-md-5 col-sm-12'>
              </div>
              <div class='col-xl-4 col-lg-3 col-md-4 col-sm-12 text-right'>
                <h6 class='text-muted mb-lg-3 mb-2'><?php echo $empezar ?>-<?php echo $empezarf ?> / Página:
                  <?php for ($i=1; $i < $pgn_total+1 ; $i++): ?>
                    <?php if ($i==$pagina): ?>
                      <a class='text-dark' href='productos.php?producto=<?php echo $producto; if(isset($_GET["forma"])) echo "&forma=".$_GET["forma"]; ?>&pagina=<?php echo $i ?>'><strong> <?php echo $i ?></strong></a>
                    <?php else: ?>
                      <a class='text-muted' href='productos.php?producto=<?php echo $producto; if(isset($_GET["forma"])) echo "&forma=".$_GET["forma"]; ?>&pagina=<?php echo $i ?>'>  <?php echo $i ?></a>
                    <?php endif; ?>
                  <?php endfor; ?>
                </h6>
              </div>
            </div>
          <?php endif; ?>
        <!-- FIN PAGINACION DE LOS PRODUCTOS -->

        <!-- SI NO HAY NADA EN LA BUSQUEDA IMPRIMIMOS ESTO -->
          <?php if (!$productos): ?>
            <div class='col-md-8 col-12 pt-3 pb-5' style="font-family: arial; margin-top: 50px; margin-bottom: 50px">
              <h5 class='text-muted mb-lg-4 mb-2'>Resultado para: 
                <strong class='text-dark'><?php echo $producto ?></strong>
              </h5>
              <p class='display-6 text-dark mb-3'>
                <span class='display-5 text-primary'>LO SENTIMOS,</span>
                <br>NO SE HAN ENCONTRADO RESULTADOS COINCIDENTES
              </p>
              <h5 class='text-muted'>¡Prueba a realizar otra búsqueda!<a href="productos.php?producto=" style="text-decoration: none"> Haciendo Click Aquí...</a></h5>
            </div>
          <?php endif; ?>
        <!-- FIN DE IMPRECION CUANDO NO SALE NADA -->

	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->
      
      <!-- PARA TOMAR EL GET DEL PRODUCTO Y EVALUAR SI SE PONE EN LA BARRA LATERAL MARCADO -->
      <input type="hidden" name="barra-producto" id="barra-producto" value="<?php echo $_GET["producto"] ?>">
<?php  
	include ("../footer.php");
?>

<?php if(!isset($_GET["forma"])): ?>
  <script type="text/javascript">
    $("#buscador").val("<?php echo $producto ?>");
  </script>
<?php endif ?>

<script type="text/javascript">
  //ACOMODAR LA BARRA LATERAL SEGUN AL PRODUCTO BUSCADO
  var producto = $("#barra-producto").val(); 
  switch (producto) {
    case "Carne":
        $("#ic").addClass('active');
        $(".ic").removeClass('icono_color');
        $(".ic").addClass('text-white');
      break;

    case "Panaderia":
        $("#ip").addClass('active');
        $(".ip").removeClass('icono_color');
        $(".ip").addClass('text-white');
      break;

    case "Bodega":
        $("#ib").addClass('active');
        $(".ib").removeClass('icono_color');
        $(".ib").addClass('text-white');
      break;

    case "Charcuteria":
        $("#ich").addClass('active');
        $(".ich").removeClass('icono_color');
        $(".ich").addClass('text-white');
      break;

    case "Verdura":
        $("#iv").addClass('active');
        $(".iv").removeClass('icono_color');
        $(".iv").addClass('text-white');
      break;

    case "Fruta":
        $("#if").addClass('active');
        $(".if").removeClass('icono_color');
        $(".if").addClass('text-white');
      break;
  }
</script>

