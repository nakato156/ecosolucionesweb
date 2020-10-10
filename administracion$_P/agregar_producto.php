<?php
check_admin();
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

//guardar producto en la base de datos

if(isset($eliminar)) {
	mysqli_query($mysqli,"DELETE FROM productos WHERE id ='$eliminar'");
}
?>
<form id="pluspdoh" method="post" class="my-2 mys-lg-0" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" id="name" placeholder="Nombre del producto"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="precio" id="precio" placeholder="Precio del producto"/>
	</div>

	<label>Imagen del producto</label>
	<div class="form-group">
		<input type="file" class="form-control" name="imagen" id="imagen" title="Imagen del producto">
	</div>

	<div class="form-group">
		<select name="categoria" id="categoria"  class="form-control">
			<option value="">Selecione una categoria</option>
			<?php
			$q = mysqli_query($mysqli,"SELECT * FROM categorias ORDER BY id ASC");

			while ($r=mysqli_fetch_array($q)) {
				?>
				<option value="<?=$r['id']?>"><?=$r['categoria']?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div id="desc" class="form-group">
		<select name="oferta" id="oferta" class="form-control">
			<option value="0">0% de Descuento</option>
			<option value="5">5% de Descuento</option>
			<option value="10">10% de Descuento</option>
			<option value="15">15% de Descuento</option>
			<option value="20">20% de Descuento</option>
			<option value="25">25% de Descuento</option>
			<option value="30">30% de Descuento</option>
			<option value="35">35% de Descuento</option>
			<option value="40">40% de Descuento</option>
			<option value="45">45% de Descuento</option>
			<option value="50">50% de Descuento</option>
			<option value="55">55% de Descuento</option>
			<option value="60">60% de Descuento</option>
			<option value="65">65% de Descuento</option>
			<option value="70">70% de Descuento</option>
			<option value="75">75% de Descuento</option>
			<option value="80">80% de Descuento</option>
			<option value="85">85% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<label>Agregar Producto Virtual</label>
		<input type="file" name="descargable" id="descargable" class="form-control" title="Producto virtual">
	</div>

	<div class="form-group">
		<button type="submit" id="submit" class="icon-plus btn btn-primary text-center" name="enviar"> Agregar producto</button>
	</div>
</form>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>img</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			<th>%Descuento</th>
			<th>P. Total</th>
			<th>categoria</th>		
			<th>Acciones</th>
		</tr>
	</thead>
		<tbody class="bg-white" id="productosoh">	
		</tbody>	
		<?php	
	// }
	?>
</table>
<script src="js/logic.js"></script>