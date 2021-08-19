<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $temas = $conexion->query("SELECT id, nombre, uea, orden FROM temas ORDER BY orden");
   die(json_encode($temas)); 
?>
