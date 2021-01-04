<?php
include "../configs/config.php";
// information of products
if ($_SERVER['REQUEST_METHOD']=="POST") {    
    if (isset($_POST['id'])) {    
        $id = $_POST['id'];

        $info = array();
        $q = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '$id'");
        $res = mysqli_fetch_array($q);
        $cat = $res['id_categoria'];

        if ($res['ficha_tecnica'] =="") {
            $ficha = Null;
        }else{
            $ficha = $res['ficha_tecnica'];
        }

        $qcat = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id = '$cat'");    
        $categoria = mysqli_fetch_array($qcat);
        $cat = $categoria['categoria'];

        $info[] = array(
            'img' => $res['imagen'],
            'nombre' => $res['nombre'],
            'descripcion'=> $res['descripcion'],
            'precio' => $res['precio'],
            'categoria' => $cat,
            'ficha' => $ficha
        );
        $res = $qcat ? 200 : 500;
        $info_product = json_encode($info[0]);
        echo $info_product;
        return http_response_code($res);
    }
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
    $ver_pedido = json_encode($info[0]);
    echo $ver_pedido;
    $res = $q ? 200 : 500;
    return http_response_code($res);
}
?>