<?php
    include "../../configs/config.php"; #include "configs/config.php";
    $mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
    if (isset($_SESSION['pago'])) {
        if (isset($_REQUEST['status'])) {
            $status = $_REQUEST['status'];
            if ($status == "aproved") {
                $pago = $_SESSION['pago'];
                $nombre = $pago[0]['nombre'];
                $email = $pago[0]['email'];
                $telf = $pago[0]['telf'];
                $serv = $pago[0]['servicio'];
                $programa = $pago[0]['personalizado'];
                $method = "mercado pago";
                
                $q = mysqli_query($mysqli,"INSERT INTO servicio (cliente,email,telf,servicio,programa,method,status) VALUES('$nombre', '$email', '$telf', '$serv', '$programa','$method','$status')");
                $mensaje = '   
                <section>
                    <h3>Gracias por contratar nuestro servicio <a>ヅ</a></h3>
                    <p>En momentos nos estaremso poniendo en contacto con usted</p>
                    <p>Su solicitud puede tardar un maximo de 48 horas para ser procesada</p>
                </section>';
                // session_destroy();
            }
        }else{
            $mensaje = '   
            <section>
                <h3>Vaya ha ocurrido un Error</h3>
                <p>Por favor pongase en contacto con nuestro equipo de soporte</p>
            </section>';
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Gracias</title>
</head>
<body>
    <section class="mensaje">
    <?=$mensaje?>
    </section>
</body>
</html>
<?php
    }else{
        die("No se ha realizado ningun pago");
        session_destroy();
    }
?>