<?php

session_start();

if(!isset($_GET['title']) ||
   !isset($_GET['quest']) ||
   !isset($_GET['kat']) ||
   !isset($_SESSION['login']) || $_SESSION['login'] == false
)
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

  $now = getdate();
  if ($rezultat2 = @$polaczenie->query("INSERT INTO `QUEST` (`id`, `like`, `answer`, `user`, `title`, `quest`, `category`, `lock`, `date`) VALUES (NULL, 0, 0, '" . $_SESSION['user'] . "', '" . htmlentities($_GET['title'], ENT_QUOTES, "UTF-8") . "', '" . coment_encode($_GET['quest']) . "', '" . $_GET['kat'] . "', 'flase', '" . $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . "');")){
    if($rezultat = @$polaczenie->query("SELECT * FROM QUEST WHERE user='" . $_SESSION['user'] ."' AND title='" . $_GET['title'] . "'")){
        $row = $rezultat->fetch_assoc();
        echo $row['id'];
    }
    if($rezultat3 = @$polaczenie->query("SELECT query FROM `USERS` WHERE user='" . $_SESSION['user'] . "'")){
        $y = $rezultat3->fetch_assoc()['query'] + 1;
        if ($rezultat4 = @$polaczenie->query("UPDATE `USERS` SET `query` = '" . $y . "'  WHERE user='" . $_SESSION['user'] . "'")){ }
    }
  }
  
    
	$polaczenie->close();
}

?>
