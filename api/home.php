<?php

session_start();

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

  if ($rezultat = @$polaczenie->query("SELECT * FROM QUEST ORDER BY `QUEST`.`id` DESC")){
        if(isset($_GET['search']) && !empty($_GET['search']))
            echo '<div class="context-top">Szukana fraza: ' . $_GET['search'] . '</div>';
        else
		    echo '<div class="context-top">Najnowsze pytania i odpowiedzi</div>';
        while($row = $rezultat->fetch_assoc()) {
            
            if(isset($_GET['search']) && !empty($_GET['search'])){
                if(strpos(strtolower($row["title"]), strtolower($_GET['search'])) === false)
                    continue;
            }
       
            $kategorie = explode(";", $row["category"]);
            $kat_display = "";

            for ($i = 0; $i <= count($kategorie); $i++){
                if($i <> count($kategorie)) {
                    $kat_display = $kat_display . '<div><a href="#" class="btn">' . $kategorie[$i] . '</a></div>';
                }
            }

            echo('
                <div class="pyt-ico" title="' . $row["id"] . '">
                    <div class="pyt-data">
                      <div class="pyt-like">
                        <span class="pyt-like-up icon-thumbs-up"></span>
                        <span class="pyt-like-down icon-thumbs-down"></span>
                        <span class="pyt-like-span">' . $row["like"] . '</span>
                        <span class="pyt-like-text">polubienia</span>
                      </div>
                      <div class="pyt-odp">
                        <span class="pyt-odp-count">' . $row["answer"] . '</span>
                        <span class="pyt-like-text">odpowiedż</span>
                      </div>
                    </div>
                    <div class="pyt-data2">
                      <div class="pyt-name">' . $row["title"] . '</div>
                      <div class="pyt-kat">' . $kat_display . '</div>
                    </div>
                </div>
            ');
        }
	}

	$polaczenie->close();
}

?>
