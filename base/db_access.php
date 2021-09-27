<?php
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

   class db_access {
      private $handle;
      
      function __construct($host, $usuario, $password, $db) {
         $this->handle = new mysqli($host, $usuario, $password, $db);
         $this->handle->set_charset('utf8');
      }
      
      function escape($valor) {
         if ($valor === null) {
            return 'null';
         } else if (is_object($valor) || is_string($valor)) {
            return '"'.$this->handle->escape_string($valor).'"';
         } else if (is_bool($valor)) {
            return ($valor ? '1' : '0');
         } else if (is_int($valor) || is_float($valor)) {
            return $valor;
         }
      }
      
      function get_result($res) {
         return (is_object($res) ? $res->fetch_all(MYSQLI_ASSOC) : $res);
      }
      
      function query($query, ...$parametros) {
         $placeholders = [ ]; $offset = 0;
         while (($pos = strpos($query, '?', $offset)) !== false) {
            $placeholders[] = $pos;
            $offset = $pos + 1;
         }
         
         if (count($placeholders) == count($parametros)) {
            for ($i = count($placeholders) - 1; $i >= 0; --$i) {
               $query = substr_replace($query, $this->escape($parametros[$i]), $placeholders[$i], 1);
            }
            return $this->get_result($this->handle->query($query));
         }
      }
      
      function multi_query($query) {
         $res = [ ];
         if ($this->handle->multi_query($query)) {
            do {
               $res[] = $this->get_result($this->handle->store_result( ));
            } while ($this->handle->more_results( ) && $this->handle->next_result( ));
         }
         return $res;
      }
   }
?>