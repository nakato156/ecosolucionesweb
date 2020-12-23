<?php
$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="ecosol";

$mysqli = new mysqli($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

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
	for ($i=0; $i <count($datos) ; $i++) { 
		if (!$datos[$i]!="") {
			http_response_code(400);
		}
	}
	$validar = validarEmail($datos[3]);
	return $validar;
}
function redir($var){
	?>
	<script>
		window.location = "<?=$var?>";
	</script>
	<?php
	die();
}
function check_user($url){
	if (!isset($_SESSION['id_cliente'])) {
		redir("?p=login&return=$url"."s");
	}else{
		
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

?>