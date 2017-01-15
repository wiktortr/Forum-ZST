<?php

//print_r($_SERVER);

$now = getdate();

$date = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $now['minutes'] . ":" . $now['seconds'];

echo "Date: " . $date . "<br>";
echo "Remote addr: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Remotle agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";

?>