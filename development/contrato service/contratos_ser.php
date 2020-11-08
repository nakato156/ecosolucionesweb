<?php
include "../../configs/config.php";
include "../../configs/funciones.php";

$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['servicio'])) {

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telf = $_POST['telf'];
    $serv = $_POST['servicio'];
    $method = $_POST['method'];

    validarEmail($email);

    if (isset($_POST['programa'])) {
        $programa = $_POST['programa'];
        if ($programa == "") {
            echo "no hay especificaciones para la creacion del programa";
            die();
        }
    }
    else {
        $programa ="";
    }
    if ($_POST['method'] == "normal") {
        $q = mysqli_query($mysqli,"INSERT INTO servicio (cliente,email,telf,servicio,programa,method,status) VALUES('$nombre', '$email', '$telf', '$serv', '$programa','$method', 'pending')");

        if ($q) {
            echo "exito";
        }else {
            echo "algo esta mal";
        }
        mysqli_close($mysqli);
        die();
    }else {
        $datos[] = array(
            'nombre' => $nombre,
            'email' => $email,
            'telf' => $telf,
            'servicio' => $serv,
            'method' => $_POST['method'],
            'personalizado' => $programa
        );
        // $json = json_encode($datos);
        // echo $json;
        $_SESSION['pago'] = $datos;
        echo "Mpago";
    }
}
?>