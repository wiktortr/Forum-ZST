<?php

//dodac target="_blank" w git <a>

function coment_encode($text){
    $x = false;
    $y = "";
    $tmp = "";
    $code = false;
    for($i = 0; $i <= strlen($text)-1; $i++){
        if($text[$i] == "<" && $text[$i+1] != "?" && $x == false && $code == false){
            $x = true;
            $y = "<";
            if($text[$i+1] == "c" && $text[$i+2] == "o" && $text[$i+3] == "d" && $text[$i+4] == "e")
              $code = true;
            continue;
        }
        else if($code == true && $text[$i] == "<" && $text[$i+1] == "/" && $text[$i+2] == "c" && $text[$i+3] == "o" && $text[$i+4] == "d" && $text[$i+5] == "e"){
          $code = false;
          $x = true;
          $y = "<";
        }
        else if($text[$i] == ">" && $x == true){
            $x = false;
            $y = $y . ">";
            $tmp = $tmp . $y;
            $y = "";
            continue;
        }
        else if($x == true)
            $y .= $text[$i];
        else{
            if($text[$i] == " ")
              $tmp .= "&nbsp;";
            else{
              if($code == false)
                $tmp .= htmlentities($text[$i], ENT_QUOTES, "UTF-8");
              else{
                if($text[$i] == "<" && $text[$i+1] == "b" && $text[$i+2] == "r" && $text[$i+3] == " " && $text[$i+4] == "/" && $text[$i+5] == ">"){
                  $tmp .= "<br />";
                  $i += 5;
                }
                else{
                  $tmp .= htmlentities($text[$i], ENT_QUOTES, "UTF-8");
                }
              }
            }
        }
    }

    //echo $tmp;
    return $tmp;
}

//db
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";

?>
