<?php
   require_once('../base/db_access.php');
   require_once('../base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   
   $tema = 3;                                                                       // puesto a mano, corresponde con "Cálculos aritméticos" de "Programación Estructurada";
   $filas = file('problemas.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);     // abrir el archivo (que creamos con un copy-paste de la página) y obtener todas sus filas
   
   foreach ($filas as $indice => $alias) {                                          // el orden en el que aparecen en el archivo es el orden a guardar en la base de datos
      $conexion->query('UPDATE problemas SET tema = ?, orden = ? WHERE alias = ?', $tema, $indice, $alias);
   }
?>