<?php 
	$filas=12;
	$pagina=1;
	if(isset($_GET["pagina"])){
		if ($_GET["pagina"]!=1) {
			$pagina=$_GET["pagina"];
		}elseif ($_GET["pagina"]<=1) {
			$pagina=1;
		}
	}

	/*DETALLE POR SI MODIFICAN LAS VARIABLES EN LA URL*/
	if(!isset($_GET["producto"])){
	    $producto = "...";
	}
	else{
		$producto = $_GET["producto"];
	}

	if (!isset($_GET["forma"])) { //BUSQUEDA CON LA BARRA DE BUSQUEDA DE LA BARRA HORIZONTAL
		$empezar=($pagina-1)*$filas;
		$sql="SELECT * FROM productos WHERE nombre like :busqueda";
		$query=$bdd->prepare($sql);
		$query->execute(array(":busqueda"=>"%".$producto."%"));
		$bdd_filas=$query->rowCount();
		$pgn_total=ceil($bdd_filas/$filas);
		$query->closeCursor();
		$sql="SELECT * FROM productos WHERE nombre LIKE :busqueda ORDER BY nombre LIMIT $empezar,$filas";
		$query=$bdd->prepare($sql);
		$query->execute(array(":busqueda"=>"%".$producto."%"));
		$productos=$query->fetchAll(PDO::FETCH_OBJ);
		$query->closeCursor();
	}else{ //BUSQUEDA NORMAL
		$empezar=($pagina-1)*$filas;
		$sql="SELECT * FROM $producto ORDER BY nombre";
		$query=$bdd->query($sql);
		$bdd_filas=$query->rowCount();
		$pgn_total=ceil($bdd_filas/$filas);
		$query->closeCursor();
		$sql="SELECT * FROM $producto ORDER BY NOMBRE LIMIT $empezar,$filas";
		$query=$bdd->query($sql);
		$productos=$query->fetchAll(PDO::FETCH_OBJ);
		$query->closeCursor();
	}

	/*SECCION PARA ACOMODAR LA INFORMACION DE LA PAGINACIONA*/
	$empezar++; /*para imprimir el numerito de la paginacion producto inicial*/
	$empezarf = $empezar+$filas-1; 
	if(!($empezarf<$bdd_filas)){
		$empezarf=$bdd_filas;
	}
?>