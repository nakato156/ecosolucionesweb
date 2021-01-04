<?php
session_start();
extract($_REQUEST);

$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="ecosol";

$mysqli = new mysqli($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
$divisa=" PEN";//moneda S/.
?>