<?php
include "../../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!$mysqli) {
	echo "No se ha podido conectar con la Base de Datos";
}
if (isset($_POST)) {

    $com = mysqli_query($mysqli,"SELECT * FROM pedidos");
    while ($res=mysqli_fetch_array($com)) {
        $id = $res['id'];
        $nombre = $res['nombre'];
        $telf = $res['telefono'];
        $direccion = $res['direccion'];
        $email = $res['email'];
        $monto = $res['monto'];
        $fecha = $res['fecha'];
        $cod = $res['cod'];
        $metodo = $res['metodo'];
        $status = $res['estado'];

        $compras[] = array(
            'id' => $id,
            'nombres' => $nombre,
            'telf' => $telf,
            'lugar' => $direccion,
            'email' => $email,
            'monto' => $monto,
            'fecha' => $fecha,
            'codigo' => $cod,
            'metodo' => $metodo,
            'status' => $status
        );
    }
}
$data_compras = json_encode($compras);
echo $data_compras;
?>