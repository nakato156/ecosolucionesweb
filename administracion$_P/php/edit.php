<?php
include "../../configs/config.php";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if(isset($_POST['id-p'])){
    $img = $_FILES['imagen'];
    $id = $_POST['id-p'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cat = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    if ($img['name']== "") {
        $query = mysqli_query($mysqli,"UPDATE productos SET nombre = '$nombre', precio = '$precio', id_categoria = '$cat', descripcion = '$descripcion' WHERE id = '$id'");
    }else{
        $newImg = $nombre.rand(0,10000).".png";
        $rut = "../../img-products/";
        $path = $rut.$newImg;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)){ 
            $query = mysqli_query($mysqli,"UPDATE productos SET nombre = '$nombre', precio = '$precio', id_categoria = '$cat', descripcion = '$descripcion', imagen = '$newImg' WHERE id = '$id'");
        }
    }

    if (!$query) {
        die("Ha ocurrido un error al actualizar");
    }
    echo "Producto actualizado correctamente";
}
?>