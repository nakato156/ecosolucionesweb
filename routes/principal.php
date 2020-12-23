<section class="catalogo">
    <?php
    if(isset($buscar)){
        $busquedad = $_REQUEST['buscar'];
        $sql = NonQuery("SELECT * FROM productos WHERE nombre LIKE '%".$busquedad."%'");
        $sql = json_decode($sql,true);
    }
    else{
        $sql = select("SELECT*FROM productos");
        $sql = json_decode($sql,true);
    }
    for($x=0;$x<count($sql); $x++){
        $id = $sql[$x]['id'];
        $name = $sql[$x]['nombre'];
        $precio = $sql[$x]['precio'];
        $oferta = $sql[$x]['oferta'];
        $img = $sql[$x]['imagen'];

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