<section class="catalogo">
    <?php 
    if(isset($buscar)){
        $busqueda = strtolower($_REQUEST['buscar']);
        $query = mysqli_query($mysqli,"SELECT * FROM productos WHERE nombre LIKE '%".$busqueda."%'");
    }
    else{
        $cat = mysqli_query($mysqli,"SELECT productos.id_categoria, categorias.categoria FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id WHERE categorias.categoria= '$p'");

        $query = mysqli_query($mysqli,"SELECT productos.nombre, productos.precio, productos.oferta, productos.imagen, productos.id_categoria, categorias.categoria FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id WHERE categorias.categoria= '$p'");
    }
    while($res=mysqli_fetch_array($query)){
        $name = $res['nombre'];
        $precio = $res['precio'];
        $oferta = $res['oferta'];
        $img = $res['imagen'];

        if($oferta > 0){
            $desc = $precio - ($precio * $oferta)/100;
            $preciofinal = '<del>'.$precio.'</del><span class="precio">-'.$desc.$divisa.'</span>';
        }else{
            $preciofinal = '<span class="precio">'.$precio.$divisa.'</span>';
        }
    ?>
    <div class="producto">
        <div class="name_producto"><b><?=$name;?></b></div>
        <div><img src="img-products/<?=$img?>" class="img_producto" alt=""></div>
        <?=$preciofinal?>
        <button class="btn btn-warning" id="carrito"><div class="icon-carrito"></div>
        </button>
    </div>
    <?php
    }
    ?>
</section>