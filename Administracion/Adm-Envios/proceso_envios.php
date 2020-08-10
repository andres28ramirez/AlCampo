<?php 
  if(isset($solicitud)){
    //PARA QUE NO INTERFIERA NI JODA NADA
    return;
  }

  require("../../bin/connect.php");

  //MOSTRAR EL DETALLE DE LA FACTURA
  if (isset($_POST["mostrar"])) {
    $codigo=$_POST["codigo"];
    $facturas=$bdd->query("SELECT * FROM ORDEN where c_factura=$codigo")->fetchAll(PDO::FETCH_OBJ);

    $header="<label class='text-muted'>N° de la Factura: (<span class='text-dark font-weight-bold'>" . $codigo ."</span>)</label>
      <div class='text-center'>
        <table class='table'>
              <thead class='thead-success bg-light'>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                </tr>
              </thead>
              <tbody>";

      $body="";
      $total=0;
      foreach ($facturas as $factura) {
        $body= $body . "<tr>
              <td>" . $factura->Nombre . "</td>
              <td>" . $factura->Cantidad . "</td>
              <td style='color: red; font-weight: 450'>" . $factura->Precio . "<font size='2'> Bs.</font></td>
              <td style='color: red'><strong>" . $factura->Precio*$factura->Cantidad . "<font size='2'> Bs.</font></strong></td>
            </tr>";
      $total=$total+($factura->Precio*$factura->Cantidad);
      }

    $footer="</tbody>
        </table>
        <div class='' style='margin-top: 0px;'>
          <h2 class='font-weight-bold'>TOTAL</h2>
          <h3 class='text-danger'>" . $total . "<font size='2'> Bs</font></h3>
        </div>
      </div>";

    $respuesta= $header . $body . $footer;

    echo $respuesta;
  }

  //MOSTRAR EL DETALLE DE LA INFO DE ENVIO
  if (isset($_POST["mostrar-editar"])) {
    $codigo=$_POST["codigo"];
    $fac=$codigo;
    $factura=$bdd->prepare("SELECT * FROM ENVIOS WHERE C_FACTURA=$fac");
    $factura->execute();
    $fact=$factura->fetch(PDO::FETCH_ASSOC);

    echo "<table class='table table-bordered'>
        <thead class='thead-light'>
          <th colspan='2'>
            <h5 class='d-inline'>Nro. de Factura:<span class='text-dark codigo' id='codigo-factura' style='font-weight: 700'>" . $fac ."</span></h5>
          </th>
        </thead>
        <tbody>
            <tr>
              <td>
                <p><span class='font-weight-bold'>Tipo de Compra:</span><br class='d-md-none d-lg-block'>" . $fact["tipo"] . "</p>
                <div class=''>
                  <p><span class='font-weight-bold'>Estatus:</span><br class='d-md-none d-lg-block'></p>
                  <select class='custom-select' style='cursor: pointer;' name='estatus' id='estatus'>
                    <option>Procesando Compra</option>
                    <option>Empacando Productos</option>
                    <option>En espera de su busqueda</option>
                    <option>En camino a su destino</option>
                    <option>Entregado</option>
                  </select>
                </div>
              </td>
              <td>
                <p><span class='font-weight-bold'>Fecha del Movimiento:</span><br class='d-md-none d-lg-block'>" . $fact["fecha"] . "</p>
                <div>
                  <p><span class='font-weight-bold'>Descripción:</span><br class='d-md-none d-sm-block'></p>
                  <input type='text' id='descripcion' name='descripcion' class='form-control'>
                </div>
                
              </td>
            </tr>
        </tbody>
      </table>";
  }

  //MODIFICACION DE ESTATUS DEL ENVIO
  if(isset($_POST["modificar"])){
    $fact=$_POST["codigo"];
    $estatus=$_POST["estatus"];
    $descripcion=$_POST["descripcion"];
    $bdd->query("CALL u_envios('$estatus','$descripcion',$fact)");
    //OPERACION REALIZADA CON EXITO
    echo 1;
  }
?>