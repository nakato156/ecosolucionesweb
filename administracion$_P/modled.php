<?php
include "../configs/config.php";
include "../configs/funciones.php";
check_admin();

//variable de la base de datos
$mysqli = mysqli_connect($host_mysql, $user_mysql,$pass_mysql,$bd_mysql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administrativo</title>
    <link rel="stylesheet" href="css/styles-in.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container-fluid adm-archivos">
    <div class="barra row">Administrador de Productos</div><br><br>
    <div class="row">
        <div class="col-md-12">
            <form id="addProducts" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <span><strong><span class="glyphicon glyphicon-hdd"></span> Manejo de archivos</strong>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre del Producto</label>
                                <input type="hidden" id="idn" name="id-p">
                                <input type="text" id="nombre" name="nombre" class="form-control">
                                <label>Precio del Producto</label>
                                <input type="text" id="precio" name="precio" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select class="form-control" id="categoria" name="categoria">
                                        <option value="">Seleccione una categoria</option>
                                    <?php
                                        $categorias=mysqli_query($mysqli,"SELECT * FROM categorias");

                                        while ($rcat=mysqli_fetch_array($categorias)) {
                                        ?>
                                            <option value="<?=$rcat['id'];?>"><?=$rcat['categoria'];?></option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 subir-archivos">
                            <div class="form-group">
                            <label>Descripci&oacute;n del Producto</label>
                            <input type="text" id="descript" name="descripcion" class="form-control">
                            <label>Subir ficha tecnica</label>
                            <div class="input-group">
                                    <span class="input-group-btn"> 
                                        <div class="btn btn-default carga-archivo-input"> 
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="carga-archivo-input-title">Seleccionar ficha</span>
                                            <input type="file" name="ficha" id="FT"/>
                                        </div>
                                    </span>
                                </div>
                                <label>Subir Imagen del Producto</label>
                                <div class="input-group">
                                    <input placeholder="" name="txtImg" id="txt-img" type="text" class="form-control carga-archivo-filename" disabled="disabled">
                                    <span class="input-group-btn"> 
                                        <!-- image-preview-input -->
                                        <div class="btn btn-default carga-archivo-input"> 
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="carga-archivo-input-title">Seleccionar archivo</span>
                                            <input type="file" name="imagen" id="img"/>
                                        </div>
                                    </span>
                                </div>
                                <div class="contPreview"id="previewImg"></div>
                            </div>                                                                    
                        </div>                
                    <button id="addProduct" class="btn btn-primary btn-block">Subir Producto</button>
                </div>
            </form>
            <div id="alert">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <span><strong><span class="glyphicon glyphicon-folder-open"> </span> Archivos</strong></span>
                </div>
                <table class="table table-bordered table-hover vmiddle">
                    <thead>
                        <tr>
                            <th>Img</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id ="productos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script src="js/logic.js"></script>
</html>