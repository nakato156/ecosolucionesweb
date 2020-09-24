<?php
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
?>
<link rel="stylesheet" type="text/css" href="../css/cssProducts.css">
<link rel="stylesheet" type="text/css" href="../styles.css">
<div class="header"><img class="shopcar" src="../img/shopcar.png" alt="">Mi Carrito</div>
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
include "../configs/config.php";
include "../configs/funciones.php";

if (isset($_SESSION['carrito']) && isset($_SESSION['user']) ) {
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
        echo "<h1>Su carrito esta vacio :(</h1>";
        die();
    }
}
?> 
<?php
if (isset($_SESSION['carrito'])) {
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
    for ($i=0; $i <count($carrito); $i++) {  
                     
?>
    <tr class="trs">
        <td><img src="../img-products/<?php echo $carrito[$i]['img'];?>" alt=""></td>
        <td><?php echo $carrito[$i]['nombre'];?></td>
        <td><?php echo $carrito[$i]['precio'];?></td>
        <td><?php echo $carrito[$i]['cantidad'];?></td>
        <td><?php echo $carrito[$i]['precio'] * $carrito[$i]['cantidad'];?></td>
        <td><button name="plus" class="icon-plus"></button><button name="minus" class="icon-minus"></button></td>
    </tr>
<?php 
    }
}
?>
</table>
    <div class="pagar">
        <div>
            <h3>Métodos de pago</h3>
        </div>
        <div class="btnPagar">
            <p>MercadoPago</p>
            <form action="process.php" method="POST">
                <script
                src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id; ?>">
                </script>
            </form>
        </div>
    </div>
</div>