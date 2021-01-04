<?php
include "car-end.php";
$sql = mysqli_query($mysqli,"SELECT * FROM ciudades");
?>
<link rel="stylesheet" type="text/css" href="../css/cssProducts.css">
<link rel="stylesheet" type="text/css" href="../styles.css">
<div class="header"><img class="shopcar" src="../img/shopCar.png" alt="">Mi Carrito</div>

<div class="cuerpocar">
<table class="tablaCarrito" id="tb_carro">
    <tr class="trH" id="h_carro">
        <td></td>
        <td>Producto(s)</td>
        <td>Precio</td>
        <td>cantidad</td>
        <td>Total</td>
        <td></td>
    </tr>
    <tbody id="pd-car">
        <tr class="trs"></tr>
    </tbody>
<tr class="trs">
    <td><h3><b>SubTotal<b></h3></td>
        <td></td>    
        <td></td>
        <td></td>    
        <td><h3><b><b><h3></td>    
</tr>
</table>
    <section class="pagar" id="form_pago">
        <form id="dataUser">
            <label for="">Nombres*</label>
            <input type="text" id="nombre" name="nombre">
            <label for="">Telefono*</label>
            <input type="text" id="telf" name="telf">
            <select name="ciudad" id="ciudad" class="selectCiudad">
            <option value="">Ciudad</option>
            <?php
                while ($ciudad=mysqli_fetch_array($sql)) {
                    
            ?>
                <option value="<?=$ciudad['ciudad'];?>"><?=$ciudad['ciudad'];?></option>
            <?php
                }
            ?>
            </select>
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
?>
<script src="logcar.js"></script>