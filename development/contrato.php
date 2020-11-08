<?php
include "../configs/config.php";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
// print_r($_SESSION);exit;
$servicios = array(
    ['webP' => 'web profesional','wp'=>'web wordpress','blog' => 'blog','landing' =>'landing page','personalizado' => 'personalizado'],
    ['tienda' => 'tienda virtual'],
    ['node' => 'Node Js','cm' => 'Chamilo','jm' => 'Joomla'],
    ['programa' => 'programa a medida']
);
$serv = $_REQUEST['c'];
for ($i=0; $i <count($servicios) ; $i++) { 
    $n_servicios = count($servicios[$i]);
    foreach ($servicios[$i] as $clave => $servicio) {
        if ($_REQUEST['c'] == $clave) {
            if ($serv == "programa") {
                $programa = '<label>Programa que desea</label>
                <input type="text" name="programa">';
            }
            $c = $servicios[$i][$serv];
            if ($i == 0) {
                $Scat = "Desarrollo web";
            }elseif ($i == 1){
                $Scat = "Ecomerce";                 
            }elseif ($i == 2) {
                $Scat = "Classroom";          
            }elseif ($i == 3) {
                $Scat = "Programas a medida";                
            }
            $pago = btn_pago($clave);
            break 2;
        }else{
            $c = "sin contrato";
            $clave = null;
            $pago = null;
            $Scat = '"sin categoria"';
        }
    }
}

function btn_pago($btnPago){
    if ($btnPago == "tienda") {
        return '';
    }elseif ($btnPago == "webP") {
        return '<div id="pagoMP"><script src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
        data-preference-id="332087101-8ec3f5e1-8a54-4d7c-a7f8-2636dcf2f387">
        </script></div>';
    }elseif ($btnPago == "wp") {
        return '';
    }elseif ($btnPago == "landig") {
        return '';
    }elseif ($btnPago == "Blog") {
        return '';
    }else{
        return '<button name="enviar" id="enviar" class="btnEnviar">Enviar</button>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Contrato</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <section class="background">
        <form action="./contrato service/contratos_ser.php" method="post" id="contrato" class="formContrato">
            <h2>Formulario de Contrato</h2>
            <h2>Categoria de <?=$Scat?></h2>
            <label>Nombres y apellidos</label>
            <input type="text" name="nombre">
            <label>Correo electronico</label>
            <input type="email" name="email">
            <?php if(isset($programa)){echo $programa;}?>
            <label for="">Servicio</label>
            <select name="servicio" id="serv">
                <option value="<?=$c?>"><?=$c?></option>
            </select>
            <label>Telefono</label>
            <input type="number" name="telf" id="telf">
            <div><?=$pago;?></div>
        </form>
    </section>
    <section>
        <div id="msgF"></div>
    </section>
</body>
<script src="../js/main.js"></script>
</html>


