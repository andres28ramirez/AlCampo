<?php 
    
    require("../bin/connect.php");
    session_start();
    if(!isset($_SESSION["usuario"])){
      header("location:/AlCampo");
    }

    $mensaje ="";
    $id=$_SESSION["id"];

    if (isset($_POST["solicitud"])) {
        $solicitud = "eliminado";
    }

    switch ($solicitud) {
      case "impresion":
            if(!isset($_POST["filtrar"]))
                //BUSQUEDA NORMAL
                $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 ORDER BY C_Factura DESC";
            else{
                //BUSQUEDA FILTRADA
                $mensaje = "según el filtro ";
                $forma = $_POST["forma"];

                if($forma!="0"){
                  $monto1 = $_POST["monto1"];
                  if($forma=="entre")
                    $monto2 = $_POST["monto2"];
                }

                $pago = $_POST["pago"];
                $retiro = $_POST["retiro"];

                //SELECCIONAR EL FILTRO ADECUADO SOLICITADO POR EL USUARIO
                if(($pago=="0")AND($forma=="0")AND($retiro=="0"))//BUSQUEDA CON TODO VACIO
                    $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 ORDER BY C_Factura DESC";

                else if(($pago!="0")AND($forma=="0")AND($retiro!="0"))//BUSQUEDA POR METODO DE PAGO Y DE RETIRO
                    $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Modalidad='$pago' ORDER BY C_Factura DESC";

                else if(($pago!="0")AND($forma=="0")AND($retiro=="0"))//BUSQUEDA POR METODO DE PAGO
                    $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Modalidad='$pago' ORDER BY C_Factura DESC";
              
                else if(($pago=="0")AND($forma=="0")AND($retiro!="0"))//BUSQUEDA POR METODO DE RETIRO
                    $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' ORDER BY C_Factura DESC";
              
                else if(($pago=="0")AND($forma!="0")AND($retiro=="0")){//BUSQUEDA POR MONTOS
                    if($forma=="entre")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Monto BETWEEN $monto1 AND $monto2 ORDER BY C_Factura DESC";
                    else if($forma=="mayor")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Monto>=$monto1 ORDER BY C_Factura DESC";
                    else
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Monto<=$monto1 ORDER BY C_Factura DESC";
                }

                else if(($pago!="0")AND($forma!="0")AND($retiro=="0")){//BUSQUEDA POR MONTOS Y DE METODO DE PAGO
                    if($forma=="entre")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Modalidad='$pago' AND Monto BETWEEN $monto1 AND $monto2 ORDER BY C_Factura DESC";
                    else if($forma=="mayor")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Modalidad='$pago' AND Monto>=$monto1 ORDER BY C_Factura DESC";
                    else
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Modalidad='$pago' AND Monto<=$monto1 ORDER BY C_Factura DESC";
                }

                else if(($pago=="0")AND($forma!="0")AND($retiro!="0")){//BUSQUEDA POR MONTOS Y DE METODO DE RETIRO
                    if($forma=="entre")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Monto BETWEEN $monto1 AND $monto2 ORDER BY C_Factura DESC";
                    else if($forma=="mayor")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Monto>=$monto1 ORDER BY C_Factura DESC";
                    else
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Monto<=$monto1 ORDER BY C_Factura DESC";
                }

                else if(($pago!="0")AND($forma!="0")AND($retiro!="0")){//BUSQUEDA USANDO TODOS LOS FILTROS
                    if($forma=="entre")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Modalidad='$pago' AND Monto BETWEEN $monto1 AND $monto2 ORDER BY C_Factura DESC";
                    else if($forma=="mayor")
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Modalidad='$pago' AND Monto>=$monto1 ORDER BY C_Factura DESC";
                    else
                        $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 AND Cancelacion='$retiro' AND Modalidad='$pago' AND Monto<=$monto1 ORDER BY C_Factura DESC";
                }

                else //ALGUN ERROR LLEGA AQUI
                    $sql="SELECT * FROM FACTURA WHERE ID=$id AND ver=1 ORDER BY C_Factura DESC";
            }
            
            $total = $bdd->query($sql)->rowCount();
        break;
      
      case "eliminado":
            require("../bin/connect.php");

            $codigo=$_POST["codigo"];
            $bdd->query("UPDATE FACTURA SET ver = 2 WHERE C_Factura='$codigo'");
            echo 1;
        break;
    }
    
?>