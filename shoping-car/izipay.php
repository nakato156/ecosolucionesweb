<?php
    session_start();
    if(!isset($_SESSION['pago']) || $_SESSION['pago']==""){
        header("location:carrito.php");
        die();
    }
?>
<table>
    <tr>
        <td><p>Numero de cuenta</p></td>
    </tr>
</table>
<div>
    <h3>Su codigo de venta es:</h3><br>
    <p><?=$_SESSION['cod']?></p>
</div>