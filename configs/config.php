<?php
session_start();
extract($_REQUEST);

$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="ecosol";

$mysqli = new mysqli($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
$divisa=" PEN";//moneda S/.

putenv("TOKEN=TEST-7193293061917941-092017-733ada8f0546bc4dc3347475b5bff79f-648764853");
putenv("HOST=localhost:8000");
?>