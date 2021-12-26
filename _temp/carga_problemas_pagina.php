<?php
   require_once('../base/db_access.php');
   require_once('../base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   
   function obten_nombre($alias, $conexion) {
      $res = $conexion->query('SELECT nombre FROM problemas WHERE alias = ?', $alias);
      if (count($res) == 1) {
         return $res[0]['nombre'];
      } else {
         echo "Nombre no encontrado para $alias\n";
         preg_match('/"title":("(.+?)")/', file_get_contents("https://omegaup.com/arena/problem/$alias"), $matches);
         return json_decode($matches[1]);
      }
   }
   
   $tema = null; $orden = null;
   foreach (file('problemas_pagina.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $fila) {
      if (preg_match('#omegaup.com/arena/problem/((\w|-)+)#', $fila, $matches)) {
         $alias = $matches[1]; $nombre = obten_nombre($alias, $conexion);
         if ($tema == null) {
            echo "ERROR: no hay tema para {$alias}\n";
         } else {
            $conexion->query('INSERT INTO problemas (alias, nombre, tema, orden) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE nombre = ?, tema = ?, orden = ?', $alias, $nombre, $tema, $orden, $nombre, $tema, $orden);
            $orden += 1;
         }
      } else {
         $res = $conexion->query('SELECT id FROM temas WHERE nombre = ?', $fila);
         if (count($res) == 1) {
            $tema = $res[0]['id'];
            $orden = 0;
            continue;
         }
         
         $res = $conexion->query('SELECT id FROM ueas WHERE nombre = ?', $fila);
         if (count($res) == 1) {
            $res = $conexion->query('SELECT temas.id AS id FROM temas, ueas WHERE temas.uea = ueas.id AND temas.nombre = "Sin clasificación" AND ueas.nombre = ?', $fila);
            if (count($res) == 1) {
               $tema = $res[0]['id'];
               $orden = 0;
               continue;
            }
         }
         
         echo "ERROR: busqueda fallida para $fila\n";
      }
   }
   
   $conexion->query('DELETE FROM problemas WHERE alias = ?', 'Sumatoria-de-sumatorias-duplicad');
   $conexion->query('DELETE FROM problemas WHERE alias = ?', 'Removiendo-archivos-duplicados');   
?>