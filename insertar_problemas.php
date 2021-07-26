<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
   
   $problemas = json_decode(file_get_contents('problemas.json'), true);
   
   foreach ($problemas as $problema) {
      $alias =  $problema['alias'];
      $nombre = $problema['nombre'];
      $conexion->query("INSERT INTO problemas (alias, nombre) VALUES (?, ?)", $alias, $nombre);
   }
?>