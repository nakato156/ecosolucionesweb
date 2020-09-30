<section class="catalogo">
    <?php 
    $_REQUEST['p'];

    if(isset($buscar)){
        $busqueda = strtolower($_REQUEST['buscar']);
        $query = mysqli_query($mysqli,"SELECT * FROM productos WHERE nombre LIKE '%".$busqueda."%'");
    }
    else{
        if(isset($p)){
            if ($_REQUEST['p'] == "principal") {
                $query = mysqli_query($mysqli,"SELECT * FROM productos");
            }elseif($_REQUEST['p'] == "cat"){
                   header("location:catalogoPDF/catalogo-cosmeticos.pdf");
            }else{                
                $query = mysqli_query($mysqli,"SELECT productos.id, productos.nombre, productos.precio, productos.oferta, productos.imagen, productos.id_categoria, categorias.categoria FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id WHERE categorias.categoria= '$p'");
            }
        }else{
            $query = mysqli_query($mysqli,"SELECT * FROM productos");
        }
    }
    // if(!isset($query)){
    //     header("location")
    //     die();
    // }
    while($res=mysqli_fetch_array($query)){
        $id = $res["id"];
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
        <div><img src="img-products/<?=$img?>" id="img" class="img_producto" alt=""></div>
        <div class ="precio" id="precio"><?=$preciofinal?></div>
        <button type="submit" class="btn" id="btn_Agregar" onclick="agregar_carro('<?=$id;?>');"><div class="icon-carrito"></div><div class="añd" >Añadir al carrito</div>
        </button>
    </div>
    </form>
    <?php
    }
    ?>
</section>