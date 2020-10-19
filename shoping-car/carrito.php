<?php
include "../configs/config.php";
include "../configs/funciones.php";

if (isset($_POST['plus'])) {
    $plus = $_POST['plus'];
    $productos_carro = $_SESSION['carrito'];
    for($i=0;$i<count($productos_carro); $i++){
        if ($productos_carro[$i]['id'] == $plus) {
            $match  = true;
            $num = $i;
        }
    }
    if ($match == true) {
        $productos_carro[$num]['cantidad']=$productos_carro[$num]['cantidad']+1;
        $_SESSION['carrito'] = $productos_carro;
    }
    $cant = json_encode($_SESSION['carrito'][0]);
    echo $cant;
}
if (isset($_POST['minus'])) {
    $minus = $_POST['minus'];
    $productos_carro = $_SESSION['carrito'];
    for($i=0;$i<count($productos_carro); $i++){
        if ($productos_carro[$i]['id'] == $minus) {
            $match  = true;
            $num = $i;
        }
    }
    if ($match == true) {
        $productos_carro[$num]['cantidad']=$productos_carro[$num]['cantidad']-1;
        $_SESSION['carrito'] = $productos_carro;
    }
    $cant = json_encode($_SESSION['carrito'][0]);
    echo $cant;
}
?>
<link rel="stylesheet" type="text/css" href="../css/cssProducts.css">
<link rel="stylesheet" type="text/css" href="../styles.css">
<div class="header"><img class="shopcar" src="../img/shopCar.png" alt="">Mi Carrito</div>
<div class="cuerpocar">
<table class="tablaCarrito">
    <tr class="trH">
        <td></td>
        <td>Producto(s)</td>
        <td>Precio</td>
        <td>cantidad</td>
        <td>Total</td>
        <td></td>
    </tr>
<?php

if (isset($_SESSION['carrito'])) {
    if (isset($_REQUEST['id']) && isset($_REQUEST['cant'])) {
        $productos_carro = $_SESSION['carrito'];
        $match = false;
        $num = 0;
        $cant=$_REQUEST['cant'];
        for($i=0;$i<count($productos_carro); $i++){
            if ($productos_carro[$i]['id'] == $_REQUEST['id']) {
                $match  = true;
                $num = $i;
            }
        }
        if ($match == true || isset($plus)) {
            $productos_carro[$num]['cantidad']=$productos_carro[$num]['cantidad']+$cant;
            $_SESSION['carrito'] = $productos_carro;
        }else{
            $nombre ="";
            $precio ="";
            $oferta ="";
            $imagen ="";
    
            $query = mysqli_query($mysqli,"SELECT * FROM productos WHERE id =".$_REQUEST['id'])or die();
    
            $fila = mysqli_fetch_array($query);
    
            $nombre = $fila[1];
            $precio = $fila[2];
            $imagen = $fila[3];
            $oferta = $fila[5];

            if($oferta > 0){
                $precioFinal = ($precio * $oferta)/100;
            }else{
                $precioFinal = $precio;
            }

            $productosC = array(
                'id' => $_REQUEST['id'],
                'nombre' => $nombre,
                'precio' => $precioFinal,
                'img' => $imagen,
                'oferta' => $oferta,
                'cantidad' => $cant
            );
            array_push($productos_carro,$productosC);
            $_SESSION['carrito'] = $productos_carro;
        }
    }
}else{
    if (isset($_REQUEST['id'])) {
        $nombre ="";
        $precio ="";
        $oferta ="";
        $imagen ="";

        $query = mysqli_query($mysqli,"SELECT * FROM productos WHERE id =".$_REQUEST['id'])or die();

        $fila = mysqli_fetch_array($query);

        $nombre = $fila[1];
        $precio = $fila[2];
        $imagen = $fila[3];
        $oferta = $fila[5];

        if($oferta > 0){
            $precioFinal = ($precio * $oferta)/100;
        }else{
            $precioFinal = $precio;
        }

        $productos_carro[] = array(
            'id' => $_REQUEST['id'],
            'nombre' => $nombre,
            'precio' => $precioFinal,
            'img' => $imagen,
            'oferta' => $oferta,
            'cantidad' => $cant
        );
        $_SESSION['carrito'] = $productos_carro;
    }else{
        if (!isset($_SESSION['carrito']) || $_SESSION['carrito']==="") {
            mostrar_cod();
            echo "<h1>Su carrito esta vacio :(</h1><br>";
            die();
        }
    }
}

if (!isset($_SESSION['carrito'])) {
    // header("location:../");
    die("inicia sesio pndj");
}
    $carrito = $_SESSION['carrito'];
    $total=0;
    for ($pt=0; $pt <count($carrito); $pt++) {
        $total+=$carrito[$pt]['precio']*$carrito[$pt]['cantidad'];

    }
    // var_dump($ptotal);exit;
    // Mercado Pago SDK
    require '../routes/vendor/autoload.php';
    
    // Add Your credentials
    MercadoPago\SDK::setAccessToken('TEST-7193293061917941-092017-733ada8f0546bc4dc3347475b5bff79f-648764853');
    
    // Create a preference object
    $preference = new MercadoPago\Preference();
    //pre datos requeridos
    $codMP = rand(10000,10000000);

    $preference->back_urls = array(
        "success" => "http://localhost:8000/Page-ecosolwebtel/shoping-car/process.php?method=mercado_pago&cod=".$codMP,
        "failure" => "http://localhost:8000/Page-ecosolwebtel/shoping-car/pago_error.php?error=failure",
        "pending" => "http://localhost:8000/Page-ecosolwebtel/shoping-car/pago_pending.php?error=pendiente"
    );
    $preference->auto_return = "approved";
    
    $carrito = $_SESSION['carrito'];
    
    // Create a preference item
    $datosProductos=array();
    for ($i=0; $i <count($carrito); $i++){
        $item = new MercadoPago\Item();
        $item->title =  $carrito[$i]['nombre'];;
        $item ->quantity = $carrito[$i]['cantidad'];;
        $item->unit_price = $carrito[$i]['precio']+(($carrito[$i]['precio']*4)/100);;
        $datosProductos[]=$item;
    }

    $preference->items = $datosProductos;
    $preference->save();
    if (isset($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];
        $get_id = mysqli_query($mysqli,"SELECT * FROM productos");
        // var_dump($id);
        for ($i=0; $i <count($carrito); $i++) {  
            
            ?>
    <tr class="trs">
        <td><img src="../img-products/<?php echo $carrito[$i]['img'];?>" alt=""></td>
        <td><?php echo $carrito[$i]['nombre'];?></td>
        <td><?php echo $carrito[$i]['precio'];?></td>
        <td id="cantidad"><?php echo $carrito[$i]['cantidad'];?></td>
        <td><?php echo $carrito[$i]['precio'] * $carrito[$i]['cantidad'];?></td>
        <td><button name="plus" onclick="plus(<?=$carrito[$i]['id']?>);" class="icon-plus"></button><button name="minus" onclick="minus(<?=$carrito[$i]['id']?>);" class="icon-minus"></button></td>
    </tr>
<?php 
    }
}
if (isset($iz)) {
    if($nombre!="" && $telf!="" && $direccion!="" && $email!=""){
        $nombre = mysqli_real_escape_string($mysqli,$nombre);
        $telf = mysqli_real_escape_string($mysqli,$telf);
        $direccion = mysqli_real_escape_string($mysqli,$direccion);
        $email = mysqli_real_escape_string($mysqli,$email);
        $codigo_venta = rand(10000,10000000);
        $monto = $total+(($total*4)/100);

        $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,fecha,cod,metodo,estado) VALUES('$nombre', '$telf', '$direccion','$email','$monto',NOW(),'$codigo_venta','izipay','pendiente')");
        $_SESSION['pago']="iz";
        $_SESSION['cod']=$codigo_venta;
        borrar_carro($cliente);

        header("location:izipay.php");
    }else{
        ?>
        <script>alert("debe llenear todos los campos");</script>
        <?php
    }
}elseif (isset($tf)) {
    if($nombre!="" && $telf!="" && $direccion!="" && $email!=""){
        $nombre = mysqli_real_escape_string($mysqli,$nombre);
        $telf = mysqli_real_escape_string($mysqli,$telf);
        $direccion = mysqli_real_escape_string($mysqli,$direccion);
        $email = mysqli_real_escape_string($mysqli,$email);
        $codigo_venta = rand(10000,10000000);
        $monto = $total;
        
        $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,fecha,cod,metodo,estado) VALUES('$nombre', '$telf', '$direccion', '$email','$monto',NOW(),'$codigo_venta','transferencia','pendiente')");
        $_SESSION['pago']="tf";
        $_SESSION['cod']=$codigo_venta;
        borrar_carro($cliente);

        header("location:transfer.php");
    }else{
        ?>
        <script>alert("debe llenear todos los campos");</script>
        <?php
    }
}
?>
<tr class="trs">
    <td><h3><b>SubTotal<b></h3></td>
        <td></td>    
        <td></td>
        <td></td>    
        <td><h3><b><?=$total?><b><h3></td>    
</tr>
    <?php
    ?>
</table>
    <section class="pagar">
        <form action="" method="post" id="dataUser">
            <label for="">Nombres*</label>
            <input type="text" id="nombre" name="nombre">
            <label for="">Telefono*</label>
            <input type="text" id="telf" name="telf">
            <label for="">Direccion*</label>
            <input type="text" id="direccion" name="direccion">
            <label for="">Email*</label>
            <input type="text" id="email" name="email">

            <div>
                <h3>Metodos de pago</h3>
            </div>
            <label  class="tyc">
                <input type="checkbox" id="btn-tyc">
                <a href="../terminosycondiciones.html">Acepto los terminos y condiciones</a>
            </label>
            <div class="metodosPago">
                <div class="MPagar">
                    <p>Transferencia bancaria</p><br>
                    <button id="transfer" name="tf" class="transfer"><i class="icon-credit-card"></i><p>Pagar</p></button>
                </div>
                <div class="MPagar">
                    <p>Pago por Izipay</p><br>
                    <button id="izipay" name="iz" class="izipay"><p>izipay</p></button>
                </div>
            </div>
        </form>
        <div class="MPagar" >
            <p>Pago por Mercado pago</p><br>
            <form action="process.php?method=mercado_pago" method="POST" id="mp">
                <script src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id;?>">
                </script>
            </form>
        </div> 
    </section>
</div>
<?php
if(isset($_SESSION['cod']) && $_SESSION['cod']!=""){
    mostrar_cod();
}

function mostrar_cod()
{
    $cod = $_SESSION['cod'];
    echo "<p>Codigo de venta: $cod</p><br><p>Asegures de guardarlo para cualquier reclamo</p>";
}

if (isset($_REQUEST['nombre'])) {
    $nombre = $_REQUEST['nombre'];
    $mail = $_REQUEST['correo'];
    $lugar = $_REQUEST['lugar'];
    $telef = $_REQUEST['telf'];

    $data [] = array(
        'nombre' => $nombre,
        'email' => $mail,
        'lugar' => $lugar,
        'telf' => $telef,
        'monto' => $total
    );
    $_SESSION['mp_data']=$data;
}

function borrar_carro($q)
{
    if ($q) {
        unset($_SESSION['carrito']);
        mostrar_cod();
    }
}
?>
<script>
var form_mp=document.getElementById('mp');
var form = document.getElementById('dataUser');
var nombre = form.nombre;
var telf = form.telf;
var direccion = form.direccion;
var email = form.email;
    send_data();
    var btn_mp = document.getElementById('mp');
    var checkbox = document.getElementById('btn-tyc');
    var btn_tf = document.getElementById('transfer');
    var btn_iz = document.getElementById('izipay');
    
    disabled();
    // checkbox.addEventListener('click', function() {
    checkbox.addEventListener('change', function() {        
        if(nombre.value !="" & telf.value !="" & direccion.value!="" & email.value!=""){
            if(this.checked) {
                btn_tf.disabled = false;   
                btn_iz.disabled = false;   
                btn_mp.style.display = "block";  
            }else{
                disabled();
            }
        }else{
            checkbox.checked=false;
            disabled();
            alert("debe llenar todos los campos")
        }
    })
function disabled() {
    btn_mp.style.display = "none"; 
    btn_tf.disabled = true;   
    btn_iz.disabled = true;   
}

function send_data(){
form_mp.addEventListener('submit', function(){
    var name = nombre.value;
    var dir = direccion.value;
    var mail = email.value;
    var telf = document.getElementById('telf');
    var number = telf.value;

    const data = new FormData();
    data.append("nombre", name);
    data.append("lugar", dir);
    data.append("correo", mail);
    data.append("telf", number);

    fetch("carrito.php", {
        method: "POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            return res.text();
        } else {
            throw "Error weyyyyyy nooooooooooooooo";
        }
    })
    .catch(function (err) {
        console.log(err);
    });
})
}
// });
function plus(id) {
    const data = new FormData();
    data.append("plus", id);
    fetch('',{
        method:"POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            return res.text();
        }else{
            throw "error"
        }
    })
    .then(function (plus) {
        // alert()
        document.location.reload();
    })
    .catch(function (err) {
        console.log(err);
    })
}
function minus(id) {
    const data = new FormData();
    data.append("minus", id);
    fetch('',{
        method:"POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            return res.text();
        }else{
            throw "error"
        }
    })
    .then(function (plus) {
        // alert()
        document.location.reload();
    })
    .catch(function (err) {
        console.log(err);
    }) 
}
</script>