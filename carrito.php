<?php
check_user("carrito");
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
if (isset($elimiar)) {
	$elimiar = clear($elimiar);
	mysqli_query($mysqli,"DELETE FROM carro WHERE id = '$elimiar'");
	alert(1,"El producto se ha eliminado",0,"carrito");
	// redir('?p=carrito');
}
if (isset($id) && isset($modificar)) {
	$id = clear($id);
	mysqli_query($mysqli,"UPDATE carro SET cant = '$modificar' WHERE id = '$id'");
	alert(1,"cantidad modificada",1,"carrito");
}

?>

<h3>Carro de compras</h3>
<br><br>
<table class="table table-striped">
	<tr>
		<th></th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio uni.</th>
		<th>Descuento</th>
		<th>Total</th>
		<th>Accion</th>
	</tr>

<?php
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
	
$id_cliente = clear($_SESSION['id_cliente']);
$q = mysqli_query($mysqli,"SELECT * FROM  carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;

while($r = mysqli_fetch_array($q)) {	
	$q2 = mysqli_query($mysqli,"SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
	$r2 = mysqli_fetch_array($q2);

	$precioTotal = 0;
			if ($r2['oferta']>0) {
				if (strlen($r2['oferta'] == 1)) {
					$desc = "0.0".$r['oferta'];
				}else{
				$desc = "0.".$r2['oferta'];
				
				}
				$precioTotal = $r2['precio'] - ($r2['precio'] * $desc);
			}else{
				$precioTotal = $r2['precio'];
			}
	$nombre_producto = $r2['name'];
	$cantidad = $r ['cant'];
	$precio_unidad = $r2['precio'];
	$precio_total = $cantidad * $precioTotal;
	$imagen_producto = $r2['imagen'];
	$pTotal= $cantidad * $precioTotal;

	$monto_total = $monto_total + $precio_total;
	?>
		<tr>
			<td><img src="productos/<?=$imagen_producto?>" class="imagen_carro"/></td>
			<td><?=$nombre_producto?></td>
			<td><?=$cantidad?></td>
			<td><?=$precio_unidad?><?=$divisa?></td>
			<td>
				<?php
					if ($r2['oferta']>0) {
						echo $r2['oferta']."% de Descuento";
					}else{
						echo "Sin Descuento";
					}
				?>
			</td>
			<td><?=$pTotal?><?=$divisa?></td>
			<td>
				<a href="?p=carrito&elimiar=<?=$r['id']?>" ><i class="icon-close" title="eliminar"></i></a>
					<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="icon-edit" title="modificar cantidad del carrito"></i></a>
				<?php	
				if ($r2['descargable'] !="") {
					?>
					<a href="./ebook/<?=$r2['descargable']?>" download class="icon-download"></a>
					<a href="./ebook/<?=$r2['descargable']?>" download><i class="icon-download"></i></a>
					<?php
					}
					?>
			</td>
		</tr>
	<?php	
}
?>
</table>
<h5>Monto total:<b class="text"> <?=$monto_total?><?=$divisa?></b></h5>
<br>
<form method="post" action="">
	<input type="hidden" name="monto_total" value="<?=$monto_total?>">
	<button class="btn btn-primary" type="submit" href="?p=pagar"><a style="color: #fff; text-decoration: none;" href="?p=pagar">Finalizar compra</a></button>
</form>
<script type="text/javascript">
	function modificar(idc) {
		var new_cant = prompt("cual es la nueva cantiddad?")

		if (new_cant>0){
			window.location="?p=carrito&id="+idc+"&modificar="+new_cant;
		}
	}
</script>