<?php

session_start();

if(!isset($_POST['login']) || empty($_POST['login']) ||
   !isset($_POST['pass']) || empty($_POST['pass']) ||
   !isset($_POST['email']) || empty($_POST['email'])
)
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

//$rezultat = @$polaczenie->query(

  if($rezultat = @$polaczenie->query("SELECT * FROM USERS WHERE user='" . $_POST['login'] . "' OR email='" . $_POST['email'] . "'")){
    $czy_istnieje = $rezultat->num_rows;
    if($czy_istnieje > 0)
      echo 'Login lub e-mail jest zajęty!';
    else{
      $haslo = md5($_POST['pass']);
      if($rezultat = @$polaczenie->query("INSERT INTO `USERS` (`id`, `user`, `pass`, `email`, `query`, `answer`, `auto_notifications`, `permission`) VALUES (NULL, '" . $_POST['login'] . "', '" . $haslo . "', '" . $_POST['email'] . "', 0, 0, true, 0);")){
        echo 'ok';
      }
    }
  }
	$polaczenie->close();
}

?>
