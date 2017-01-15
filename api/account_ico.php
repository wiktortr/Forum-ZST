<?php

session_start();

if(isset($_GET['nick']) && !empty($_GET['nick'])){

    $file = scandir("../res/ico");
    $ico = '<span class="icon-user"></span>';
    for ($i = 2; $i <= count($file)-1; $i++) {
        if(strpos($file[$i], $_GET['nick']) > -1)
            $ico = '<img src="res/ico/' . $file[$i] . '"></img>';
    }

    echo $ico;
}
else{
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){

        $file = scandir("../res/ico");
        $ico = '<span class="icon-user"></span>';
        for ($i = 2; $i <= count($file)-1; $i++) {
            if(strpos($file[$i], $_SESSION['user']) > -1)
                $ico = '<img src="res/ico/' . $file[$i] . '"></img>';
        }

        echo $ico;
    }
}

?>