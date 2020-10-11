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

	$imagen = $_FILES['imagen'];
	if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		if ($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg") {

			$img = $name.rand(0,1000).".png";
			$rut = "../../img-products/";
			$path = $rut.$img;

			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)){ 

				mysqli_query($mysqli, "INSERT INTO productos (nombre,precio,imagen,id_categoria) VALUES ('$name','$precio','$img','$categoria')");
			}
		}
	}
	
 	// cargar img del producto

	// if (is_uploaded_file($_FILES['name'])){

	// 	$imagen = $name.rand(0,1000).".png";

	// 	}

 	// cargar archivo virtual
	// if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
	// 	$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
	// 	move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
	// }


	// if (is_uploaded_file($_FILES['descargable']['tmp_name'])) {
	// 	$descargable =$descargable.rand(0,1000).$_FILES['descargable']['name'];
	// 	move_uploaded_file($_FILES['descargable']['tmp_name'], "./ebook/".$descargable);
	// }

}
?>