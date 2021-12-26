<?php
   require_once('../../base/db_access.php');
   require_once('../../base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   
   function mapea_unico($arr, $clave) {
      return array_combine(array_column($arr, $clave), $arr);
   }
   function mapea_repetido($arr, $clave) {
      $res = [ ];
      foreach ($arr as $actual) {
         $res[$actual[$clave]][] = $actual;
      }
      return $res;
   }
   
   $problemas = $conexion->query("SELECT id, alias FROM problemas");
   $tags = $conexion->query("SELECT id, clave FROM tags");
   $tags_problema = $conexion->query("SELECT tag, problema FROM tags_problema");
   $tags_por_id = mapea_unico($tags, 'id'); $tags_por_problema = mapea_repetido($tags_problema, 'problema');
    
   $res = [ ];
   foreach ($problemas as &$problema) {
      $tags = [ ];
      if (isset($tags_por_problema[$problema['id']])) {
         foreach ($tags_por_problema[$problema['id']] as $tag) {
            $tags[] = $tags_por_id[$tag['tag']]['clave'];
         }
      }
      $res[$problema['alias']] = $tags;
   }
   
   file_put_contents('db.json', json_encode($res));
?>