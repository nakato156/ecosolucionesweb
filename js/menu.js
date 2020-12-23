var hostLocal = "http://localhost:8000/Page-ecosolwebtel";
let menu = document.getElementById("menu");
let carrito = document.getElementById("carrito");
let altura = menu.offsetTop;
let width = screen.width;
if (width > 1000) {
  carrito.style.top = "30px";
}

window.addEventListener("scroll", function () {
  if (width > 1000) {
    if (window.pageYOffset > altura) {
      menu.classList.add("fixed");
      carrito.style.background = "#1254a5";
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

//funciones del boton para agregar al carrito
var btnAgg = document.getElementById("btn_Agregar");
async function agregar_carro(idp) {
  $("form").submit(function (e) {
    e.preventDefault();
  });
  localStorage.setItem('carro', idp)
  const data = new FormData();
  data.append("id",idp);
  data.append("cant",1);
  await fetch("shoping-car/car-end.php",{
    method: "POST",
    body: data
  })
  .then(function (res){
    if(res.ok){
      alerta_carrito();
      // console.log(`status: ${res.status} ${res.statusText}`)
      console.log("Producto agregado al carro !siiiiiiii......");
      return;
    }else{ console.error(`error: ${res.status} ${res.statusText}`);return;}
  })
  .catch(err=>console.error(err))
}
//function window modal
var conteiner = document.getElementById("modal");
var info = document.getElementById("infoP");
i = 0;
function alerta_carrito() {
  if (i === 0) {
    let temp = `
    <div class="ventanaCarro">
      <h3 class="aviso">Exitoo</h3>
      <p class="parrafo">Producto agregado al carrito</p>
    </div>
    `;
    conteiner.style.display = "block";
    conteiner.style.top = window.pageYOffset + 100 + "px";
    conteiner.innerHTML = temp;
    i = 1;
    setTimeout(ocultar, 2300);
  }
  if (i === 1) {
    conteiner.style.margin = "200px";
    conteiner.style.display = "block";
    conteiner.style.position = "absolute";
    conteiner.style.top = window.pageYOffset + 100 + "px";
    setTimeout(ocultar, 2300);
  }
}
function ocultar() {
  conteiner.style.display = "none";
}

async function info_producto(id) {
  const data = new FormData();
  data.append("id", id);
  await fetch("./routes/infopd.php", {
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
      printInfoProd(nombre,descript,precio,categoria,img,ficha);
    })
    .catch(function (err) {
      console.log(err);
    });
}
let r = 0;
function printInfoProd(name,descript,precio,cat,img,ficha) {
  reset(r);
  let temp = `
  <div class="infoProd" id="infoProd">
    <h3 class="infP" style="color:#000;padding:20px;">${name}</h3>
    <i class="icon-plus cerrar" id="x"></i>
    <div class="cajaP" id="cajaP">
      <img src="img-products/${img}">
      <p class="parrafo">Precio: S/.${precio}<br>Categoria: ${cat}</p>
      <p class="parrafo description" id="descript">${descript}</p>
      <div id="cajaFT" style="width:100%;bottom:0;"></div>
    </div>
  </div>
  `;
    infoP.innerHTML = temp;
  if(cat === "computo" ||  cat === "importaciones"){
    let FT = `
    <div class="fichaTec" style="width:100%;">
      <p class="textFT">Ficha tecnca :</p>
      <button class="viewFT" id="viewFT">Ver Ficha</button>
    </div>
    `;
    
    let cajaFT = document.getElementById('cajaFT');
    cajaFT.innerHTML=FT;
    viewFT = document.getElementById('viewFT'); 
    viewFT.addEventListener("click", ()=>{
      if (ficha == "" || ficha == "undefined") {
        alert("Producto sin ficha tecnica");
      }else{
        window.open(`${hostLocal}/fichas-tecnicas doc/${ficha}`);
      }
    })
  }
  let infProd = document.getElementById('infoProd');
  let x = document.getElementById('x');
  infoP.style.display = "block";
  if (screen.width <= 590) {
    let wd = infProd.style.width = (screen.width-60)+"px";
    console.log(wd);
  }
  r = 1;
  x.addEventListener('click',()=>{
    infProd.remove()
    infoP.style.display="none";
    r = 0;
  })
  function reset(r) {
    if(r == 1){
      infProd.parentNode.removeChild(infProd);
      r = 0;
      return r;
    }else{
      return r;
    }
  }
}