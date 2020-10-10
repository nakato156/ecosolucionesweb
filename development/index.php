<?php
if (!isset($_REQUEST['p'])) {
    $p = "developer";
}else{
    $p = $_REQUEST['p'];
    if ($p =="") {
        $p = "developer";
    }else{
        $p = $_REQUEST['p'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <title>Area de Desarrollo</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="../styles.css"> 
    <!-- <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'> -->
</head>
<body>
    <nav>
        <ul class="smenu">
            <li><i onclick="redesS('fb','ecosolucionesweb')" class="icon-fb mfb"></i></li>
            <li><i onclick="redesS('wa','c/51902658722')" class="icon-wp mwp"></i></li>
            <li><i onclick="redesS('instagram','ecosolucionesweb')" class='bx bxl-instagram minsta'></i></a></li>
        </ul>
        <ul>
            <li>Menu</li>
        </ul>
    </nav>
    <?php 
    if ($p !="developer") {        
        if(file_exists("modules/".$p.".php")) {
            include "modules/".$p.".php";
        }else{
            echo "<i>No se ha encontrado el modulo <i>".$p."</i> <a href='.'>Regresar</a></i>";
        }
        exit;
    }
    ?>
    <section class="cabecera">
        <div class="texto">
            <h1>Plasma todas tus ideas en tu Web</h1><br>
            <h3>Haz realidad todo lo que siempre soñaste, con nuestro equipo profesional en desarrollo y diseño web</h3><br>
            <p>Personal capacitado para todas tus ideas</p>
        </div>
        <div class="imagen">
            <img src="img/img-index.png" alt="desarrollo web">
        </div>
        <div style="overflow: hidden;" class="wave"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M-43.73,12.33 C-79.28,-7.39 386.84,136.67 504.79,14.30 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #dbdbdb;"></path></svg></div>
    </section>
    <section class="servicios">
        <div class="servicio">
            <div><i class="icon-desktop"></i></div>
            <h3>Diseño y Desarrollo Web</h3><br>
            <p>Estamos en una epoca d&iacute;gital donde las paginas son indispensables por eso es hora que tengas una p&aacute;gina profesional y de calidad perfectas para cualquier necesidad, el Desaroollo Web es indispensable .</p><br>
            <button class="btn-servicios" id="btn-service" ><a id="e" href="?p=desarrolloweb" p=>Ver</a></button>
        </div>
        <div class="servicio">
            <div><i class="icon-shop"></i></div>
            <h3>Tiendas Online</h3><br>
            <p>Quieres mudar tu negocio a la web? No hay problema lo hacemos, creamos tiendas online de acuerdo a la necesidad nuestros clientes sea cual sea.</p><br>
            <button class="btn-servicios" id="btn-service" ><a id="e" href="?p=ecomerce">Ver</a></button>
        </div>
        <div class="servicio">
            <div><i class="icon-code"></i></div>
            <h3>Programas a medida</h3><br>
            <p>Deseas un punto de venta, un inventario, un panel de administraci&oacute;n, no hay problema lo hacemos, cualquier cosa que necesites lo desarrollamos sin mas.</p><br>
            <button class="btn-servicios" id="btn-service" ><a id="e" href="#">Ver</a></button>
        </div>
        <div class="servicio">
            <div class="ico"><img src="img/class.png" alt=""></div>
            <h3>Aulas Virtuales</h3><br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum dolore labore maiores optio repellat fugit sapiente. Dolores doloremque officia asperiores modi neque nesciunt quam aliquid! Ipsam sunt inventore perferendis impedit.</p><br>
            <button class="btn-servicios" id="btn-service" ><a id="e" href="?p=classroom">Ver</a></button>
        </div>
    </section>
    <?php
    footer();
    function footer()
    {
    ?>
    <footer>
        <section class="redesS">
            <h3>Redes Sociales</h3>
            <div class="rs fb" onclick="redesS('fb','ecosolucionesweb')"><i class="icon-fb" id="btn-fb" ></i></div>
            <div class="rs wp" onclick="redesS('fb','ecosolucionesweb')"><i class="icon-wp" id="btn-wp" ></i></div>
            <div class="rs insta" onclick="redesS('fb','ecosolucionesweb')"><i class="bx bxl-instagram" id="btn-insta" ></i></div>
        </section>
        <section class="contactos">
            <h3>Contactanos</h3>
            <div><i class='bx bx-mail-send'></i></div>
        <p>administrador@ecosoluciones.com</p>
        </section>
    </footer>
    <script src="js/main.js"></script>
    <?php
    }
    ?>
</body>
</html>