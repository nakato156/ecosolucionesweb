<?php
include "../../configs/config.php";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if(isset($_POST['id-p'])){
    $id = $_POST['id-p'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cat = $_POST['categoria'];

    $query = mysqli_query($mysqli,"UPDATE productos SET nombre = '$nombre', precio = '$precio', id_categoria = '$cat' WHERE id = '$id'");

    if (!$query) {
        die("Ha ocurrido un error al actualizar");
    }
    echo "Producto actualizado correctamente";
}
?>