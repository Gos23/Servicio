<?php
   require_once('../base/db_access.php');
   require_once('../base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   
   function mapea($arr, $clave) {
      return array_combine(array_column($arr, $clave), $arr);
   }
   
   function iconos($problema, $usuarios) {
      $iconos = [ ];
      if (isset($usuarios[$problema['autor']])) {
         $iconos[] = 'uam';
         if ($usuarios[$problema['autor']] >= 5) {
            $iconos[] = 'alumnos';
         }
         if (!str_contains(strtoupper($problema['fuente']), 'UAM') && 
             $problema['fuente'] != 'Propiedades de números capicúas' && 
             $problema['fuente'] != 'Luis Daniel Ramos López' && 
             $problema['fuente'] != 'danielramos' && 
             $problema['fuente'] != 'None' && 
             $problema['fuente'] != 'Boris Korotkevich') {
            $iconos[] = 'externo';
         }
      } else {
         $iconos[] = 'externo';
      }
      return $iconos;
   }
   
   $ueas = $conexion->query("SELECT id, nombre, orden FROM ueas ORDER BY orden");
   $temas = $conexion->query("SELECT id, nombre, uea, orden FROM temas ORDER BY orden"); 
   $problemas = $conexion->query("SELECT id, alias, nombre, autor, fuente, tema, orden FROM problemas ORDER BY orden");
   $ueas_por_id = mapea($ueas, 'id'); $temas_por_id = mapea($temas, 'id');
   $usuarios = array_flip(array_unique(file('usuarios_uam.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES)));  
   
   $res = [ ];
   foreach ($ueas as $uea) {
      $res[] = [ 'nombre' => $uea['nombre'], 'temas' => [ ] ];
   }
   foreach ($temas as $tema) {
      $res[$ueas_por_id[$tema['uea']]['orden']]['temas'][] = [ 'nombre' => $tema['nombre'], 'problemas' => [ ] ];
   }
   foreach ($problemas as $problema) {
      $res[$ueas_por_id[$temas_por_id[$problema['tema']]['uea']]['orden']]['temas'][$temas_por_id[$problema['tema']]['orden']]['problemas'][] = [ 
         'alias' => $problema['alias'], 
         'nombre' => $problema['nombre'],
         'iconos' => iconos($problema, $usuarios)
      ];
   }
   
   die(json_encode($res)); 
?>