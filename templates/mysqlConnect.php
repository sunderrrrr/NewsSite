<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$BDname = "bd_blog";

$mysqli = new mysqli($servername, $username, $password, $BDname);

if ($mysqli -> connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
    exit();
};