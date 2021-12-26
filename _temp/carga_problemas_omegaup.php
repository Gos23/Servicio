<?php
   require_once('../base/db_access.php');
   require_once('../base/db_auth.php');
   
   if (count($argv) != 3) {
      die("Uso: {$argv[0]} usuario password\n");
   }

   ini_set('memory_limit', '-1');
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
   $conexion = new db_access(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);  
   
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
   
   curl_setopt($conexiones[0], CURLOPT_URL, 'https://omegaup.com/login/?logout');
   curl_setopt($conexiones[0], CURLOPT_POST, true);
   curl_setopt($conexiones[0], CURLOPT_POSTFIELDS, [ 'user' => $argv[1], 'pass' => $argv[2], 'request' => 'login' ]);
   curl_exec($conexiones[0]);
   echo "Terminado el ingreso...\n";
   
   $usuarios = array_unique(file('usuarios_uam.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES));   
   $problemas = array_column($conexion->query('SELECT alias FROM problemas'), 'alias');
   foreach ($usuarios as $usuario) {
      curl_setopt($conexiones[0], CURLOPT_URL, 'https://omegaup.com/api/user/problemscreated');
      curl_setopt($conexiones[0], CURLOPT_POST, true);
      curl_setopt($conexiones[0], CURLOPT_POSTFIELDS, [ 'username' => $usuario ]);
      $problemas = array_merge($problemas, array_column(json_decode(curl_exec($conexiones[0]), true)['problems'], 'alias'));
      echo "Terminado el listado de problemas...\n";
   }
   $problemas = array_unique($problemas);
   
   $tema = $conexion->query('SELECT temas.id FROM temas, ueas WHERE temas.nombre = "Sin clasificación" AND ueas.nombre = "Otros cursos" AND temas.uea = ueas.id')[0]['id'];
   foreach (array_chunk($problemas, count($conexiones)) as $grupo) {
      $jsons = [ ];
      foreach ($grupo as $i => $alias) {
         if (file_exists("json_problemas/$alias.json")) {
            $jsons[$i] = json_decode(file_get_contents("json_problemas/$alias.json"), true);
         } else {
            echo "preparando markdown de {$alias}\n";
            curl_multi_add_handle($maestro, $conexiones[$i]);
            curl_setopt($conexiones[$i], CURLOPT_URL, "https://omegaup.com/api/problem/details/problem_alias/$alias");
         }
      }
      
      echo "\tEnviando peticiones de markdown...\n";
      curl_multiejecucion($maestro);
      echo "\tEnviadas...\n";
      
      foreach ($grupo as $i => $alias) {
         if (!isset($jsons[$i])) {
            $raw = curl_multi_getcontent($conexiones[$i]);
            curl_multi_remove_handle($maestro, $conexiones[$i]);
            file_put_contents("json_problemas/$alias.json", $raw);
            $jsons[$i] = json_decode($raw, true);
         }

         $conexion->query("INSERT INTO problemas (alias, nombre, tema, orden, autor, fuente) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE autor = ?, fuente = ?", 
            $alias, $jsons[$i]['title'], $tema, 0, $jsons[$i]['problemsetter']['username'], $jsons[$i]['source'], $jsons[$i]['problemsetter']['username'], $jsons[$i]['source']
         );
      }
   }
   
   $conexion->query('DELETE FROM problemas WHERE alias = ?', 'Transpuesta-1');
?>