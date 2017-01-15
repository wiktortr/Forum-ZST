<?php

session_start();
if($_SESSION['login'] == true)
    echo $_SESSION['user'];

?>