<?php
   require_once('base/db_access.php');
   require_once('base/db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $tags = $conexion->query("SELECT id, clave, traduccion, orden FROM tags ORDER BY orden");
   die(json_encode($tags)); 
?>
