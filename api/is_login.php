<?php

session_start();
if(!isset($_SESSION['login'])){
    echo "false";
    exit;
}

if($_SESSION['login'] == false)
  echo "false";
else
  echo "true";

 ?>
