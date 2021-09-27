<?php
   $a = 5;                                // en PHP las variables inician con $ y no se declaran los tipos
   $a = 3.7;                              // una variable puede cambiar de tipo en cualquier momento
   $b = "gatito";
   $c = "hola $b";                   // es posible incrustar el valor de una variable dentro de una cadena
   echo $c, "\n";                         // para imprimir el valor de la variable (se pueden imprimir varias cosas si usas ,)
   var_dump($c);                          // para imprimir los detalles de la variable

   $d = [ 1, 2, 3, 4, 5 ];                // un arreglo se crea con [ ]
   for ($i = 0; $i < count($d); ++$i) {   // se puede usar el típico for de C para imprimir un arreglo; count regresa el tamaño del arreglo
      echo $d[$i], " ";
   }
   echo "\n";
   foreach ($d as $actual) {              // también hay el foreach para iterar directamente sobre los valores
      echo $actual, " ";
   }
   echo "\n";
   
   $e = [                                 // también es posible crear arreglos que sólo tienen algunas posiciones
      0 => 5,                             // las posiciones no escritas NO existen; el tamaño de $e será 3 porque sólo tiene 3 posiciones
      2 => 9,                             // es mala idea usar un for con este tipo de arreglos, pero el foreach funciona
      10 => -2
   ];
   foreach ($e as $actual) {
      echo $actual, " ";
   }
   echo "\n";
   foreach ($e as $indice => $actual) {   // también es posible capturar el índice en donde están los valores
      echo "$indice tiene $actual\n";
   }
   
   $f = [ ];
   $f[] = 1;                              // usando esta notación, se agregan elementos a un arreglo y reciben posiciones enteras consecutivas (como push_back de std::vector en C++)
   $f[] = 7;
   var_dump($f);
   
   $g = [                                 // los arreglos de PHP pueden tener posiciones no-numéricas
      "nombre" => "juan",                 // esto se parece más a un struct
      "apellido" => "perez",
      "edad" => 15
   ];
   echo $g["edad"], "\n";
   
   $h = [ ];
   $h["gatito"] = "michi";                // es posible inaugurar nuevos elementos de un arreglo en cualquier momento
   var_dump($h);

   if (isset($h["gatito"])) {             // es posible preguntar si una entrada del arreglo existe o no
      echo "Existe el índice gatito en h\n";
   } else {
      echo "No existe el índice gatito en h\n";
   }
   
   unset($h["gatito"]);                   // puedes borrar índices de un arreglo
   
   function f($n) {                       // fibonacci en PHP, funcionan también las expresiones ternarias
      return ($n <= 1 ? $n : f($n - 1) + f($n - 2));
   }
   echo f(20), "\n";
   
   die("adios");                          // die imprime pero también termina el programa
   echo "esto ya no se imprimirá";
?>