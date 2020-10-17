<?php
    session_start();
    if(!isset($_SESSION['pago']) || $_SESSION['pago']==""){
        header("location:carrito.php");
        die();
    }
?>
<div>
    <h2>Su codigo de venta es:</h2><br>
    <p><?=$_SESSION['cod']?></p>
    <h3>Para confirmar su venta y poder ser prcesada debe de comunicarse al siguiente correo electronico de ventas: ventas@ecosolucionesweb.com</h3>
</div>