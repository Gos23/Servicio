<?php
   $contenido = file_get_contents('../problemas.json');        // leer el archivo completo y guardalo en una cadena
   $datos = json_decode($contenido, true);                  // procesar el contenido leído (que es json) y convertirlo en variable
                                                            // el json de "tags.json" es un objeto grandote que se vuelve un arreglo asociativo de PHP
   
   foreach ($datos as $campo => $traduccion) {
      echo $campo, " ", $traduccion, "\n";
   }
?>