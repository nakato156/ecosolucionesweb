<?php
include "../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
    if (isset($_REQUEST['c'])) {
        $c = $_REQUEST['c'];

        if ($c == "webP") {
            $c="Web Profesional";
        }elseif ($c == "wp") {
            $c="Web Wordpress";
        }elseif ($c == "landing") {
            $c ="Landing Page";
        }elseif($c=="personalizado" || $c=="Blog"){
            $c= $c;
        }else{
            $c="No manipules la URL Webon";
        }
    }else{
        $c="sin contrato";
    }
    if (isset($_POST['enviar'])) {
        $email = mysqli_real_escape_string($mysqli,$_POST['email']);
        if ($email =="") {

            die();
        }
        $nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
        $servicio = mysqli_real_escape_string($_POST['servicio']);
        $telf = mysqli_real_escape_string($_POST['telf']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            mysqli_query($mysqli,"INSERT INTO servicio (cliente,email,servicio,telf) VALUES('$nombre','$email','$servicio','$telf')");
        }else {
            echo "email incorecto o no valido";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Contrato</title>
</head>
<body>
    <section class="background">
        <form action="" method="post" class="formContrato">
            <h2>Formulario de Contrato</h2>
            <label>Nombres y apellidos</label>
            <input type="text" name="nombre">
            <label>Correo electronico</label>
            <input type="email" name="email">
            <label for="">Servicio</label>
            <select name="servicio" id="">
                <option value="<?=$c?>"><?=$c?></option>
            </select>
            <label>Telefono</label>
            <input type="number" nmae="telf">
            <button name="enviar">Enviar</button>
        </form>
    </section>
</body>
<script src="../js/main.js"></script>
</html>
<script src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
data-preference-id="332087101-8ec3f5e1-8a54-4d7c-a7f8-2636dcf2f387">
</script>

