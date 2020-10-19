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
if (isset($_REQUEST['codigo'])) {
    $cod = $_REQUEST['codigo'];
    $result = array();
    $q = mysqli_query($mysqli,"SELECT * FROM pedidos WHERE cod = '$cod'");
    
    $pedido = mysqli_fetch_array($q);
    $info[] = array(
        'id' => $pedido['id'],
        'nombre' => $pedido['nombre'],
        'telf' => $pedido['telefono'],
        'lugar' => $pedido['direccion'],
        'monto' => $pedido['monto'],
        'codigo' => $pedido['cod'],
        'status' => $pedido['estado']
    );
    $ver_pedido = json_encode($pedido);
    echo $ver_pedido;
}
?>