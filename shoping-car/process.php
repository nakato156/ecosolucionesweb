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
        $cod = $_SESSION['cod'];
    
        $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,fecha,cod,metodo,estado) VALUES('$nombre', '$telf', '$direccion', '$email','$monto',NOW(),'$cod','$method','$status')");
        borrar_carro($cliente);
    }else{
        die("Compra ya realizada vuelve al menu principal");
    }
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
function ver_tracking()
{
    if (isset($_SESSION['cod'])) {
        echo $_SESSION['cod'];
    }else{
        echo "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="stylesheet" type="text/css" href="../css/cssProducts.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
<div class="busqueda">
    <!-- <label>Ingrese su c&oacute;digo</label><br> -->
    <input type="text" id="buscar" class="buscar" placeholder="Ingrese su codigo" value="<?php ver_tracking();?>">
</div>
    <button onclick="view_tracking();">Buscar</button>
    <table class="tablaTracking">
        <thead class="encabezadoTH">
            <tr>
                <th>Nombre</th>
                <th>Tel&eacute;fono</th>
                <th>Direcci&oacute;n</th>
                <th>Monto</th>
                <th>C&oacute;digo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="view_tracking" class="cuerpoTk"></tbody>
    </table>
</body>
</html>
<script>
    window.addEventListener('load',view_tracking());
    function view_tracking() {
        var busqueda = document.getElementById("buscar");
        var cod = busqueda.value;

        const data = new FormData();
        data.append("codigo",cod)

        fetch("../routes/infopd.php",{
            method: "POST",
            body: data
        })
        .then(function (res) {
            if (res.ok) {
                return res.json();
            }else{
                throw "Error";
            }
        })
        .then(function (pedido) {
            console.log(pedido);
            let tem = "";
            if (pedido != "") {
                tem += `
                <tr class="Vtrack">
                    <td class="text-center">${pedido.nombre}</td>
                    <td>${pedido.telefono}</td>
                    <td>${pedido.direccion}</td>
                    <td>${pedido.monto}</td>
                    <td>${pedido.cod}</td>                                   
                    <td>${pedido.estado}</td>                   
                </tr>`;
                $("#view_tracking").html(tem);
            }
        })
        .catch(function (err) {
            console.log(err)
        })
    }
</script>