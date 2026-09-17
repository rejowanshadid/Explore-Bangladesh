<?php

$valid = true;

if (empty($_POST['username'])) {
    $valid = false;
}


echo "<br>";

if (empty($_POST['password'])) {
    $valid = false;
}

?>