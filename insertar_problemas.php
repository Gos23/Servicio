<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $problemas = json_decode(file_get_contents('problemas.json'), true);
   
   foreach ($problemas as $problema) {
      $conexion->query("INSERT IGNORE INTO problemas (alias, nombre) VALUES (?, ?)", $problema['alias'], $problema['nombre']);
      $id_problema = $conexion->query("SELECT id FROM problemas WHERE alias = ? ", $problema['alias'])[0]['id'];
      foreach ($problema['tags'] as $tag){
         if (strpos($tag, 'problemTag') === 0) {    
            $id_tag = $conexion->query("SELECT id FROM tags WHERE clave = ?", $tag)[0]['id'];
            $conexion->query("INSERT IGNORE INTO tags_problema (problema, tag) VALUES (?, ?)", $id_problema, $id_tag);
         }    
      } 
   }
?>