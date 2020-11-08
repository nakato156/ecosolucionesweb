var hostLocal = "http://localhost:8000/Page-ecosolwebtel";
var host = "https://ecosolucionesweb.com";
window.addEventListener("load", () => {
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

  function cambiarImg() {
    document.slider.src = imagenes[indiceImg];
    var sl = document.querySelector("#slider");
    sl.style.opacity = "1";
    if (indiceImg < 6) {
      indiceImg++;
    } else {
      indiceImg = 0;
    }
  }
  setInterval(cambiarImg, tiempo);
});

var menu = document.getElementById("menu");
var carrito = document.getElementById("carrito");
var altura = menu.offsetTop;
var width = screen.width;
if (width > 1000) {
  carrito.style.top = "30px";
}

window.addEventListener("scroll", function (a) {
  if (width > 1000) {
    if (window.pageYOffset > altura) {
      menu.classList.add("fixed");
      carrito.style.background = "chartreuse";
      carrito.style.visibility = "visible";
      carrito.style.display = "block";
      carrito.style.top = "200px";
    } else {
      carrito.style.background = "transparent";
      menu.classList.remove("fixed");
      carrito.style.top = "30px";
    }
  }
});

carrito.addEventListener("click", () => {
  location.href = "shoping-car/carrito.php";
});

var search = document.getElementById("buscar");
let sliders = document.getElementById("sliders");

if (search.value != "") {
  sliders.style.display = "none";
}

// seccion de categorias lateral
$(".icon-down").click(function () {
  $(".submenu").children("ul").slideToggle();
});
$("ul").click(function (p) {
  p.stopPropagation();
});

//funciones del boton para agregar al carrito
var btnAgg = document.getElementById("btn_Agregar");
function agregar_carro(idp) {
  $("form").submit(function (e) {
    e.preventDefault();

    var data = $(this).serializeArray();
    data = idp;
    $.ajax({
      url: "shoping-car/carrito.php?id=" + idp + "&cant=1",
      type: "post",
      dataType: "html",
      data: data,
    })
      .done(function () {
        alerta_carrito();
        console.log("Producto agregado al carro !siiiiiiii......");
      })
      .fail(function () {
        alert("ha ocurrido un error al añadir el producto al carrito");
      });
  });
}
//btnpay


//func ventana modal
var conteiner = document.getElementById("modal");
var info = document.getElementById("infoP");
i = 0;
function alerta_carrito() {
  if (i === 0) {
    var alerta_prod = document.createElement("div");
    var h3 = document.createElement("h3");
    var p = document.createElement("p");

    alerta_prod.setAttribute("class", "ventanaCarro");
    h3.setAttribute("class", "aviso");
    p.setAttribute("class", "parrafo");

    conteiner.appendChild(alerta_prod);
    alerta_prod.appendChild(h3);
    alerta_prod.appendChild(p);

    conteiner.style.display = "block";
    conteiner.style.top = window.pageYOffset + 100 + "px";
    h3.innerHTML = "Exito";
    p.innerHTML = "Producto agregado al carrito";
    i = 1;
    setTimeout(ocultar, 2300);
  }
  if (i === 1) {
    conteiner.style.margin = "200px";
    conteiner.style.display = "block";
    conteiner.style.top = window.pageYOffset + 100 + "px";
    setTimeout(ocultar, 2300);
  }
}
function ocultar() {
  conteiner.style.display = "none";
}

function info_producto(id) {
  const data = new FormData();
  data.append("id", id);
  fetch("./routes/infopd.php", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      if (res.ok) {
        return res.json();
      } else {
        throw "Error wey";
      }
    })
    .then(function (info_prod) {
      let img = info_prod.img;
      let nombre = info_prod.nombre;
      let descript = info_prod.descripcion;
      let precio = info_prod.precio;
      let categoria = info_prod.categoria;
      let ficha = info_prod.ficha;
      console.log(info_prod);
      printInfoProd(nombre,descript,precio,categoria,img,ficha);
    })
    .catch(function (err) {
      console.log(err);
    });
}
let r = 0;
function printInfoProd(name,descript,precio,cat,img,ficha) {
  reset(r);
  let infProd = document.createElement("div");
  let cajaP = document.createElement("div");
  let img_infoP = document.createElement("img");
  let h3 = document.createElement("h3");
  let p = document.createElement("p");
  let description = document.createElement("p");
  let x = document.createElement("i");
  
  infProd.setAttribute("class", "infoProd");
  infProd.setAttribute("id", "infoProd");
  cajaP.setAttribute("class", "cajaP");
  img_infoP.setAttribute("src", "img-products/"+img);
  h3.setAttribute("class", "infP");
  p.setAttribute("class", "parrafo");
  description.setAttribute("class", "parrafo description");
  x.setAttribute("class", "icon-plus cerrar");
  
  infoP.appendChild(infProd);
  infProd.appendChild(h3);
  infProd.appendChild(x);
  infProd.appendChild(cajaP);
  cajaP.appendChild(img_infoP);
  cajaP.appendChild(p);
  cajaP.appendChild(description);
  if(cat === "computo" ||  cat === "importaciones"){
    let fichaTecnica = document.createElement("div");
    let viewFT = document.createElement("button");
    let textFT = document.createElement("p");

    fichaTecnica.setAttribute("class","fichaTec");
    viewFT.setAttribute("class","viewFT");
    textFT.setAttribute("class","textFT");
    
    cajaP.appendChild(fichaTecnica)
    fichaTecnica.appendChild(textFT)
    fichaTecnica.appendChild(viewFT)
    
    fichaTecnica.style.width="100%";

    textFT.innerHTML="Ficha tecnca : "
    viewFT.innerHTML="Ver Ficha"

    viewFT.addEventListener("click", ()=>{
      if (ficha == "" || ficha == "undefined") {
        alert("Producto sin ficha tecnica");
      }else{
        window.open(hostLocal+"/fichas-tecnicas doc/"+ficha);
      }
    })
  }

  infoP.style.display = "block";
  if (screen.width <= 590) {
    infProd.style.width = (screen.width-60)+"px";
  }
  h3.style.color = "#000";
  h3.style.padding = "20px";
  h3.innerHTML = name;
  p.innerHTML = "Precio: "+"S/."+precio+"<br>"+"Categoria: "+cat;
  description.innerHTML = descript;
  r = 1;
  console.log(descript);
  x.addEventListener('click',()=>{
    infProd.remove()
    infoP.style.display="none";
    r = 0;
  })
  function reset(r) {
    if(r == 1){
      let resetInfo = document.getElementById("infoProd");
      resetInfo. parentNode. removeChild(resetInfo);
      r = 0;
      return r;
    }else{
      return r;
    }
  }
}