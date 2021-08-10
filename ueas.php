<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $ueas = $conexion->query("SELECT id, nombre FROM ueas");
   die(json_encode($ueas)); 
?>
