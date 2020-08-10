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
		if (isset($_GET["nombre"])){
			////////busqueda por nombre
			$sql="SELECT * FROM usuario 
				INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID 
				WHERE Tipo_Usuario !=0 AND nombre LIKE :busqueda";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM usuario 
				INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID 
				WHERE Tipo_Usuario !=0 AND nombre LIKE :busqueda LIMIT $empezar, $filas";
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
			$sql="SELECT * FROM usuario 
				INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID 
				WHERE Tipo_Usuario !=0 AND ci LIKE :busqueda";
			$query=$bdd->prepare($sql);
			$query->execute(array(":busqueda"=>"%".$busqueda."%"));
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM usuario 
				INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID 
				WHERE Tipo_Usuario !=0 AND ci LIKE :busqueda LIMIT $empezar, $filas";
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
			$sql="SELECT * FROM usuario WHERE Tipo_Usuario != 0";
			$query=$bdd->query($sql);
			$bdd_filas=$query->rowCount();
			$pgn_total=ceil($bdd_filas/$filas);
			$query->closeCursor();
			$sql="SELECT * FROM usuario INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID WHERE Tipo_Usuario !=0 LIMIT $empezar, $filas";
			$query=$bdd->query($sql);
			$registro=$query->fetchAll(PDO::FETCH_OBJ);
			$query->closeCursor();
		}
	}else{
		$empezar=($pagina-1)*$filas;
		$sql="SELECT * FROM usuario WHERE Tipo_Usuario != 0";
		$query=$bdd->query($sql);
		$bdd_filas=$query->rowCount();
		$pgn_total=ceil($bdd_filas/$filas);
		$query->closeCursor();
		$sql="SELECT * FROM usuario INNER JOIN dato_usuario ON usuario.ID= dato_usuario.ID WHERE Tipo_Usuario !=0 LIMIT $empezar, $filas";
		$query=$bdd->query($sql);
		$registro=$query->fetchAll(PDO::FETCH_OBJ);
		$query->closeCursor();
	}
?>