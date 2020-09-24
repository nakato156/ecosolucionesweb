<?php
if(isset($_SESSION['id_cliente'])) {
	redir("?p=principal");
}

if (isset($enviar)) {
	$username = clear($username);
	$password = clear($password);
	$telefono = clear($telefono);
	$email = clear($email);
	
	//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

	//consulta a la base de datos
	$q = mysqli_query( $mysqli,"INSERT INTO cliente (username,password,telf,email) VALUES ('$username','$password','$telefono','$email')");
	alert(1,"Te has registrado exitosamente",1,"productos");
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
					<input type="number" class="form-control" placeholder="telefono" name="telefono"/>
				</div>
				<div class="form">
					<input type="email" class="form-control" placeholder="correo electronico" name="email"/>
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
