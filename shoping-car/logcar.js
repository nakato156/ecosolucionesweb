window.addEventListener('load', function () {
    obtenerdt();
});
var pd = document.getElementById("pd-car");
var form_mp=document.getElementById('mp');
var form = document.getElementById('dataUser');

let nombre = form.nombre;
let telf = form.telf;
let direccion = form.direccion;
let email = form.email;

let btn_mp = document.getElementById('mp');
let checkbox = document.getElementById('btn-tyc');
let btn_tf = document.getElementById('transfer');
let btn_iz = document.getElementById('izipay');

disabled();
checkbox.addEventListener('change', function() {        
    if(nombre.value !="" & telf.value !="" & direccion.value!="" & email.value!=""){
        if(this.checked) {
            btn_tf.disabled = false;   
            btn_iz.disabled = false;   
            btn_mp.style.display = "block";  
            listener()
        }else{
            disabled();
        }
    }else{
        checkbox.checked=false;
        disabled();
        alert("debe llenar todos los campos")
    }
})
function disabled() {
    btn_mp.style.display = "none"; 
    btn_tf.disabled = true;   
    btn_iz.disabled = true;   
}

function send_data(method,val){
    let pag = val == "izipay" ? val : val== "" ? "" : "transfer";
    let name = nombre.value;
    let dir = direccion.value;
    let mail = email.value;
    let telf = document.getElementById('telf');
    let number = telf.value;

    const data = new FormData();
    data.append(method, val);
    data.append("nombre", name);
    data.append("lugar", dir);
    data.append("correo", mail);
    data.append("telf", number);

    fetch("car-end.php", {
        method: "post",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            localStorage.removeItem('carro');
            console.log("compra realizada")
            if(!pag == ""){
                window.location.href = `${pag}.php`;
            }
        } else {
            alert("Hay un dato No valido");
            throw `Error: ${res.status} ${res.statusText}`;
        }
    })
    .catch(function (err) {
        console.error(err);
    });
}

async function plus(id,element) {
    const data = new FormData();
    data.append("new-cant", "plus");
    data.append("id", id);
    const res = await fetch('car-end.php',{
        method:"post",
        body: data,
    }).catch(function (err) {
        console.error(err);
    })
    if (res.ok) {
        let parse = parseInt(element.innerHTML);
        let total = element.parentElement.childNodes[5];
        let t = parseInt(total.innerHTML)
        let c =element.innerHTML = parse +1;  
        element.parentElement.childNodes[9].innerHTML = t *c;  
    }else{
        throw "error"
    }
}
async function minus(id,element) {
    const data = new FormData();
    data.append("new-cant", "minus");
    data.append("id", id);
    const res = await fetch('car-end.php',{
        method:"POST",
        body: data,
    })
    const car = await res.text();
    if (car == "0") {
        pd.innerHTML = "<h1>Carro vacio :(</h1>"
        localStorage.removeItem("carro");
    }else{
        let parse = parseInt(element.innerHTML);
        if (parse == 1) {
            element.parentNode.parentNode.removeChild(element.parentNode);
        }else{
            let total = element.parentElement.childNodes[5];
            let t = parseInt(total.innerHTML)
            let c =element.innerHTML = parse -1;  
            element.parentElement.childNodes[9].innerHTML = t *c;  
        }  
    }
}
async function obtenerdt() {
    if (localStorage.getItem('carro')) {     
        const data = new FormData();
        data.append("car", "data");

        await fetch("car-end.php",{
            method: "post",
            body: data,
        })
        .then(function (res){
            return res.json();

        })
        .then(function (res){
            temp = "";
            res.forEach(pd => {
                temp += `<tr class="trs" pdId="${pd.id}">
                <td><img src="../img-products/${pd.img}" alt=""></td>
                <td>${pd.nombre}</td>
                <td>${pd.precio}</td>
                <td id="cantidad" class="cant">${pd.cantidad}</td>
                <td>${pd.precio * pd.cantidad}</td>
                <td><button id="plus" name="plus" style="width:20px; height:20px" class="icon-plus plus"></button><button id="minus" name="minus" style="width:20px; height:20px" class="icon-minus minus"></button></td>
                </tr>
                `
            })
            pd.innerHTML = temp
            c()
        })
        .catch(err=>console.error(err))
    }else{
            pd.innerHTML = "<h1>Carrito vacio :(</h1>";
    }
}
function listener() {
    form_mp.addEventListener('submit', function(e){
        e.preventDefault();
        send_data("mp_data","");
    });

    btn_tf.addEventListener('click', function(e){
        e.preventDefault();
        send_data("data","transferencia");
    });
    
    btn_iz.addEventListener('click', function(e){
        e.preventDefault();
        send_data("data","izipay");
    });
}
function c() {
    let btnPlus = document.getElementsByClassName('plus');
    let btnMinus = document.getElementsByClassName('minus');
    for (let i = 0; i < btnPlus.length; i++) {
        btnPlus[i].addEventListener('click', function (e) {
            let btn = this.parentElement.parentElement;
            let cant = btn.childNodes[7]; //devuelve el elemento <td>
            let id = btn.getAttribute('pdId');
            plus(id,cant);
        });
        btnMinus[i].addEventListener('click', function (e) {
            let btn = this.parentElement.parentElement;
            let cant = btn.childNodes[7]; //devuelve el elemento <td>
            let id = btn.getAttribute('pdId');
            minus(id,cant);
        }) ;
    }
}
function addLocalStorage(producto){
    let ls =localStorage
    ls.setItem('productos',JSON.stringify(producto))
}

function getLS(){
    let ls =localStorage
    if(ls.getItem('productos')){
        let listPd= ls.getItem('productos')
        pds = JSON.parse(listPd)
        return pds
    }
}
