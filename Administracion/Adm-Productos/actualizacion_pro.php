<?php 
  if(isset($solicitud)){
    //PARA QUE NO INTERFIERA NI JODA NADA
    return;
  }

  require("../../bin/connect.php");

  //ELIMINAR PRODUCTO
    if (isset($_GET["eliminar"])) {
      $codigo=$_GET["codigo"];
      //BORRO EL PRODUCTO EN TODOS LOS CARRITOS QUE ESTE PRESENTE
      $bdd->query("DELETE FROM CARRITO WHERE CODIGO='$codigo'");

      //RESCATO LA RUTA DE LA IMAGEN DEL PRODUCTO
      $query = $bdd->query("SELECT * FROM PRODUCTOS WHERE CODIGO=$codigo");
      $borrar=$query->fetch(PDO::FETCH_ASSOC);
      $destino = $_SERVER["DOCUMENT_ROOT"].$borrar["Imagen"];
      //BORRO LA IMAGEN DEL PRODUCTO
      unlink($destino);

      //FINALIZO CON BORRAR EL PRODUCTO EN LA BD
      $bdd->query("DELETE FROM PRODUCTOS WHERE CODIGO=$codigo");

      echo 1;
      return;
    }
  //FIN ELIMINAR PRODUCTO

  //ACTUALIZACION DEL PRODUCTO
    if(empty($_FILES['file']['type'])){
      //ACTUALIZACION SIN IMAGEN DE PRODUCTO
      $cod=$_POST["codigo"];
      $nom=$_POST["a_nombre"];
      $cat=$_POST["a_categoria"];
      $pre=$_POST["a_precio"];
      $sql="UPDATE PRODUCTOS SET NOMBRE=:n_nom, CATEGORIA=:n_cat, PRECIO=:n_pre WHERE Codigo=:id";
      $up_bdd=$bdd->prepare($sql);
      $up_bdd->execute(array(":n_nom"=>$nom,":n_cat"=>$cat,":n_pre"=>$pre,":id"=>$cod));
      
      //TODO EFECTUADO CON EXITO
      echo 1;  
    }
    else{
      //ACTUALIZACION CON IMAGEN DE PRODUCTO
      $cod=$_POST["codigo"];
      $nom=$_POST["a_nombre"];
      $cat=$_POST["a_categoria"];
      $pre=$_POST["a_precio"];
      $name_imagen=$_FILES['file']['name'];
      $size_imagen=$_FILES["file"]['size'];
      $type_imagen=$_FILES['file']['type'];
      if($type_imagen=="image/jpeg" || $type_imagen=="image/jpg" || $type_imagen=="image/png" || $type_imagen=="image/gif"){
        if($size_imagen<=4294967298){
          $sql="SELECT IMAGEN FROM PRODUCTOS WHERE IMAGEN=:img";
          $img="/AlCampo/Alimentos_img/" . $name_imagen;
          $query=$bdd->prepare($sql);
          $query->execute(array(":img"=>$img));
          if($query->rowCount()<1){
            $sqls="SELECT * FROM PRODUCTOS WHERE CODIGO=:cod";
            $query=$bdd->prepare($sqls);
            $query->execute(array(":cod"=>$cod));
            $borrar=$query->fetch(PDO::FETCH_ASSOC);
            $b_img=$_SERVER["DOCUMENT_ROOT"] . $borrar["Imagen"];
            unlink($b_img);
            $destino=$_SERVER["DOCUMENT_ROOT"] . "/AlCampo/Alimentos_img/";
            move_uploaded_file($_FILES["file"]["tmp_name"],$destino . $name_imagen);
            $img="/AlCampo/Alimentos_img/" . $name_imagen;
            $sqlu="UPDATE PRODUCTOS SET NOMBRE=:n_nom, CATEGORIA=:n_cat, PRECIO=:n_pre, IMAGEN=:img WHERE Codigo=:id";;
            $up_bdd=$bdd->prepare($sqlu);
            $up_bdd->execute(array(":n_nom"=>$nom,":n_cat"=>$cat,":n_pre"=>$pre, ":img"=>$img, ":id"=>$cod));
            
            //TODO EFECTUADO CON EXITO
            echo 1;
          }else{
            //IMAGEN DUPLICADA EN EL SERVIDOR
            echo 2;
          }
        }else{
          //IMAGEN MUY GRANDE PARA EL SERVIDOR
          echo 3;
        }
      }else{
        //EL ARCHIVO ENVIADO NO ES UNA IMAGEN
        echo 4;  
      }
    }
  //FIN DE ACTUALIZAR PRODUCTO 
?>