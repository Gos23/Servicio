<?php
   require_once('base/db_access.php');
   require_once('base/db_auth.php');
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
    
   if (isset($_POST['arr'])) { 
      $arr = json_decode($_POST['arr'], true);
      for ($i = 0; $i < count($arr); ++$i) {  
         $conexion->query("UPDATE temas SET orden = ? WHERE id = ?", $i , $arr[$i]);
      }    
      die(true);     
   }
?>