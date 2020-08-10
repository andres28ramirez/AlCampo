<?php 
  if(isset($solicitud)){
    //PARA QUE NO INTERFIERA NI JODA NADA
    return;
  }

  require("../../bin/connect.php");

  //INSERTAR UN PRODUCTO
    if(!empty($_FILES['file']['type'])){
      $nom=$_POST["nom"];
      $cat=$_POST["cat"];
      $pre=$_POST["pre"];
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
            $destino=$_SERVER["DOCUMENT_ROOT"] . "/AlCampo/Alimentos_img/";
            move_uploaded_file($_FILES["file"]["tmp_name"],$destino . $name_imagen);
            $img="/AlCampo/Alimentos_img/" . $name_imagen;
            //INSERCION A LA TABLA NORMAL QUE MOSTRARA LOS PRODUCTOS EN LA INTERFAZ, CARRITO ETC...
            $sql="INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, IMAGEN) VALUES (:nom,:cat,:pre,:img)";
            $in_bdd=$bdd->prepare($sql);
            $in_bdd->execute(array(":nom"=>$nom,":cat"=>$cat,":pre"=>$pre, ":img"=>$img));

            //EXITO EN LA INSERCION DEL PRODUCTO
            echo 1;
          }else{
            //EXISTE UNA IMAGEN CON EL MISMO NOMBRE DE IMAGEN
            echo 2;
          }
        }else{
          //LA IMAGEN ES MUY GRANDE PARA LA BASE DE DATOS
          echo 3;
        }
      }else{
        //EL FORMATO DEL ARCHIVO ENVIADO NO PERTENCE A UNA IMAGEN
        echo 4;
      }
    }
  //FIN DE INSERTAR UN PRODUCTO
?>