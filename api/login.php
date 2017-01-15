<?php

session_start();

if(!isset($_POST['user']) && !isset($_POST['pass']))
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{
	$login = $_POST['user'];
	$haslo = md5($_POST['pass']);

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	///$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

	if ($rezultat = @$polaczenie->query(
	sprintf("SELECT * FROM USERS WHERE user='%s' AND pass='%s'",
	mysqli_real_escape_string($polaczenie,$login),
	mysqli_real_escape_string($polaczenie,$haslo)))){
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0){
			$_SESSION['login'] = true;

			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['id'] = $wiersz['id'];
			$_SESSION['user'] = $wiersz['user'];
			$_SESSION['email'] = $wiersz['email'];
            $_SESSION['perm'] = $wiersz['permission'];

            $now = getdate();
            $date = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $now['minutes'] . ":" . $now['seconds'];
            if($rezultat2 = @$polaczenie->query("INSERT INTO `LOG` (`id`, `user`, `ip`, `agent`, `date`) VALUES (NULL, '" . $wiersz['user'] . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $_SERVER['HTTP_USER_AGENT'] . "', '" . $date . "')")){}

      echo "true";
		}
    else
      echo "false";
	}

	$polaczenie->close();
}

?>
