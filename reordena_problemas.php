<?php
   require_once('base/db_access.php');
   require_once('base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
    
   if (isset($_POST['arr']) && isset($_POST['id_Tema'])) { 
      $arr = json_decode($_POST['arr'], true);
      $id_Tema = json_decode($_POST['id_Tema'], true);;
      for ($i = 0; $i < count($arr); ++$i) {  
         $conexion->query("UPDATE problemas SET orden = ?,tema = ? WHERE id = ?", $i, $id_Tema , $arr[$i]);
      }     
      die(true);     
   }
?>