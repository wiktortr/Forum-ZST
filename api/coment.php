<?php

session_start();

if(!isset($_GET['id_pyt']) ||
   !isset($_GET['coment']) || empty($_GET['coment']) ||
   !isset($_SESSION['login']) || $_SESSION['login'] == false
)
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{
    
    $now = getdate();
    if ($rezultat = @$polaczenie->query("INSERT INTO `ANSWER` (`id`, `id_quest`, `user`, `answer`, `date`) VALUES (NULL, '" . $_GET['id_pyt'] . "', '" . $_SESSION['user'] . "', '" . coment_encode($_GET['coment']) . "', '" . $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . "');")){
        if ($rezultat2 = @$polaczenie->query("SELECT * FROM ANSWER WHERE id_quest=" . $_GET['id_pyt'])){
            $x = 0;
            while($row = $rezultat2->fetch_assoc()){
                $x = $x + 1;
            }
            if ($rezultat2 = @$polaczenie->query("UPDATE `QUEST` SET `answer` = '" . $x . "' WHERE `QUEST`.`id` = " . $_GET['id_pyt'])){
                if ($rezultat3 = @$polaczenie->query("SELECT answer FROM `USERS` WHERE user='" . $_SESSION['user'] . "'")){
                    $y = $rezultat3->fetch_assoc()['answer'] + 1;
                    if ($rezultat4 = @$polaczenie->query("UPDATE `USERS` SET `answer` = '" . $y . "'  WHERE user='" . $_SESSION['user'] . "'")){
                        echo 'ok';
                    }
                }
            }
        }    
    }

	$polaczenie->close();
}

?>
