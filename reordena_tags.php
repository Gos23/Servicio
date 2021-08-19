<?php
   if (isset($_POST['datos'])) {                   // verificamos que desde el navegador nos hayan mandado la variable llamada "datos"
      die(json_encode($_POST['datos'], true));     //    si sí, imprimirla y terminar
   }
?>