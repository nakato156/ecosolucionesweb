<?php
    session_start();
    if(!isset($_SESSION['pago']) || $_SESSION['pago']==""){
        // header("location:carrito.php");
        echo "no variable 'pago'";
        die();
    }
    // var_dump($_SESSION['cod']);exit;
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="Page-ecosolwebtel\css\cssProducts.css">
<table class="table table-striped" style="background-color:#22022;">
    <tr>
        <td><p>Banco</p></td>
        <td><p>cuenta</p></td>
        <td><p>Numero de cuenta</p></td>
        <td><p>Numero de cuenta interbancario</p></td>
    </tr>
    <tr>
        <td><p>Interbanck</p></td>
        <td><p>Soles</p></td>
        <td><p>8983188300733</p></td>
        <td><p>00389801318830073341</p></td>
    </tr>
    <td><p>Interbanck</p></td>
        <td><p>Dolares</p></td>
        <td><p>2003002775635</p></td>
        <td><p>00320000300277563539</p></td>
    </tr>
    <tr>
        <td><p>BCP</p></td>
        <td><p>Soles</p></td>
        <td><p>19138248236080</p></td>
        <td><p>00219113824823608058</p></td>
    </tr>
    <tr>
        <td><p>BCP</p></td>
        <td><p>Dolares</p></td>
        <td><p>19299322027178</p></td>
        <td><p>00219219932202717832</p></td>
    </tr>
</table>
<div class="codigoVenta">
    <h3>Su codigo de venta es:</h3><br>
    <p><?=$_SESSION['cod']?></p>
</div>
<div class="infoVenta">
    <h3>INFORMACIÓN</h3>
    <p>Para verificar, validar y preceder al despacho de su pedido debe de enviar una foto del comprobante de la transferencia bancaria al igual que su codigo de venta al siguiente correo: @ecosolucionesweb.com</p>
</div>