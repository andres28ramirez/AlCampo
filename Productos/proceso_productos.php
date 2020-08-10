<?php
	
	require("../bin/connect.php");
	session_start();

	if(!isset($_POST["codigo"])){
		header("location:/AlCampo");
	}

	$codigo = $_POST["codigo"];
	$cantidad = $_POST["cantidad"];
	$id = $_POST["id"];
	
	//PARA VERIFICAR QUE NO SE HAYA INGRESADO ALGUN PRODUCTO DEL MISMO CODIGO ANTERIORMENTE
	$sql2 = "SELECT * FROM CARRITO WHERE ID = :id AND CODIGO = :codigo";
	$query2=$bdd->prepare($sql2);
	$query2->execute(array(":id"=>$id,":codigo"=>$codigo));
	$total = $query2->rowCount();

	if($total==0){
		$sql="INSERT INTO CARRITO (ID, CODIGO, CANTIDAD) VALUES (:id, :codigo, :cantidad)";
		$nuevo = 1;
	}
	else{
		$sql="UPDATE CARRITO SET CANTIDAD=CANTIDAD+:cantidad WHERE ID = :id AND CODIGO = :codigo";
		$nuevo = 2;
	}
	//EJECUTAMOS LA SENTENCIA QUE HAYAMOS ELEGIDO Y YA
	$query=$bdd->prepare($sql)->execute(array(":id"=>$id,":codigo"=>$codigo,":cantidad"=>$cantidad));

	//echo json_encode("Producto insertado correctamente Carrito");
	echo $nuevo;
?>