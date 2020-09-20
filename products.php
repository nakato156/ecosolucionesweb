<?php
include "configs/config.php";
include "configs/funciones.php";

if(!isset($p)) {
	$p = "principal";

}else {
	$p = $p;
}

if(!isset($_REQUEST['buscar'])){
	$busqueda="";
}else{
	$busqueda=$_REQUEST['buscar'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSolWebTel</title>
	<link rel="stylesheet" type="text/css" href="css/cssProducts.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="styles.css"> 
</head>
<body>
    <header>
		<section class="contenedor">
			<div class="logo">
				<img src="img/lg_help_class.png" alt="">
			</div>
			<div class="busqueda">
				<form action="" method="post">
					<div class="cont"><input type="text" name="buscar" id="buscar" placeholder="  Buscar" value="<?=$busqueda?>"><div class="icon-search"></div></div>
				</form>	
			</div>
		</section>
		<nav class="navbar" id="menu">
			<section class="N">
				<div class="enlaces Menu">
					<ul>
						<li><a href="?p=principal" class="selected">Inicio</a></li>
						<li><a href="?p=ecologico">Ecologico</a></li>
						<li><a href="?p=importaciones">Importaciones</a></li>
						<li><a href="?p=computo">Computo</a></li>
						<li><a href="?p=electro">Celulares y tablets</a></li>
						<li><a href="?p=calzado">Calzado</a></li>
						<li><a href="?p=carteras">Carteras</a></li>
						<li><a href="?p=ropa_bebe">Ropa para bebe</a></li>
						<li><a href="?p=cosmeticos">Cosmeticos</a></li>
						<li><a href="?p=voz_ip">Voz/ip</a></li>		
						<li><a href="?p=videovigilancia">Video Vigilancia</a></li>		
						<li><a href="?p=cableado">Cableado estructurado</a></li>		
						<li><a href="?p=electro_hogar">Electo hogar</a></li>		
						<li><a href="?p=servicios">Servicios</a><li class="sub"><a href="">Desarrollo Web</a></li></li>		
					</ul>
				</div>
				<div class="hamb">
					<i class="icon-menu"></i>
				</div>
			</section>
		</nav>
	</header>
	<section class = "cuerpoP">
		<div class="categorias">
			<section class="cat">
				<ul>
					<li><a href="?p=item0">item0</a></li>
					<li class="submenu"><a href="#">computo</a><div class="icon-down flecha"></div>
						<ul>
							<li><a href="?p=productos">sub item1</a></li>
							<li><a href="#">sub item3</a></li>
							<li><a href="#">sub item2</a></li>
							<li><a href="#">sub item4</a></li>
						</ul>
					</li>
					<li><a href="?p=item2">item2</a></li>
				</ul>				
			</section>
		</div>
		<div id ="carrito" class="carrito">
			<i class="icon-carrito"></i>
		</div>
		<section class="productos">
			<section class="sliders" id = "sliders">
				<img name="slider" id = "slider" src="" style="" alt="">
			</section>
			<?php
				if(isset($_REQUEST['p'])){
					include "routes/productos.php";	
				}else{
					include "routes/principal.php";
				}
				// if(file_exists("routes/".$p.".php")) {
				// 	include "routes/".$p.".php";
				// }else{
				// 	echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
				// }
			?>
		</section>
	</section>
	<footer>
		<div class="Pfooter">
			<h4>Servicios</h4>
			<a href="#">Desarollo web</a>
			<!-- <a href="#">servicios 2</a>
			<a href="#">servicios 3</a> -->
		</div>
		<div class="Pfooter">
			<h4>Contactanos</h4>
			<a href="#">+51 902 658 722</a>
			<a>administrador@ecosolucionesweb.com</a>
			<a>developer@ecosolucionesweb.com</a>
		</div>
		<div class="Pfooter">
			<h4>Redes sociales</h4>
			<div class="redesS">
				<i class="icon-fb"><a blank href="https://www.facebook.com/ecoaoluciones/" target="_blank"></a></i>
				<i class="icon-wp"><a blank href="https://wa.me/c/51902658722" target="_blank"></a></i>
			</div>
		</div>
		<!-- <p>Todos los derechos reservados-Copyright &copy; <?=date("Y")?></p> -->
	</footer>
	<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
	<script src="js/main.js"></script>
	<script src="js/menu.js"></script>
</body>
</html>