window.addEventListener('load', function () {
    obtenerdt() 
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
    listener();
    btn_mp.style.display = "none"; 
    btn_tf.disabled = true;   
    btn_iz.disabled = true;   
}

function send_data(method,val){
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
        method: "POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            console.log("compra realizada")
            return res.text();
        } else {
            throw "Error weyyyyyy nooooooooooooooo";
        }
    })
    .catch(function (err) {
        console.log(err);
    });
}

function plus(id) {
    const data = new FormData();
    data.append("new-cant", "plus");
    data.append("id", id);
    fetch('car-end.php',{
        method:"POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            obtenerdt();
        }else{
            throw "error"
        }
    })
    .catch(function (err) {
        console.log(err);
    })
}
function minus(id) {
    const data = new FormData();
    data.append("new-cant", "minus");
    data.append("id", id);
    fetch('car-end.php',{
        method:"POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            return res.text();
        }else{
            throw "error"
        }
    })
    .then((res)=>{
        if (res == "0") {
            localStorage.removeItem("carro");
            pd.innerHTML = "<h1>Carro vacio :(</h1>"
        }else{
            console.log(res);
            obtenerdt();
        }
    })
    .catch(function (err) {
        console.error(`error: ${err}`);
    }) 
}
function obtenerdt() {
    if (localStorage.getItem('carro')) {     
        const data = new FormData();
        data.append("car", "data");
        $.ajax({
            url:"car-end.php",
            type:"POST",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // pd.innerHTML = "Cargando...";
            },
            success: function(res){
                const prod = JSON.parse(res);
                let temp = ""; 
                prod.forEach(pd => {
                    temp += `<tr class="trs">
                    <td><img src="../img-products/${pd.img}" alt=""></td>
                    <td>${pd.nombre}</td>
                    <td>${pd.precio}</td>
                    <td id="cantidad">${pd.cantidad}</td>
                    <td>${pd.precio * pd.cantidad}</td>
                    <td><button name="plus" onclick="plus(${pd.id});" class="icon-plus"></button><button name="minus" onclick="minus(${pd.id});" class="icon-minus"></button></td>
                    </tr>`
                })
                pd.innerHTML=temp;
            }
        })
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
        window.location.href = "transfer.php";
    });
    
    btn_iz.addEventListener('click', function(e){
        e.preventDefault();
        send_data("data","izipay");
        window.location.href = "izipay.php";
    });
}