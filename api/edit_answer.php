<?php

session_start();

if(!isset($_GET['id_answer']) ||
   !isset($_GET['text']) ||
   !isset($_SESSION['login']) || $_SESSION['login'] == false
)
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{
    if($rezultat = @$polaczenie->query("UPDATE `ANSWER` SET `answer` = '" . coment_encode($_GET['text']) . "' WHERE `ANSWER`.`id` = '" . $_GET['id_answer'] . "' AND `ANSWER`.`user` = '" . $_SESSION['user'] . "'"))
        echo 'ok';
    $polaczenie->close();
}

?>