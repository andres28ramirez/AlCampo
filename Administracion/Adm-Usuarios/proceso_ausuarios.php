<?php 
  if(isset($solicitud)){
    //PARA QUE NO INTERFIERA NI JODA NADA
    return;
  }

  require("../../bin/connect.php");

  //HABILITAR LOS PRIVILEGIOS DE OPERADOR A UN USUARIO
  if (isset($_POST["convertir"])){
    session_start();
    if ($_SESSION["tipo"]==0) {
      $id=$_POST["id"];
      $bdd->query("UPDATE USUARIO SET Tipo_Usuario=1 WHERE id=$id");
      //OPERACION REALIZADA CON EXITO
      echo 1;
    }else{
      //EL ADMINISTRADOR TIENE EL NIVEL DE OPERADOR Y NO POSEE LOS PERMISOS PARA REALIZAR ESTA OPERAICON
      echo 2;
    }
  }

  //QUITAR LOS PRIVILEGIOS DE OPERADOR AL USUARIO
  if (isset($_POST["quitar"])){
    session_start();
    if ($_SESSION["tipo"]==0) {
      $id=$_POST["id"];
      $bdd->query("UPDATE USUARIO SET Tipo_Usuario=2 WHERE id=$id");
      //OPERACION REALIZADA CON EXITO
      echo 1;
    }else{
      //EL ADMINISTRADOR TIENE EL NIVEL DE OPERADOR Y NO POSEE LOS PERMISOS PARA REALIZAR ESTA OPERAICON
      echo 2;
    }
  }

  //ELIMINAR UN USUARIO
  if (isset($_POST["borrar"])){
    $ci = $_POST["cedula"];
    $fila=$bdd->prepare("DELETE FROM dato_usuario where Ci=$ci");
    $fila->execute();
    //OPERACION REALIZADA CON EXITO
    echo 1;
  }
?>