<?php
if(isset($_SESSION['id_cliente'])) {
	redir("?p=principal");
}

if (isset($enviar)) {
	$username = mysqli_real_escape_string($mysqli, clear($username));
	$password = mysqli_real_escape_string($mysqli, clear($password));
	
	//variable de la base de datos
	$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

	//consulta a la base de datos
	$q = mysqli_query( $mysqli,"SELECT * FROM cliente WHERE username='$username' and password ='$password'");

	if ($q->num_rows >0) { //verificar si existe el usuario
		$r = mysqli_fetch_array($q);
		$_SESSION['id_cliente'] = $r['id'];
		
		if(isset($return)){
			alert(9,"Bienvenido ".$r['username']." a Organic Home",1,"productos");
			die();
		}else{
			alert(9,"Bienvenido ".$r['username']." a Organic Home",1,"productos");
			die();
		}
	}else{ //si no existe el usuario manda una alerta
		alert(0,"los datos son incorrectos",0,"login");
		die();
	}

}
	?>


	<center>
		<form method="post" action="">
			<div class="centrarLogin">
				<label><h2 class="is"><i class="fa fa-key"></i>Iniciar sesion</h2></label>
				<div class="form">
					<input type="text" class="form-control ingres" placeholder="Usuario" name="username"/>		
				</div>
				<div class="form">
					<input type="password" class="form-control ingres" placeholder="Contraseña" name="password"/>
				</div>
				<div class="form">
					<button class="btn" name="enviar" type="submit"><i class="sing"></i>ingresar</button>
				</div>
				<div class="form">
					<a class="reg" href="?p=registro">Registrate</a>
				</div>
			</div>	
		</form>
	</center>

