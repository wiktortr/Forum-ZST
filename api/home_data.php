<?php

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

//$rezultat = @$polaczenie->query(

    if($rezultat = @$polaczenie->query("SELECT * FROM QUEST")){
        $x = 0;
        while($row = $rezultat->fetch_assoc()){
            $x = $x + 1;
        }
        echo '<div class="nav-item zo" id="div-zap">
              <div><span>' . $x . '</span></div>
              <div><span>Zapytań</span></div>
            </div>';
    }

    if($rezultat = @$polaczenie->query("SELECT * FROM ANSWER")){
        $x = 0;
        while($row = $rezultat->fetch_assoc()){
            $x = $x + 1;
        }
        echo '<div class="nav-item zo" id="div-odp">
              <div><span>' . $x . '</span></div>
              <div><span>Odpowiedzi</span></div>
            </div>';
    }

	$polaczenie->close();
}

?>