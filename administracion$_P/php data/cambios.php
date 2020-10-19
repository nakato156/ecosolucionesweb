<?php
include "../../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!$mysqli) {
	echo "No se ha podido conectar con la Base de Datos";
}
if (isset($_POST['id']) && isset($_POST['op']) && isset($_POST['status'])) {
    if($_POST['op'] == "update"){
        $estado = $_POST['status'];
        $id = $_POST['id'];
        $q = mysqli_query($mysqli,"UPDATE pedidos SET estado = '$estado' WHERE id = '$id'");

        echo "datos actualizados con exito";
    }else{
        echo "Ha ocurrido un error";
    }
}
if (isset($_POST['search']) && isset($_POST['dato'])) {
    $search = $_POST['dato'];
    // var_dump($search);exit;
    $q = mysqli_query($mysqli,"SELECT * FROM pedidos WHERE nombre LIKE '%".$search."%' OR cod LIKE '%".$search."%'");
    $result = array();
    if (mysqli_num_rows($q)>0) {
        while ($res=mysqli_fetch_array($q)) {
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
            
            $result[] = array(
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
    }else{
        $result[] = array(
            'id' => "--",
            'nombres' => "--",
            'telf' => "--",
            'lugar' => "--",
            'email' => "--",
            'monto' => "--",
            'fecha' => "--",
            'codigo' => "--",
            'metodo' => "--",
            'status' => "--"
        );
    }
    $busqueda = json_encode($result);
    echo $busqueda;
}
?>