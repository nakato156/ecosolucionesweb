<?php
include "../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

if (isset($_REQUEST['method']) && isset($_REQUEST['cod']) && $_REQUEST['cod'] !="") {
    $cod = $_REQUEST['cod'];

    if (validar($mysqli,$cod) == 0) {
        $method = $_REQUEST['method'];
        $status = $_REQUEST['status'];
    
        $data = $_SESSION['mp_data'];
        $nombre = $data[0]['nombre'];
        $telf = $data[0]['telf'];
        $direccion = $data[0]['lugar'];
        $email = $data[0]['email'];
        $sub_total = $data[0]['monto'];
        $monto = $sub_total+(($sub_total*4)/100);
        // var_dump($data);exit;
        $_SESSION['cod']=$cod;
    
        $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,cod,metodo,estado) VALUES('$nombre', '$telf', '$direccion', '$email','$monto','$cod','$method','$status')");
        borrar_carro($cliente);
    }else{
        die("Compra ya realizada vuelve al menu principal");
    }
}else{
    die("Error");
}

function borrar_carro($q){
    if ($q) {
        unset($_SESSION['carrito']);
        unset($_SESSION['mp_data']);
    }
}

function validar($mysqli,$cod){
    $cons=mysqli_query($mysqli,"SELECT * FROM pedidos WHERE cod='$cod'");
    if (mysqli_num_rows($cons) > 0) {
        die("Compra ya realizada");
    }else{
        return 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
</head>
<body>
    <table>

    </table>
</body>
</html>
