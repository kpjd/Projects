<?php

$link = "localhost";
$user = "user";
$pw = "password";
$db = "database";

$mysqli = new mysqli($link, $user, $pw, $db);
if($mysqli->connect_error){
    die("connection Failed: " . $mysqli->connect_error);
}
?>