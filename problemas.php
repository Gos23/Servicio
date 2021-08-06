<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $problemas = $conexion->query("SELECT * FROM  problemas");
   
   $datos_convertir = [];
   foreach($problemas as $problema){
      $id = $problema["id"];
      $nombre = $problema["nombre"];
      $alias = $problema["alias"]; 
      
      $areglo_tags = [];
      $tags_problemas = $conexion->query(" SELECT * FROM `tags_problema` WHERE `problema` LIKE ? ",$id);
      foreach($tags_problemas as $tag){
         $areglo_tags[] = $tag["tag"];
      }
      
      $datos_convertir[] = ["id" => $id, "nombre" => $nombre, "alias" => $alias,"tags" => $areglo_tags ];
   }
   echo json_encode($datos_convertir,JSON_UNESCAPED_UNICODE); 
?>