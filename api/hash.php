<?php

if(!isset($_GET['text']))
	exit;

require_once "config.php";

echo coment_encode($_GET['text'] . "");

?>