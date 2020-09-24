window.addEventListener('load', ()=>{
    var imagenes = [];
    imagenes[0] = "img/slider/img-gameboy.jpg";
    imagenes[1] = "img/slider/img-cargador.jpg";
    imagenes[2] = "img/slider/img-cargadormg.jpg";
    imagenes[3] = "img/slider/img-cargadoresmg.jpg";
    imagenes[4] = "img/slider/img-cgAuto.jpg";
    imagenes[5] = "img/slider/img-cgsAutos.jpg";
    imagenes[6] = "img/slider/img-selladores.jpg";

    var indiceImg = 0;
    tiempo = 2000;

    function cambiarImg(){
        document.slider.src = imagenes[indiceImg];
        if(indiceImg < 6){
            indiceImg ++;
        }else{
            indiceImg = 0;
        }
    };    
    setInterval(cambiarImg, tiempo);
});

var menu = document.getElementById("menu");
var carrito = document.getElementById("carrito");
var altura = menu.offsetTop;

window.addEventListener("scroll", function(a){
    if (window.pageYOffset > altura)  {
        menu.classList.add("fixed");
        carrito.style.visibility="visible";
        carrito.style.display="block";
        carrito.style.top = "200px";
        a.stopPropagation();

    }else{
        menu.classList.remove("fixed");
        carrito.style.top="80px";
        carrito.style.visibility="hidden";
    };
});

carrito.addEventListener("click", ()=>{
    location.href ="shoping-car/carrito.php";
})

var search = document.getElementById("buscar");
let sliders = document.getElementById("sliders");
var carrito = document.getElementById("carrito");
if (search.value !="") {
    sliders.style.display="none";
}

// seccion de categorias lateral
$(".icon-down").click(function(){
    $(".submenu").children("ul").slideToggle();
})
$("ul").click(function(p){
    p.stopPropagation();
})

//funciones del boton para agregar al carrito
document.getElementById("btn_Agregar");
function agregar_carro(idp) {
    $("form").submit(function(e){
        e.preventDefault();

    var data = $(this).serializeArray();
    data = idp;
    $.ajax({
        url: 'shoping-car/carrito.php?id='+idp+'&cant=1',
        type: 'post',
        dataType: 'html',
        data: data,
    })
    .done(function(){
        alert("añadido al carrito"+idp);
        console.log("Producto agregado al carro !siiiiiiii......");
    })
    .fail(function(){
        alert("ha ocurrido un error al añadir el producto al carrito");
    })
})
}

