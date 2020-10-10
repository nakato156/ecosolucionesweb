window.addEventListener('load', ()=>{

});

function redesS(page,url) {
    if (page=="wa"){
        var dom = ".me";
    }else{
        dom = ".com";
    }
    var url= window.open("https://"+page+dom+"/"+url);
}

// redirirgir a cualquier pagina
function redir(url) {
    var url= window.open(url);
}
function contratarS(c) {
   location.href="./contrato.php/?"+c;
}

function validarEmail(email) {
  if (/^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i.test(email)){
   alert("La dirección de email " + email + " es correcta.");
} else {
    alert("La dirección de email es incorrecta.");
  }
}