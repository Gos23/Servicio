<?php
   $contenido = file_get_contents('tags.json'); 
   $datos = json_decode($contenido, true); 
   
   foreach ($datos as $campo => $traduccion) {
      echo $campo, " ", $traduccion, "\n";
   }
?>