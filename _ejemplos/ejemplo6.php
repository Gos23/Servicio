<?php
   require_once('../db_access.php');
   require_once('../db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);

   // ejemplo de inserción
   $clave = "giovanniTag"; 
   $traduccion = "Giovanni";
   $conexion->query("INSERT INTO tags (clave, traduccion) VALUES (?, ?)", $clave, $traduccion);
   
   // ejemplo de selección
   $filas = $conexion->query("SELECT clave, traduccion FROM tags WHERE id != 5");
   foreach ($filas as $fila) {
      echo $fila['clave'], ' ', $fila['traduccion'], "\n";
   }
?>