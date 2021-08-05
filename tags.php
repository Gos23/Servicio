<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $tags = $conexion->query("SELECT * FROM  tags");
   $datos_convertir = array();
   $i = 0;
   while($i < count($tags)) {
      $id = $tags[$i]["id"];
      $clave = $tags[$i]["clave"];
      $traduccion = $tags[$i]["traduccion"];
      //echo $id ," ", $clave, " ", $traduccion, "\n";  
   array_push($datos_convertir,array("id" => $id, "clave" => $clave, "traduccion" => $traduccion));
      $i = $i + 1;
   }

   echo json_encode($datos_convertir);  
?>
