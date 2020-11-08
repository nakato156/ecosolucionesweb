<?php 
include "../../configs/config.php";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!isset($mysqli)) {
	echo "Error al conectar con la base de Datos";
}
if (isset($_REQUEST['nombre']) !="") {
	$name = $_REQUEST['nombre'];
	$precio = $_REQUEST['precio'];
	// $oferta = $_REQUEST['oferta'];
	$categoria = $_REQUEST['categoria'];
	$descripcion = $_POST['descripcion'];

	$fichaTec = $_FILES['ficha']; 
	$imagen = $_FILES['imagen'];

	if (is_uploaded_file($_FILES['imagen']['tmp_name']) && is_uploaded_file($_FILES['ficha']['tmp_name'])) {
		if ($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg" or $imagen["type"] == "image/png") {
			$img = $name.rand(0,1000).".png";
			$rut = "../../img-products/";
			$path = $rut.$img;

			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)){ 
				$file = $name.rand(0,1000).".pdf";
				$route = "../../fichas-tecnicas doc/".$file;
				if($fichaTec["type"]=="application/pdf"){ 
					if (move_uploaded_file($_FILES['ficha']['tmp_name'], $route)) {
						mysqli_query($mysqli, "INSERT INTO productos (nombre,precio,imagen,descripcion,ficha_tecnica,id_categoria) VALUES ('$name','$precio','$img','$descripcion','$file','$categoria')");
						echo "Producto agregado satisfactoriamente";
					}
				}else{
					echo "Solo se permiten archivos PDFs";
					die();
				}
			}
		}else{
			echo "error al subir la imagen";
			die();
		}
	}else{
		if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			if ($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg" or $imagen["type"] == "image/png") {
				$img = $name.rand(0,1000).".png";
				$rut = "../../img-products/";
				$path = $rut.$img;
	
				if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)){ 
					mysqli_query($mysqli, "INSERT INTO productos (nombre,precio,imagen,descripcion,id_categoria) VALUES ('$name','$precio','$img','$descripcion','$categoria')");
				}
			}
		}else{
			die();
		}
	}
}
?>