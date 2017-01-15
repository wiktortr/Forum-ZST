<?php

session_start();

if(!isset($_GET['id_pyt']) && empty($_GET['id_pyt']))
  exit;

require_once "config.php";

$polaczenie = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($polaczenie->connect_errno!=0)
	echo "Error: ".$polaczenie->connect_errno;
else{

    if ($rezultat = @$polaczenie->query("SELECT * FROM QUEST WHERE id=" . $_GET['id_pyt'])){
           $ilosc_odp = $rezultat->num_rows;
           if($ilosc_odp > 0){
                $row = $rezultat->fetch_assoc();
                $file = scandir("../res/ico");
                $ico = '<span class="icon-user"></span>';
                for ($i = 2; $i <= count($file)-1; $i++) {
                    if(strpos($file[$i], $row['user']) > -1)
                        $ico = '<img src="res/ico/' . $file[$i] . '"></img>';
                }

                $edit_q = "";
                //if(isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['user'] == $row['user'])
                //    $edit_q = '<div class="query-edit" title="' . $_GET['id_pyt'] . '"><span class="icon-pencil"></span></div>';

                echo '
                <div class="context-top">' . $row['title'] . '</div>
                <div class="zapytanie">
                  <div class="zap-title"><span class="icon-lock-open"></span>' . $row['title'] . '</div>
                  <div class="zap-data-div">
                      <div class="zap-data zd-head">
                        <div class="zap-data-nick">' . $row['user'] . '</div>
                        <div class="zap-data-icon">' . $ico . '</div>
                      </div>
                      <div class="zap-data2">
                        <div class="zap-like"><span class="query-like">' . $row['like'] . '</span></div> ' . $edit_q . '
                    </div>
                  </div>
                  <div class="zap-text">' . $row['quest'] . '</div>
                </div>';
                if ($rezultat2 = @$polaczenie->query("SELECT * FROM ANSWER WHERE id_quest =" . $_GET['id_pyt'])){
                    $ilosc_odp2 = $rezultat2->num_rows;
                    if($ilosc_odp2 > 0){
                        while($row2 = $rezultat2->fetch_assoc()){
                            $edit = "";
                            if(isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['user'] == $row2['user'])
                                $edit = '<div class="zap-edit" title="' . $row2['id'] . '"><span class="icon-pencil"></span></div>';

                            $like = '<span class="icon-thumbs-up" title="' . $row2['id'] . '"></span><span class="answer-like">' . $row2['like'] . '</span><span class="icon-thumbs-down" title="' . $row2['id'] . '"></span>';
                            if(isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['user'] == $row2['user'])
                                $like = '<span class="answer-like" style="width: 100%;">' . $row2['like'] . '</span>';

                            if($row['user'] == $row2['user']){
                                echo '
                                <div class="odpowiedz">
                                    <div class="zap-data-div">
                                        <div class="zap-data zd-head">
                                            <div class="zap-data-nick">' . $row2['user'] . '</div>
                                            <div class="zap-data-icon">' . $ico . '</div>
                                        </div>
                                        <div class="zap-data2">
                                            <div class="zap-like">' . $like . '</div>
                                            ' . $edit . '
                                        </div>
                                    </div>
                                    <div class="zap-text">' . $row2['answer'] . '</div>
                                </div>';
                            }
                            else{
                                $ico2 = '<span class="icon-user"></span>';
                                for ($i = 2; $i <= count($file)-1; $i++) {
                                    if(strpos($file[$i], $row2['user']) > -1)
                                        $ico2 = '<img src="res/ico/' . $file[$i] . '"></img>';
                                }
                                echo '
                                <div class="odpowiedz">
                                    <div class="zap-data-div">
                                        <div class="zap-data">
                                            <div class="zap-data-nick">' . $row2['user'] . '</div>
                                            <div class="zap-data-icon">' . $ico2 . '</div>
                                        </div>
                                        <div class="zap-data2">
                                            <div class="zap-like">' . $like . '</div>
                                            ' . $edit . '
                                        </div>
                                    </div>
                                    <div class="zap-text">' . $row2['answer'] . '</div>
                                </div>';
                            }
                        }
                    }
                }
                if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                    $ico3 = '<span class="icon-user"></span>';
                    for ($i = 2; $i <= count($file)-1; $i++) {
                        if(strpos($file[$i], $_SESSION['user']) > -1)
                            $ico3 = '<img src="res/ico/' . $file[$i] . '"></img>';
                    }
                    if($_SESSION['user'] == $row['user']){
                        echo '
                        <div class="odpowiedz" id="soy">
                            <div class="zap-data-div">
                                <div class="zap-data zd-head">
                                    <div class="zap-data-nick">' . $_SESSION['user'] . '</div>
                                    <div class="zap-data-icon">' . $ico3 . '</div>
                                </div>
                            </div>
                            <div class="zap-text">
                                <textarea id="coment-in" rows="10" cols="50" placeholder="Skomentuj temat"></textarea>
                                <button class="btn btn-d" id="coment-btn">Skomentuj temat</button>
                            </div>
                        </div>
                        ';
                    }
                    else{
                        echo '
                        <div class="odpowiedz" id="soy">
                            <div class="zap-data-div">
                                <div class="zap-data">
                                    <div class="zap-data-nick">' . $_SESSION['user'] . '</div>
                                    <div class="zap-data-icon">' . $ico3 . '</div>
                                </div>
                            </div>
                            <div class="zap-text">
                                <textarea id="coment-in" rows="10" cols="50" placeholder="Skomentuj temat"></textarea>
                                <button class="btn btn-d" id="coment-btn">Skomentuj temat</button>
                            </div>
                        </div>
                    ';
                    }
                }
           }
    }

    $polaczenie->close();
}

?>
