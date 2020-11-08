window.addEventListener('load', ()=>{

});
function services(s) {
    location.href="?"+s;
}
function redesS(page,url) {
    let dom = "";
    if (page=="wa"){
        dom = ".me";
    }else{
        dom = ".com";
    }
    url= window.open("https://"+page+dom+"/"+url);
}

// redirirgir a cualquier pagina exterior
function redir(url) {
    url= window.open(url);
}
function contratarS(c) {
   location.href="./contrato.php/?"+c;
}

function validarEmail(email) {
  if (/^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i.test(email)){
   return true;
} else {
    alert("La dirección de email es incorrecta.");
    return false;
  }
}

// formulario de contrato
var form = document.getElementById("contrato");
if (document.getElementById("pagoMP")) {
    let btnMP = document.getElementById("pagoMP");
    verifi(btnMP,"mp");
}else{
    let btnN = document.getElementById("enviar");
    verifi(btnN,"normal");
}
function datos_service(metodo) {
        // let pagoMP = document.getElementById("pago-mp")
        const data = new FormData(form);
        data.append("method",metodo)
        fetch('../contrato service/contratos_ser.php',{
            method:"POST",
            body: data,
        })
        .then(function (res) {
            if (res.status == 200) {
                return res.text();
            }else{
                throw "Error"
            }
        })
        .then(function (pago) {
            console.log(pago);
            if(pago !== "Mpago" && pago === "exito"){alertaService("Exito",pago);}
        })
        .catch(function (err) {
            console.log(err);
            alertaService("Error",pago)
        })
}
function alertaService(res,msg){
    let msgF = document.getElementById("msgF");
    let contMsg = document.createElement("div");
    let p = document.createElement("p");
    let iconExito = document.createElement("i");
    let color;

    p.setAttribute("class", "mensageF");
    if (res === "Exito") {
        iconExito.setAttribute("class", "bx bx-check");
        color = "#69ff0f";        
    }else{
        iconExito.setAttribute("class", "bx bx-error-circle");      
        color = "#dc1d04";        
    }
    contMsg.setAttribute("class", "alertS");
    
    msgF.appendChild(contMsg);
    contMsg.appendChild(iconExito);
    contMsg.appendChild(p);
    
    msgF.style.display = "block";
    iconExito.style.color = color;
    p.style.fontSize = "18px";
    msgF.style.marginLeft =((window.screen.width/2)-100)+"px";
    p.innerHTML = "<b>"+msg+"</b>";
    setInterval(function (){
        msgF.remove();
        location.href = "..";
    },2500);
}
function verifi(boton,metodo) {
    boton.addEventListener('click', function (e) {
        e.preventDefault();
        
        if (form.nombre.value !="" && form.email.value !=""  && form.servicio.value !=""  && form.telf.value !="") {   
            let email = form.email.value;
            // if (validarEmail(email)){
                datos_service(metodo);
            // }
        } 
        else{
            alert("llena");
        }
    })
}