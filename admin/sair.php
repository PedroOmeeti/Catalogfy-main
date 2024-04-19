<?php

  // remove all session variables
  session_unset(); 
  // Removendo a sessão:
  session_destroy();
  $_SESSION['usuario'] = $resultado[0];

  session_write_close();
  setcookie(session_name(),'',0,'/');
  session_regenerate_id(true);
  // Redirecionar pro index.php (página do usuário):
  header("Location: index.php");
  die();



?>