<?php 
include "../../configs/config.php";
//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);
mysqli_set_charset($mysqli, "utf8");

if (!$mysqli) {
	echo "No se ha podido conectar con la Base de Datos";
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = mysqli_query($mysqli,"DELETE FROM productos WHERE id ='$id'");

    if (!$result) {
        die("No se ha podido eliminar el producto");
    }
    echo "Producto eliminado satisfactoriamente";
}

if (isset($_POST['id_edit'])) {
    $id_edit = $_POST['id_edit'];
    $edit = mysqli_query($mysqli,"SELECT * FROM productos WHERE id ='$id_edit'");
    if (!$edit) {
        die("No se ha podido eliminar el producto");
    }
    
    $json = array();
    while ($pd = mysqli_fetch_array($edit)) {
        $json[] = array(
            'id' => $pd['id'],
            'nombre' => $pd['nombre'],
            'precio' => $pd['precio'],
            'imagen' => $pd['imagen'],
            'categoria' => $pd['id_categoria'],
            'description' => $pd['descripcion']
        );
    }
    $jsonstr = json_encode($json[0]);
    echo $jsonstr;
}

?>