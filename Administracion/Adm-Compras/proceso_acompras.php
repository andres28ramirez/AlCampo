<?php 
  if(isset($solicitud)){
    //PARA QUE NO INTERFIERA NI JODA NADA
    return;
  }

  require("../../bin/connect.php");

  //ELIMINAR COMPRA REGISTRADA
  if (isset($_POST["borrar"])){
    $codigo = $_POST["codigo"];
    $bdd->query("DELETE FROM FACTURA WHERE C_Factura='$codigo'");
    $bdd->query("DELETE FROM ORDEN WHERE C_Factura='$codigo'");
    $bdd->query("DELETE FROM ENVIOS WHERE C_Factura='$codigo'");
    //OPERACION REALIZADA CON EXITO
    echo 1;
  }

  //MOSTRAR EL DETALLE DE LA COMPRA
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
?>