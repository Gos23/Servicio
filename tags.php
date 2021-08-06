<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $tags = $conexion->query("SELECT * FROM  tags");
   $datos_convertir = [];
   foreach($tags as $tag){
      $id = $tag["id"];
      $clave = $tag["clave"];
      $traduccion = $tag["traduccion"]; 
      $datos_convertir[] = ["id" => $id, "clave" => $clave, "traduccion" => $traduccion];
   }
   die(json_encode($datos_convertir,JSON_UNESCAPED_UNICODE)); 
?>
