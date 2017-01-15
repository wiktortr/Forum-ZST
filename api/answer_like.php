<?php

session_start();

if(!isset($_GET['id']) ||
   !isset($_GET['like']) ||
   !isset($_SESSION['login']) || $_SESSION['login'] == false
)
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

    if($rezultat = @$polaczenie->query("SELECT * FROM `LIKE`")){
        $like = 0;
        while($row = $rezultat->fetch_assoc()){
            if($row['id_answer'] == $_GET['id']){
                if($row['user'] == $_SESSION['user'])
                    exit;
                if($row['like'] == true)
                    $like = $like + 1;
                if($row['like'] == false)
                    $like = $like - 1;
            }
        }

        if($_GET['like'] == "+")
            $like = $like + 1;
        else
            $like = (int)$like - 1;


        if($_GET['like'] == "+"){
            if($rezultat2 = @$polaczenie->query("INSERT INTO `LIKE` (`id`, `id_answer`, `user`, `like`) VALUES (NULL, '" . $_GET['id'] . "', '" . $_SESSION['user'] . "', true);")){
                
            }
        }

        if($_GET['like'] == "-"){
            if($rezultat2 = @$polaczenie->query("INSERT INTO `LIKE` (`id`, `id_answer`, `user`, `like`) VALUES (NULL, '" . $_GET['id'] . "', '" . $_SESSION['user'] . "', false);")){
            
            }
        }

        if($rezultat2 = @$polaczenie->query("UPDATE `ANSWER` SET `like` = '" . $like . "' WHERE `ANSWER`.`id` = " . $_GET['id'])){
            if($rezultat3 = @$polaczenie->query("SELECT * FROM `ANSWER` WHERE id = '" . $_GET['id'] . "'")){
                $id_quest = $rezultat3->fetch_assoc()['id_quest'];
                if($rezultat4 = @$polaczenie->query("SELECT * FROM `ANSWER` WHERE id_quest = '" . $id_quest . "'")){
                    $x = 0;  
                    while($row2 = $rezultat4->fetch_assoc()){
                        $x = $x + $row2['like'];
                    }
                    if($rezultat4 = @$polaczenie->query("UPDATE `QUEST` SET `like` = '" . $x . "' WHERE `QUEST`.`id` = " . $id_quest)){
                        echo 'ok';
                    }
                }
            }
        }

    }

    $polaczenie->close();
}

?>
