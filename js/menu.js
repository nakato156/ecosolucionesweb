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
        var sl = document.querySelector("#slider");
        sl.style.opacity="1";
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
var width = screen.width;
if (width>1000){
    carrito.style.top="30px";
}

window.addEventListener("scroll", function(a){
    if (width>1000){
        if (window.pageYOffset > altura)  {
            menu.classList.add("fixed");
            carrito.style.background="chartreuse";
            carrito.style.visibility="visible";
            carrito.style.display="block";
            carrito.style.top = "200px";
            
        }else{
            carrito.style.background="transparent";
            menu.classList.remove("fixed");
            carrito.style.top="30px";
        };
    };
});

carrito.addEventListener("click", ()=>{
    location.href ="shoping-car/carrito.php";
})

var search = document.getElementById("buscar");
let sliders = document.getElementById("sliders");

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
var btnAgg = document.getElementById("btn_Agregar");
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
            alerta_carrito();
            console.log("Producto agregado al carro !siiiiiiii......");
        })
        .fail(function(){
            alert("ha ocurrido un error al añadir el producto al carrito");
        })
    })
}
//btnpay
// var dats = document.getElementById("dataUser");

//func ventana modal
var conteiner = document.getElementById("modal");
i=0;
function alerta_carrito() {
    if (i===0) {
        var alerta_prod = document.createElement("div");
        var h3 = document.createElement("h3");
        var p = document.createElement("p");
    
        alerta_prod.setAttribute("class","ventanaCarro");
        h3.setAttribute("class","aviso");
        p.setAttribute("class","parrafo");
    
        conteiner.appendChild(alerta_prod);
        alerta_prod.appendChild(h3);
        alerta_prod.appendChild(p);

        conteiner.style.display="block";
        conteiner.style.top=window.pageYOffset+100+"px";
        h3.innerHTML = "Exito";
        p.innerHTML = "Producto agregado al carrito";
        i=1;
        setTimeout(ocultar, 2300);

    }if(i===1){
        conteiner.style.margin="200px";
        conteiner.style.display="block";
        conteiner.style.top=window.pageYOffset+100+"px";
        setTimeout(ocultar, 2300);
    }
}
function ocultar() {
    conteiner.style.display="none";
}
