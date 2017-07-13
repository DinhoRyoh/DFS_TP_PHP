<?php
  session_start();
  $_SESSION[$_REQUEST["title"]]=true;
  if ($_REQUEST["from"] == "product") {
    header('Location: /product.php?id='.($_REQUEST["id"]));
  }elseif ($_REQUEST["from"] == "cart") {
    header('Location: /cart.php');
  }
 ?>
