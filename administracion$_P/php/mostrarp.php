<?php 
include "../../configs/config.php";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!$mysqli) {
	echo "No se ha podido conectar con la Base de Datos";
}

$prod = mysqli_query($mysqli,"SELECT * FROM productos ORDER BY id DESC");

$json = array();
while ($rp=mysqli_fetch_array($prod)) {
	$precioTotal = 0;

	$acat = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id ='".$rp['id_categoria']."'");

	if (mysqli_num_rows($acat)>0) {
		$racat = mysqli_fetch_array($acat);
		$categoria = $racat['categoria'];
	}else{
		$categoria = "--";
	}
	if ($rp['oferta']>0) {
		if (strlen($rp['oferta'] == 1)) {
			$desc = "0.0".$rp['oferta'];
		}else{
			$desc = "0.".$rp['oferta'];

		}
		$precioTotal = $rp['precio'] - ($rp['precio'] * $desc);
	}else{
		$precioTotal = $rp['precio'];
	}
	if ($rp['oferta']>0) {
		$nd= $rp['oferta']."% de Descuento";
	}else{
		$nd = "--";
	}
	$idc = $rp['id_categoria'];
	$q = mysqli_query($mysqli,"SELECT * FROM categorias WHERE id = '$idc'");
	while($r=mysqli_fetch_array($q)){
		$json[] = array(
			'id' => $rp['id'],
			'imagen' => $rp['imagen'],
			'name' => $rp['nombre'],
			'categoria' => $r['categoria'],
			'descript' => $rp['descripcion'],
			'precio' => $rp['precio'],
			'precioT' => $precioTotal,
			'oferta' => $nd
		);
	}
}
$jstring = json_encode($json);
echo $jstring;
?>