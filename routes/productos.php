<section class="catalogo">
    <?php 
    if(isset($buscar)){
        $busquedad = $_REQUEST['buscar'];
        $sql = mysqli_query($mysqli,"SELECT * FROM productos WHERE nombre LIKE '%".$busquedad."%'");
    }
    else{
        if(isset($p)){
            if ($_REQUEST['p'] == "principal") {
                $sql = mysqli_query($mysqli,"/*qcon*/" ."SELECT * FROM productos");
            }else{                
                $sql = mysqli_query($mysqli,"SELECT productos.id, productos.nombre, productos.precio, productos.oferta, productos.imagen, productos.id_categoria, categorias.categoria FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id WHERE categorias.categoria= '$p'");
            }
        }else{
            $sql = mysqli_query($mysqli,"/*qc=on*/" ."SELECT * FROM productos");
        }
    }
    while($res=mysqli_fetch_array($sql)){
        $id = $res['id'];
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
    <form style="display:inline-flex;">
    <div class="producto">
        <div class="name_producto" id="nombre"><b><?=$name;?></b></div>
        <div><img onclick="info_producto(<?=$id?>)" src="img-products/<?=$img?>" id="img" class="img_producto" alt="<?="ecosolwebtel_".$name?>"></div>
        <div class ="precio" id="precio"><?=$preciofinal?></div>
        <button type="submit" class="btn" id="btn_Agregar" onclick="agregar_carro('<?=$id;?>');"><div class="icon-carrito"></div><div class="añd" >Añadir al carrito</div>
        </button>
    </div>
    </form>
    <?php
    }
    ?>
</section>