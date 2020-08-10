<?php 
	require("../bin/connect.php");

	if(isset($_POST["solicitud"]))
		$solicitud = $_POST["solicitud"];

	switch ($solicitud) {
		case "imprimir":
				$sql="SELECT * FROM PRODUCTOS INNER JOIN CARRITO ON PRODUCTOS.CODIGO=CARRITO.CODIGO where ID=:id";

				$query=$bdd->prepare($sql);

				$query->execute(array(":id"=>$u_id));

				$contador = $query->rowCount();

				$monto = 0;
			break;
		
		case "eliminar-carrito":
				$id=$_POST['id'];
				$bdd->query("DELETE FROM CARRITO WHERE ID='$id'");
				echo 1;
			break;

		case "eliminar-producto":
				$codigo=$_POST["codigo"];
				$id=$_POST['id'];
				$bdd->query("DELETE FROM CARRITO WHERE CODIGO='$codigo' AND ID='$id'");
				echo 1;
			break;

		case "pagar-carrito":
				$bdd->beginTransaction();
				try{
					$id=$_POST["id"];
					$modalidad=$_POST["tipo_pago"];
					$cancelacion=$_POST["retiro"];
					$monto=$_POST["comprar"];
					$fecha=date("d-m-Y");

					$sql="INSERT INTO FACTURA (ID, MODALIDAD, MONTO, CANCELACION, FECHA) 
						VALUES (:id, :modalidad, :monto, :cancelacion, :fecha)";
					$query=$bdd->prepare($sql);
					$query->execute(array(":id"=>$id,":modalidad"=>$modalidad,":monto"=>$monto,":cancelacion"=>$cancelacion,":fecha"=>$fecha));

					////////////////TOMA DE CODIGO DE FACTURA ////////////////////
						$c_factura=$bdd->lastInsertId(); /// toma el id de la factura recien agregado
					///////////////FIN TOMA DE CODIGO FACTURA ////////////////////

					$sql2="SELECT * FROM CARRITO 
						INNER JOIN PRODUCTOS ON CARRITO.codigo = PRODUCTOS.codigo 
						WHERE ID=$id";

					foreach ($bdd->query($sql2) as $carrito) {
						$codigo=$carrito["Codigo"];
						$cantidad=$carrito["Cantidad"];
						$nombre=$carrito["Nombre"];
						$precio=$carrito["Precio"];
						$sql="INSERT INTO ORDEN (C_FACTURA, CODIGO, CANTIDAD, NOMBRE, PRECIO) VALUES (:c_factura, :codigo, :cantidad, :nombre, :precio)";
						$query=$bdd->prepare($sql);
						$query->execute(array(":c_factura"=>$c_factura,":codigo"=>$codigo,":cantidad"=>$cantidad,":nombre"=>$nombre,":precio"=>$precio));
					}

					$sql="DELETE FROM CARRITO WHERE ID='$id'";
					$bdd->query($sql);
					$bdd->commit();
					echo 1;
					//header("location:/AlCampo/Compras/compras.php?mensaje=1");
				}catch(PDOException $e){
					$bdd->rollBack();
					echo 2;
					//header("location:/CambiosDiGusti/car.php?mensaje=1");
				}
			break;

		case "actualizar-carrito":
				$codigo = $_POST["codigo"];
				$cantidad = $_POST["cantidad"];
				$id = $_POST['id'];
				$bdd->query("UPDATE CARRITO SET CANTIDAD='$cantidad' WHERE ID='$id' AND CODIGO = '$codigo'");
				echo 1;
			break;
	}
	
?>