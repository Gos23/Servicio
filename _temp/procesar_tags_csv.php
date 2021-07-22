<?php      
   $arch = fopen('tags.csv', 'r');
   $fila = fgetcsv($arch);
   
   $res = [ ];
   while (($fila = fgetcsv($arch)) !== false) {
      $res[$fila[1]] = $fila[0];
   }
   file_put_contents('tags.json', json_encode($res));
?>