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

function redir($var){
	?>
	<script>
		window.location = "<?=$var?>";
	</script>
	<?php
	die();
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