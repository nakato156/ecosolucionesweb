<?php
include "../configs/config.php";
include "../configs/funciones.php";

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username=$_POST['username'];
        $password = $_POST['password'];
        if ($username!="" && $password!="") {
            //variable de la base de datos
            $mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
        
            //consulta a la base de datos
            $q = mysqli_query( $mysqli,"SELECT * FROM adminsp WHERE username='$username' and pass='$password'");
        
            if ($q->num_rows >0) { //verificar si existe el usuario
                $r = mysqli_fetch_array($q);
                session_start();
                $_SESSION['chika'] = $r['id'];
                header("location: modled.php");
            }else{ //si no existe el usuario manda una alerta
                ?>
                <script>
                    alert("los datos son incorrectos");
                </script>
                <?php
                // header("location: ");
            }
        }else{
            ?>
            <script>
                alert("Debe llenar todos los campos");
            </script>
            <?php
        }      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administracion</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/styles-in.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
</head>
<body>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Panel de administracion Ecosol</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <h3 class="text-center text-info">Login</h3>
                        <form method="post" id="login-form" class="form" action="">
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <button name="enviar" type="submit" class="btn btn-info btn-md">Iniciar<button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</body>
</html>