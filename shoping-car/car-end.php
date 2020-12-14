<?php
include "../configs/config.php";
include "../configs/funciones.php";

// agregar al carro
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
        if ($match) {
            $productos_carro[$num]['cantidad']=$productos_carro[$num]['cantidad']+$cant;
            $_SESSION['carrito'] = $productos_carro;
        }else{   
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
    if (isset($_REQUEST['id']) && isset($_REQUEST['cant'])) {
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
        if (!isset($_SESSION['carrito']) || $_SESSION['carrito']==null) {
            if (isset($_SESSION['cod'])) {
                mostrar_cod();
            }
            echo "<h1>Su carrito esta vacio :(</h1><br>";
            // sleep(3000);
            die();
        }
    }
}

$carrito = $_SESSION['carrito'];
$total=0;

if (isset($_SESSION['carrito']) && $_SESSION['carrito'] != null) {
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

    for ($pt=0; $pt <count($carrito); $pt++) {
        $total+=$carrito[$pt]['precio']*$carrito[$pt]['cantidad'];
    }
}
// if(preg_match_all("/shoping-car/", $_SERVER['REQUEST_URI'])==1){
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // datos de mp
    if (isset($_REQUEST['mp_data'])) {
        $nombre = $_POST['nombre'];
        $mail = $_POST['correo'];
        $lugar = $_POST['lugar'];
        $telef = $_POST['telf'];

        $data [] = array(
            'nombre' => $nombre,
            'email' => $mail,
            'lugar' => $lugar,
            'telf' => $telef,
            'monto' => $total
        );
        $_SESSION['mp_data']=$data;
    }
    // datos generale
    if (isset($_REQUEST['data'])) {
        $data = $_POST['data'];
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $lugar = $_POST['lugar'];
        $telf = $_POST['telf'];

        $nombre = mysqli_real_escape_string($mysqli,$nombre);
        $telf = mysqli_real_escape_string($mysqli,$telf);
        $lugar = mysqli_real_escape_string($mysqli,$lugar);
        $email = mysqli_real_escape_string($mysqli,$email);
        $codigo_venta = rand(10000,10000000);

        validarEmail($email); 

        if ($data == "izipay") {
            if($nombre!="" && $telf!="" && $lugar!="" && $email!=""){
                $monto = $total+(($total*4)/100);
        
                $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,fecha,cod,metodo,estado) VALUES('$nombre', '$telf', '$lugar','$email','$monto',NOW(),'$codigo_venta','izipay','pendiente')");
                $_SESSION['pago']="iz";
                $_SESSION['cod']=$codigo_venta;
                borrar_carro($cliente);
            }else{
                echo "debe llenear todos los campos";
            }
        }elseif ($data == "transferencia") {
            if($nombre!="" && $telf!="" && $lugar!="" && $email!=""){
                $monto = $total;
                            
                $cliente=mysqli_query($mysqli,"INSERT INTO pedidos (nombre,telefono,direccion,email,monto,fecha,cod,metodo,estado) VALUES('$nombre', '$telf', '$lugar','$email','$monto',NOW(),'$codigo_venta','transferencia','pendiente')");
                $_SESSION['pago']="tf";
                $_SESSION['cod']=$codigo_venta;
                borrar_carro($cliente);
            }else{
                echo "debe llenear todos los campos";
            }
        }
    }
    // ver carro
    if (isset($_POST['car'])) {
        $carro = json_encode($carrito);
        echo $carro;
    }
    //  mod cant
    if (isset($_POST['new-cant'])) {
        $action = $_POST['new-cant'];
        $id = $_POST['id'];
        modcant($action,$id);
    }
}//}else{exit();die();}

function modcant($action,$id){
    $pd_car = $_SESSION['carrito'];
    if(($action == "plus")){
        for($i=0;$i<count($pd_car); $i++){
            if ($pd_car[$i]['id'] == $id) {
                $pd_car[$i]['cantidad'] = $pd_car[$i]['cantidad']+1;
                $_SESSION['carrito'] = $pd_car;
            }
        }
    }else{
        for($i=0;$i<count($pd_car); $i++){
            if ($pd_car[$i]['id'] == $id) {
                if ($pd_car[$i]['cantidad'] == "1") {
                    unset($_SESSION['carrito'][$i]);
                    validar_carro();
                }else{
                    $pd_car[$i]['cantidad'] = $pd_car[$i]['cantidad']-1;
                    $_SESSION['carrito'] = $pd_car;
                    return;
                }
            }
        }
    }
}
function mostrar_cod(){
    if (isset($_SESSION['cod'])) {
        $cod = $_SESSION['cod'];
        echo "<p>Codigo de venta: $cod</p><br><p>Asegures de guardarlo para cualquier reclamo</p>";
    }return;
}
function borrar_carro($q){
    if ($q) {
        unset($_SESSION['carrito']);
    }
}
function validar_carro(){
    if ($_SESSION['carrito'] == null) {
        echo "0";
        return;
    }
}
?>