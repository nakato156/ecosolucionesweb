<?php
$host_mysql="localhost";
$user_mysql="root";
$pass_mysql="";
$bd_mysql="ecosol";
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

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
		return $email;
	}else{
		die("email no valido");
	}
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

function connect(){
	$host_mysql="localhost";
	$user_mysql="root";
	$pass_mysql="";
	$bd_mysql="ecosol";

	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
	return $mysqli;
}
?>