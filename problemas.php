<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $problemas = $conexion->query("SELECT id, alias, nombre, tema, orden FROM problemas");
   foreach($problemas as &$problema){     // iterar por referencia: podemos modificar los problemas (o agregarles cosas) y los cambios permanecen
      $tags_problemas = $conexion->query("SELECT tag FROM tags_problema WHERE problema = ?", $problema['id']);
      foreach($tags_problemas as $tag){
         $problema['tags'][] = $tag["tag"];
      }
   }
   die(json_encode($problemas)); 
?>