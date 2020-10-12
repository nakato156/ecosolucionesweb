<?php
include "../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

if (isset($_POST['id'])) {    
    $id = $_POST['id'];

    $info = array();
    $q = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '$id'");
    $res = mysqli_fetch_array($q);
    $cat = $res['id_categoria'];

    $qcat = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id = '$cat'");    
    $categoria = mysqli_fetch_array($qcat);
    $cat = $categoria['categoria'];

    $info[] = array(
        'img' => $res['imagen'],
        'nombre' => $res['nombre'],
        'precio' => $res['precio'],
        'categoria' => $cat
    );
    $info_product = json_encode($info[0]);
    echo $info_product;
}
?>