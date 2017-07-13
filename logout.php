<?php
if(isset($_COOKIE[session_name()])):
  setcookie(session_name(), '', time()-7000000, '/');
endif;
header('Location: index.php');

 ?>
