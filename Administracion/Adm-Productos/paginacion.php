<?php  
	require("../../bin/connect.php");

	$filas=10;
	$pagina=1;
	if(isset($_GET["pagina"])){
		if ($_GET["pagina"]!=1) {
			$pagina=$_GET["pagina"];
		}elseif ($_GET["pagina"]<=1) {
			$pagina=1;
		}
	}

	if (isset($_GET["busqueda"])) {
		$busqueda=$_GET["busqueda"];
		$empezar=($pagina-1)*$filas;
		if (isset($_GET["categoria"])) {
			////////busqueda por categoria
			$sql="SELECT * FROM productos WHERE categoria LIKE :busqueda";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM productos WHERE categoria LIKE :busqueda LIMIT $empezar, $filas";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$registro=$query->fetchAll(PDO::FETCH_OBJ);
			$query->closeCursor();
			if (isset($_GET["ajax"])) {
				$registro=(array)$registro;
				$registro[]=$bdd_filas;
				$registro[]=$busqueda;
				$registro[]=$pagina;
				$registro[]=$pgn_total;
				echo json_encode($registro);
			}
		}else if (isset($_GET["nombre"])){
			////////busqueda por nombre
			$sql="SELECT * FROM productos WHERE nombre LIKE :busqueda";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM productos WHERE nombre LIKE :busqueda LIMIT $empezar, $filas";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$registro=$query->fetchAll(PDO::FETCH_OBJ);
			$query->closeCursor();
			if (isset($_GET["ajax"])) {
				$registro=(array)$registro;
				$registro[]=$bdd_filas;
				$registro[]=$busqueda;
				$registro[]=$pagina;
				$registro[]=$pgn_total;
				echo json_encode($registro);
			}
		}else if (isset($_GET["codigo"])){
			////////busqueda por codigo
			$sql="SELECT * FROM productos WHERE codigo LIKE :busqueda";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM productos WHERE codigo LIKE :busqueda LIMIT $empezar, $filas";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$registro=$query->fetchAll(PDO::FETCH_OBJ);
			$query->closeCursor();
			if (isset($_GET["ajax"])) {
				$registro=(array)$registro;
				$registro[]=$bdd_filas;
				$registro[]=$busqueda;
				$registro[]=$pagina;
				$registro[]=$pgn_total;
				echo json_encode($registro);
			}
		}
		else{
			//CASO EN EL CUAL ALTEREN LA BARRA DE ARRIBA Y PUES NO LLEGA A NADA SEGUN EL FILTRO DADO
			$empezar=($pagina-1)*$filas;
			$sql="SELECT * FROM productos";
			$query=$bdd->query($sql);
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM PRODUCTOS LIMIT $empezar, $filas";
			$query=$bdd->query($sql);
			$registro=$query->fetchAll(PDO::FETCH_OBJ);
			$query->closeCursor();
		}
	}else{
		$empezar=($pagina-1)*$filas;
		$sql="SELECT * FROM productos";
		$query=$bdd->query($sql);
		$bdd_filas=$query->rowCount();
		$pgn_total=ceil($bdd_filas/$filas);
		$query->closeCursor();
		$sql="SELECT * FROM PRODUCTOS LIMIT $empezar, $filas";
		$query=$bdd->query($sql);
		$registro=$query->fetchAll(PDO::FETCH_OBJ);
		$query->closeCursor();
	}
?>