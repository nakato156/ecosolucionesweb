<?php
check_user("producto");

if (isset($cat)) {
	$sc = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id = '$cat'");
	$rc = mysqli_fetch_array($sc);
	if (($cat) == ""){
		
	}else{
		?><h6>Categoria filtrada por:&nbsp;<?=$rc['categoria'];?></h6>
		<?php
	}
}
if (isset($agregar) && isset($cant)) {

	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);

	$v = mysqli_query($mysqli,"SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	if (mysqli_num_rows($v)>0) {	

		$q = mysqli_query($mysqli,"UPDATE carro SET cant = cant + $cant WHERE id_cliente ='$id_cliente' AND id_producto = '$idp'");
	}else{

		$q=mysqli_query($mysqli,"INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}

	alert(1,"Producto agregado al carro",1,"productos");
}
// busquedad y filtrar por categoria
if (isset($busq) && ($cat) == ""){
		$q = mysqli_query($mysqli,"SELECT * FROM productos WHERE name like '%$busq%'");
	}elseif (isset($cat) && ($busq) == "") {
	$q = mysqli_query($mysqli, "SELECT * FROM productos WHERE id_categoria = '$cat' ORDER BY id DESC");
}else{
	$q = mysqli_query($mysqli, "SELECT * FROM productos ORDER BY id DESC");
}
?>
<form method="post" action="">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<input type="text" class="form-control" name="busq" placeholder="Buscar">
			</div>
		</div>
		<div class="col-md-1">
			<select id="Fcategoria" name="cat" class="form-control" >
				<option value="">Seleccione una categoria</option>
				<?php
				$cate = mysqli_query($mysqli,"SELECT * FROM categorias ORDER BY categoria ASC");
				while ($rcat = mysqli_fetch_array($cate)) {
					?>
					<option value="<?=$rcat['id']?>"><?=$rcat['categoria']?></option>
					<?php
				}
				?>
			</select>
		</div>	
		<div class="col-md-2">
			<button class="btn btn-primary" type="submit" name="buscar">Buscar</button>
		</div>
	</div>	
</form>
<?php
//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
while ($r=mysqli_fetch_array($q)) {
	$precioTotal = 0;
			if ($r['oferta']>0) {
				if (strlen($r['oferta'] == 1)) {
					$desc = "0.0".$r['oferta'];
				}else{
				$desc = "0.".$r['oferta'];
				
				}
				$precioTotal = $r['precio'] - ($r['precio'] * $desc);
			}else{
				$precioTotal = $r['precio'];
			}
	?>	
		<div class="producto">
		<div class="name_producto"><?=$r['name']?></div>
			<div><img alt="organico" class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<?php
			if ($r['oferta']>0) {
				?>
				<del><?=$r['precio']?><?=$divisa?></del><span class="precio">-<?=$precioTotal?><?=$divisa?></span>
				<?php
			}else{
				?>
				<span class="precio"><?=$r['precio']?><?=$divisa?></span>
				<?php
			}
			?>
			<button class="btn btn-warning" id="carrito" onclick="agregar_carro('<?=$r['id']?>');"><div class="icon-carrito"></div>
			</button>
		</div>
	<?php
}
?>

<script type="text/javascript">
	function agregar_carro(idp) {
		var cant = prompt("¿Que cantidad desea agregar?",1);

		if(cant.length>0){
			window.location=("?p=productos&agregar="+idp+"&cant="+cant);
		}
	}
</script>