<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    // header("location:../");
    die("inicia sesio pndj");
}

    // Mercado Pago SDK
    require '../routes/vendor/autoload.php';

    // Add Your credentials
    MercadoPago\SDK::setAccessToken('TEST-7193293061917941-092017-733ada8f0546bc4dc3347475b5bff79f-648764853');

    // Create a preference object
    $preference = new MercadoPago\Preference();
    $cod = 2;
    // test_user_123456@testuser.com 
    // 5031 7557 3453 0604
    $preference->back_urls = array(
        "success" => "https://localhost/routes/process.php?cod=".$cod,
        "failure" => "http://localhost/routes/pago_error.php?error=failure",
        "pending" => "http://localhost/routes/pago_pending.php?error=pendiente"
    );
    $preference->auto_return = "approved";

    $carrito = $_SESSION['carrito'];

    // Create a preference item
    $datosProductos=array();
    for ($i=0; $i <count($carrito); $i++){
        $item = new MercadoPago\Item();
        $item->title =  $carrito[$i]['nombre'];;
        $item ->quantity = $carrito[$i]['cantidad'];;
        $item->unit_price = $carrito[$i]['precio']-(($carrito[$i]['precio']*4)/100);;
        $datosProductos[]=$item;
    }
            
    $preference->items = $datosProductos;
    $preference->save();

    ?>