<?php 
	
	include("../bin/connect.php");

	if(isset($_POST["btnsubmit"])){
		switch ($_POST["solicitud"]) {
			case "login":
				$id = $_POST["id"];
				$correo = $_POST["correo"];
				$contraseña = $_POST["contraseña"];

				$sql="SELECT * FROM USUARIO INNER JOIN DATO_USUARIO ON USUARIO.ID=DATO_USUARIO.ID WHERE CORREO=:correo";
				$consulta=$bdd->prepare($sql);
				$consulta->bindValue(":correo",$correo);
				$consulta->execute();
				$comprobar=$consulta->rowCount();

				if($comprobar!=0){
					$tabla=$consulta->fetch(PDO::FETCH_ASSOC);
					if(password_verify($contraseña, $tabla["Pass"])){
						session_start();
						$_SESSION["usuario"]=$tabla["Nombre"]." ".$tabla["Apellido"];
						$_SESSION["id"]=$tabla["ID"];
						$_SESSION["tipo"]=$tabla["Tipo_Usuario"];
						$_SESSION["pass"]=$tabla["Pass"];

						//GRABAR O ACTUALIZAR EN CASO DE HAYA GUARDADO ALGO EN EL CARRITO CON SU NUEVO ID
						$id2 = $tabla["ID"];
						$sql = "SELECT * FROM CARRITO WHERE id=$id";
						$bdd->query($sql);
						$contador=$consulta->rowCount();
						if($contador!=0){
							$sql = "UPDATE CARRITO SET ID='$id2' WHERE ID='$id'";
							$bdd->query($sql);
						}
						//TODO CON EXITO
						if ($_SESSION["tipo"]!=2)
							//ES ADMINISTRAR O OPERADOR Y LO REDIRECCIONO DE UNA A LA PARTE DE ADMINISTRACION
							echo 4;
						else
							//ES USUARIO NORMAL Y LO REDIRECCIONO AL INICIO
							echo 1;
					}else{
						//CONTRASEÑA INCORRECTA
						echo 2;
					}
				}else{
					//USUARIO INEXISTENTE
					echo 3;
				}

				break;

			case "registro":
				$nombre=$_POST["nombre"];
				$email=$_POST["email"];
				$apellido=$_POST["apellido"];
				$direccion=$_POST["direccion"];
				$ciudad=$_POST["municipio"];
				$pass=$_POST["contraseña"];
				$ci=$_POST["cedula"];

				$q_verificar1="SELECT * FROM USUARIO WHERE CORREO= :correo";
				$q_verificar2="SELECT * FROM DATO_USUARIO WHERE CI= :ci";
				$verificar1=$bdd->prepare($q_verificar1);
				$verificar2=$bdd->prepare($q_verificar2);
				$verificar1->execute(array(":correo"=>$email));
				$verificar2->execute(array(":ci"=>$ci));

				if($verificar1->rowCount()>0){
					//CORREO YA SE ENCUENTRA AFILIADO A UN USUSARIO
					echo 1;
				}else{
					if($verificar2->rowCount()>0){
						//LA CEDULA YA SE ENCUENTRA AFILIADA A UN USUARIO
						echo 2;
					}else{

						$pass=password_hash($pass, PASSWORD_DEFAULT);
						$q_insertar1="INSERT INTO USUARIO (CORREO, PASS) VALUES (:correo, :pass)";
						$q_insertar2="INSERT INTO DATO_USUARIO (NOMBRE, APELLIDO, CI, DIRECCION, CIUDAD) VALUES (:nombre, :apellido, :ci, :direccion, :ciudad)";
						$usuario=$bdd->prepare($q_insertar1);
						$datos=$bdd->prepare($q_insertar2);
						$usuario->execute(array(":correo"=>$email, ":pass"=>$pass));
						$datos->execute(array(":nombre"=>$nombre, ":apellido"=>$apellido, ":ci"=>$ci, ":direccion"=>$direccion, ":ciudad"=>$ciudad));

						//REGISTRO EFECTUADO CON EXITO
						echo 3;
					}
				}
				break;
			
			case "m_correo":
				session_start();
				$id = $_POST["codigo"];
				$correo = $_POST["correo1"];
				if(password_verify($_POST["contra"],$_SESSION["pass"])) {
		    		//CONFIRMAR QUE NO ACTUALIZE A UN CORREO YA EXISTENTE
		    		$sql="SELECT * FROM USUARIO WHERE CORREO= :correo";
		    		$verificar=$bdd->prepare($sql);
		    		$verificar->execute(array(":correo"=>$correo));
		    		if($verificar->rowCount()>0){ //SI HAY PUES LANZO EL ERROR CORREO DUPLICADO
		    			echo 1;
		    		}
		    		else{ //SI NO HAY LANZO LA ACTUALIZACIÓN
		    			$bdd->query("CALL actualizar('Correo','$correo',$id)");
		    			echo 2;
		    		}
		    	}
		    	else{
		    		//SI LA CONTRASEÑA ES ERRORNEA
		    		echo 3;
		    	}

				break;

			case "m_contraseña":
				session_start();
				$id = $_POST["codigo"];
				if(password_verify($_POST["contra"],$_SESSION["pass"])){
		    		$pass = password_hash($_POST["pass1"], PASSWORD_DEFAULT);
		        	$_SESSION["pass"] = $pass;
		    		$bdd->query("CALL actualizar('Pass','$pass',$id)");
		    		//SI TODO FUE CON EXITO Y GRABO LA NUEVA CONTRASEÑA
		    		echo 1;
			    }
			    else{
			      //SI LA CONTRASEÑA ES ERRONEA
			      echo 2;
			    }

				break;

			case "m_nombre":
				session_start();
				$id = $_POST["codigo"];
				$nombre = $_POST["nombre"];
				$apellido = $_POST["apellido"];
				$_SESSION["usuario"] = $nombre." ".$apellido;
				$bdd->query("CALL actualizar('Nombre','$nombre',$id)");
				echo 1;
				break;

			case "m_apellido":
				session_start();
				$id = $_POST["codigo"];
				$nombre = $_POST["nombre"];
				$apellido = $_POST["apellido"];
				$_SESSION["usuario"] = $nombre." ".$apellido;
				$bdd->query("CALL actualizar('Apellido','$apellido',$id)");
				echo 1;
				break;

			case "m_municipio":
				session_start();
				$id = $_POST["codigo"];
				$ciudad = $_POST["ciudad"];
				$bdd->query("CALL actualizar('Ciudad','$ciudad',$id)");
				echo 1;
				break;

			case "m_direccion":
				session_start();
				$id = $_POST["codigo"];
				$direccion = $_POST["direccion"];
				$bdd->query("CALL actualizar('Direccion','$direccion',$id)");
				echo 1;
				break;
		}
	}

	//TOMAR LOS DATOS DE LA SESION ACTUAL
	if (isset($proceso_configuracion)) {
		$sql1="SELECT * FROM USUARIO WHERE ID=:id";

		$sql2="SELECT * FROM DATO_USUARIO WHERE ID=:id";

		$consulta1=$bdd->prepare($sql1);

		$consulta2=$bdd->prepare($sql2);

		$consulta1->execute(array(":id"=>$_SESSION["id"]));

		$consulta2->execute(array(":id"=>$_SESSION["id"]));

		$registro1=$consulta1->fetch(PDO::FETCH_ASSOC);

		$registro2=$consulta2->fetch(PDO::FETCH_ASSOC);
	}
?>