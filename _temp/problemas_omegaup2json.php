<?php      
   if (count($argv) != 3) {
      die("Uso: {$argv[0]} usuario password\n");
   }

   date_default_timezone_set('America/Mexico_City');
   function curl_multiejecucion($maestro) {
      $activos = 0;
      do {
         curl_multi_exec($maestro, $activo);
      } while ($activo != 0);
   }
   
   $maestro = curl_multi_init( );
   $sesion = curl_share_init( );
   curl_share_setopt($sesion, CURLSHOPT_SHARE, CURL_LOCK_DATA_COOKIE);
   curl_share_setopt($sesion, CURLSHOPT_SHARE, CURL_LOCK_DATA_SSL_SESSION);
   
   $conexiones = [ ];
   for ($i = 0; $i < 10; ++$i) {
      $conexiones[$i] = curl_init( );
      curl_setopt($conexiones[$i], CURLOPT_SHARE, $sesion);
      curl_setopt($conexiones[$i], CURLOPT_RETURNTRANSFER, true); 
      curl_setopt($conexiones[$i], CURLOPT_SSLVERSION, 3);
      curl_setopt($conexiones[$i], CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($conexiones[$i], CURLOPT_COOKIEFILE, '');
      curl_setopt($conexiones[$i], CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
   }

   curl_setopt($conexiones[0], CURLOPT_URL, 'https://omegaup.com/api/user/login/');
   curl_setopt($conexiones[0], CURLOPT_POST, true);
   curl_setopt($conexiones[0], CURLOPT_POSTFIELDS, [ 'usernameOrEmail' => $argv[1], 'password' => $argv[2] ]);
   curl_exec($conexiones[0]);

   $res = [ ];
   for ($i = 1; ; ++$i) {
      curl_setopt($conexiones[0], CURLOPT_URL, 'https://omegaup.com/api/problem/adminList/');
      curl_setopt($conexiones[0], CURLOPT_POST, true);
      curl_setopt($conexiones[0], CURLOPT_POSTFIELDS, [ 'page' => $i ]);
      $problemas = json_decode(curl_exec($conexiones[0]), true)['problems'];
      if (empty($problemas)) {
         break;
      }
      
      foreach ($problemas as $problema) {
         $actual = [ 'alias' => $problema['alias'], 'nombre' => $problema['title'], 'tags' => [ ] ];
         foreach ($problema['tags'] as $tag) {
            if ($tag['source'] != 'voted') {
               $actual['tags'][] = $tag['name'];
            }
         }
         $res[] = $actual;
      }
   }
   
   die(file_put_contents('problemas.json', json_encode($res, true)));
?>