<?php
include "../configs/config.php";
include "../configs/funciones.php";
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

    $preference->back_urls = array(
        "success" => "https://localhost/routes/process.php",
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
        $item->unit_price = $carrito[$i]['precio'];;
        $datosProductos[]=$item;
    }
            
    $preference->items = $datosProductos;
    $preference->save();
?>
<form action="process.php" method="POST">
    <script
        src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
        data-preference-id="<?php echo $preference->id; ?>">
    </script>
</form>