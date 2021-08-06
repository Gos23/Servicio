<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $temas = $conexion->query("SELECT * FROM  temas");
   $datos_convertir = [];
   foreach($temas as $tema){
      $id = $tema["id"];
      $nombre = $tema["nombre"];
      $uea = $tema["uea"]; 
      $datos_convertir[] = ["id" => $id, "nombre" => $nombre, "uea" => $uea];
   }
   die(json_encode($datos_convertir,JSON_UNESCAPED_UNICODE)); 
?>
