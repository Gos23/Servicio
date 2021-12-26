<?php
   require_once('base/db_access.php');
   require_once('base/db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $problemas = $conexion->query("SELECT id, alias, nombre, tema, orden FROM problemas ORDER BY orden");
   foreach($problemas as &$problema){     // iterar por referencia: podemos modificar los problemas (o agregarles cosas) y los cambios permanecen
      $problema['tags'] = [ ];
      foreach ($conexion->query("SELECT tag FROM tags_problema, tags WHERE problema = ? AND tag = id ORDER BY orden", $problema['id']) as $tag){
         $problema['tags'][] = $tag["tag"];
      }
   }
   die(json_encode($problemas)); 
?>