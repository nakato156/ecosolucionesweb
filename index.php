<?php
include "configs/config.php";
include "configs/funciones.php";
$urlDev ="delopment";
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
		<nav id="menu">
			<div class="Menu navbar">
				<div class="logo">
					<img src="img/logo.png" alt="ecosolwebtelLogo">
				</div>

				<div class="busqueda">
					<form action="" method="post">
					<div class="cont"><input type="text" name="buscar" id="buscar" placeholder="  Buscar" value="<?=$busqueda?>"><div class="icon-search"></div></div>
					</form>	
				</div>

				<section class="cat">
					<ul>
						<li  class="menu sub"><a>Categorias<div class="icon-down flecha"></div></a>
							<ul>
								<li><a href="?p=principal" class="selected">Inicio</a></li>
								<li><a href="?p=ecologico">Ecologico</a></li>
								<li><a href="?p=importaciones">Importaciones</a></li>
								<li><a href="?p=computo">Computo</a></li>
								<li><a href="?p=electro">Celulares y tablets</a></li>
								<li><a href="?p=ropa_bebe">Ropa para bebe</a></li>
								<li><a href="?p=voz_ip">Voz/ip</a></li>		
								<li><a href="?p=videovigilancia">Video Vigilancia</a></li>		
								<li><a href="?p=cableado">Cableado estructurado</a></li>		
								<li><a href="?p=cosmeticos">Cosmeticos</a></li>		
								<li><a href="?p=electro_hogar">Electo hogar</a></li>
							</ul>
						</li>
					</ul>
					<ul>
						<li class="menu sub"><a>Servicios<div class="icon-down flecha"></div></a>
							<ul>
								<li><a href="development?p=developer">Desarrollo web</a></li>
								<li><a href="development">Diseño web</a></li>
								<li><a href="development">Programas a medida</a></li>
								<li><a href="development">Elaboracion de tienda virtual</a></li>
								<li><a href="development">Elaboracion de aula virtual</a></li>
								<li><a href="?p=prox">Cursos en Linea</a></li>
							</ul>
						</li>
					</ul>
					<ul>
						<li class="menu"><a href="?p=prox">Aula Virtual</a></li>
					</ul>				
				</section>		
				<!--  -->
			</div>
			<div class="hamb">
				<i class="icon-menu"></i>
			</div>
		</nav>
	</header>
	<section class = "cuerpoP">
		<div id ="carrito" class="carrito">
			<i class="icon-carrito"></i>
		</div>
		<section class="productos">
			<div class="ventana" id="modal">
			</div>
			<div class="infoP" id="infoP"></div></div>
			<?php
				if(isset($_REQUEST['p'])){
					include "routes/productos.php";	
				}else{
					include "routes/principal.php";
				}
			?>
		</section>
	</section>
	<footer>
		<div class="Pfooter">
			<h4 style="cursor:pointer;" Onclick='window.open("https://servicios.ecosolucionesweb.com/")'>Servicios</h4>
			<a href="https://servicios.ecosolucionesweb.com/?p=desarrolloweb" target="_blank">Desarollo web</a><br>
			<a href="https://servicios.ecosolucionesweb.com/?p=ecomerce" target="_blank">Tiendas online</a><br>
			<a href="https://servicios.ecosolucionesweb.com/?p=medida" target="_blank">Programas a medida</a><br>
			<a href="https://servicios.ecosolucionesweb.com/?p=classroom" target="_blank">Aulas virtuales</a><br>
			<!-- <a href="#">servicios 3</a> -->
		</div>
		<div class="Pfooter">
			<h4>Contactanos</h4>
			<a href="https://wa.me/c/51902658722">+51 902 658 722</a>
			<a>administrador@ecosolucionesweb.com</a>
			<a>developer@ecosolucionesweb.com</a>
		</div>
		<div class="Pfooter">
			<h4>Redes sociales</h4>
			<div class="redesS">
				<a href="https://www.facebook.com/ecosolucionesweb/" target="_blank"><i class="icon-fb"></i></a>
				<a href="https://wa.me/c/51902658722" target="_blank"><i class="icon-wp"></i></a>
			</div>
		</div>
		 <!--<p>Todos los derechos reservados-Copyright &copy; <?=date("Y")?></p> -->
	</footer>
	<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
	<script src="js/main.js"></script>
	<script src="js/menu.js"></script>
</body>
</html>