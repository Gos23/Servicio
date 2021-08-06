<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $ueas = $conexion->query("SELECT * FROM  ueas");
   $datos_convertir = [];
   foreach($ueas as $uea){
      $id = $uea["id"];
      $nombre = $uea["nombre"];
      $datos_convertir[] = ["id" => $id, "nombre" => $nombre];
   }
   die(json_encode($datos_convertir,JSON_UNESCAPED_UNICODE)); 
?>
