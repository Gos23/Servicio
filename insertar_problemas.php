<?php
   require_once('db_access.php');
   require_once('db_auth.php');
   
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   $problemas = json_decode(file_get_contents('problemas.json'), true);
   
   foreach ($problemas as $problema) {
      $alias =  $problema['alias'];
      $nombre = $problema['nombre'];
      $conexion->query("INSERT IGNORE INTO problemas (alias, nombre) VALUES (?, ?)", $alias, $nombre);
   }
      
   foreach ($problemas as $pro) {
      $alias = $pro["alias"];
      $nombre = $pro["nombre"];
      $tags = $pro["tags"];
      $id_p = $conexion->query(" SELECT * FROM `problemas` WHERE `alias` LIKE ? ",$alias);
      $id_pro =  $id_p[0]["id"];
   
      foreach($tags as $tag){
         if(strpos($tag, 'problemTag') === 0){    
            //ignoro el tag 'problemTagSetsMultisets' ya que este no se encuentra el la BD
            if(strpos($tag, 'problemTagSetsMultisets') === 0){
       
            }else{
               $id_p1 = $conexion->query(" SELECT * FROM `tags` WHERE `clave` LIKE ? ",$tag);
               $id_tag =  $id_p1[0]['id'];
               $conexion->query("INSERT IGNORE INTO tags_problema (problema, tag) VALUES (?, ?)", $id_pro, $id_tag);
            }  
         }    
      } 
   }
?>