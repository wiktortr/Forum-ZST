<?php

session_start();

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{
  
    if(isset($_GET['nick']) && !empty($_GET['nick'])){
        if ($rezultat = @$polaczenie->query("SELECT * FROM USERS WHERE user='" . $_GET['nick'] . "'")){
            $ilu_userow = $rezultat->num_rows;
            if($ilu_userow>0){
                $row = $rezultat->fetch_assoc();
                echo '<span>Pytania: ' . $row['query'] . '</span>';
                echo '<span>Odpowiedzi: ' . $row['answer'] . '</span>';
            }
        }
    }
    else{
        if($_SESSION['login'] == true){
            if ($rezultat = @$polaczenie->query("SELECT * FROM USERS WHERE id=" . $_SESSION['id'])){
                $ilu_userow = $rezultat->num_rows;
                if($ilu_userow>0){
                    $row = $rezultat->fetch_assoc();
                    echo '<span>Pytania: ' . $row['query'] . '</span>';
                    echo '<span>Odpowiedzi: ' . $row['answer'] . '</span>';
                }
            }
        }
    }

	$polaczenie->close();
}

?>
