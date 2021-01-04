<?php
// $host_mysql="localhost";
// $user_mysql="root";
// $pass_mysql="";
// $bd_mysql="ecosol";

// $mysqli = new mysqli($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

putenv("TOKEN=TEST-7193293061917941-092017-733ada8f0546bc4dc3347475b5bff79f-648764853");
putenv("HOST=localhost:8000");

if ($mysqli -> connect_errno) {
	die($mysqli -> connect_errno);
}
	
function clear($var){
	htmlspecialchars($var);
	return $var;
}
function check_admin(){
	if (!isset($_SESSION['chika'])) {
		header("location:login.php");
	}
}
function validarEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
		return 200;
	}else{
		return 400;
	}
}
function validarDatos($datos){
	if ($datos['nombre'] != "" && $datos['telf']!="" && $datos['lugar']!="" && $datos['email']!="") {
		if (strlen($datos['telf']) > 9) {
			return 400;
		}
		$validar = validarEmail($datos['email']);
		return $validar;
	}else {
		return 400;
	}
}
function alert($var){
	?>
	<script type="text/javascript">
		alert("<?=$var?>");
	</script>
	<?php
}

function NonQuery($sql, &$mysqli = null)
{
	if (!$mysqli)global $mysqli;
	$result = $mysqli->query($sql);
	$resultArray = array();
	foreach($result as $productos){
		$resultArray[] = $productos;
	}
	if (!$resultArray) {
		// echo 0;
		return false;
	}
	return json_encode($resultArray);
}

function select($sql, &$mysqli = null)
{
	if (!$mysqli)global $mysqli;
	$result = $mysqli->query($sql);
	foreach($result as $productos){
		$resultArray[] =  $productos;
	}
	return json_encode($resultArray);
}

function insert_pd($mysqli,$scod)
{
    $pedido = mysqli_query($mysqli,"SELECT * FROM pedidos WHERE cod ='$scod' ORDER BY id DESC LIMIT 1");
    $array_pd = mysqli_fetch_array($pedido);
    $id_pedido = $array_pd['id'];
    for ($i=0; $i <count($_SESSION['carrito']) ; $i++) { 
        $id_pd=$_SESSION['carrito'][$i]['id'];
        $cant =$_SESSION['carrito'][$i]['cantidad'];
        mysqli_query($mysqli,"INSERT INTO datos_pedido (id_pedido,id_producto,cantidad) VALUES('$id_pedido','$id_pd','$cant')");
    } 
}
?>