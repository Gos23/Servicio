<?php
   $datos = [
      "nombre" => "juan",
      "edad" => 15
   ];
   
   die(json_encode($datos));        // siempre que programemos un servicio para un cliente web, regresamos los datos como json
                                    // json es un formato que entiende javascript
?>