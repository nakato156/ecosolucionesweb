<?php
include "../configs/config.php";
include "../configs/funciones.php";
if (isset($enviar)) {
	$username = clear($username);
	$password = clear($password);
	
	//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

	//consulta a la base de datos
	$q = mysqli_query( $mysqli,"INSERT INTO cliente (username,pass) VALUES ('$username','$password')");
    echo "registrado bro";
    
    $user = mysqli_query($mysqli,"SELECT * FROM cliente WHERE username='$username' and pass='$password'");
    $_SESSION['user'] = $user;
    redir("/principal.php");
}
	?>
	<center>
		<form method="post" action="">
			<div class="centrarLogin">
				<label><h2><i class="fa fa-key"></i>Registrate</h2></label>
				<div class="form">
					<input type="text" class="form-control" placeholder="Usuario" name="username"/>		
				</div>
				<div class="form">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>
				<div class="form">
					<button class="btn" name="enviar" type="submit"><i class="sing"></i>Registrarse</button>
				</div>
			</div>	
		</form>
	</center>