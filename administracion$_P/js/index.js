//https://www.youtube.com/watch?v=nROvY9uiYYk&list=RDMMulfY8WQE_HE&index=16
$(document).ready(function(){
    $('[data-toggle="offcanvas"]').click(function(){
        $("#navigation").toggleClass("hidden-xs");
    });

    var tracking = document.getElementById("tracking");
    var ventas = document.getElementById("ventas");
    var principal = document.getElementById("principal");
});
var dash_hijos = document.getElementById("entradas");

tracking.addEventListener('click', function(){
    $("#dashboard").load("routes/tracking.php");
    eliminar_principal();
    obtenerc();
    buscar();
});

ventas.addEventListener('click', function(){
    $("#dashboard").load("routes/ventas.php");
    eliminar_principal()
    cambios(1,'cambiar');
});


// ENVIAR DATOS
$('#addProducts').submit(function (e) {
    var datos = new FormData($('#addProducts')[0]);
    let url = edit === false ? 'insertpd.php' : 'edit.php';
    $.ajax({
        url: 'php/'+url,
        type: 'POST',
        data: datos,
        contentType: false,
        processData: false,
        success: function (datos){
            console.log(datos)
            $('#addProducts').trigger('reset');
            obtenerc();
            if(url === "edit.php"){
                alert(datos);
                edit = false;
                console.log(edit)
            }
        }
    })
    e.preventDefault()
    console.log(datos);
});

// OBTENER LOS DATOS
function obtenerc(){
    $.ajax({
        url:"php data/mostrarc.php",
        method:"POST",
        success: function(data){
            const comp = JSON.parse(data);
            console.log(comp)
            let tem = "";
            comp.forEach(compras => {
                tem += `
            <tr idc="${compras.id}" class="dataCompras">
                <td class="text-center">${compras.nombres}</td>
                <td>${compras.telf}</td>
                <td>${compras.lugar}</td>
                <td>${compras.email}</td>
                <td>${compras.monto}</td>
                <td>${compras.fecha}</td>
                <td>${compras.codigo}</td>                                   
                <td><input type="text" id="estado" class="estado" value="${compras.status}"></td>                   
            </tr>`
            })
            $("#compras").html(tem);
        }
    })
}

// ACTUALIZAR
function cambios(id,cambio,estado) {
    const data = new FormData();
    data.append("id", id);
    data.append("op", cambio);
    data.append("status", estado);
    fetch("./php data/cambios.php", {
        method: "POST",
        body: data,
    })
    .then(function (res) {
        if (res.ok) {
            return res.text();
          } else {
            throw "Error wey";
          }
    })
    .then(function (msg) {
        obtenerc();
        console.log(msg);
    })
    .catch(function (err) {
        console.log(err);
    })
}
$(document).on('focusout', '.estado', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('idc');
    console.log(id);

    var estado =this;
    estado = estado.value
    if (estado === "pendiente" || estado === "aprobado" || estado === "approved") {
        cambios(id,'update',estado)
    }else{
        alert("el estado debe de ser pendiente u aprobado")
    }
})
// eliminar parte principal
function eliminar_principal() {
    if (!dash_hijos) {
        console.log("ya valio");
    }else{
        principal.removeChild(dash_hijos);
    }
}
// var busquedad = document.getElementById("search");
function buscar() {
    $(document).on('keyup', '#search', function(){
    //     console.log("hola estas escribiendo");
    // })
        var search = this.value;
        const data = new FormData();
        data.append("search", 'buscar');
        data.append("dato", search);

        fetch("./php data/cambios.php",{
            method: "POST",
            body: data,
        })
        .then(function (res) {
            if (res.ok) {
                return res.json();
            }else{
                throw "Ha ocurrido un error";
            }
        })
        .then(function (res) {
            console.log(res)
            let tem = "";
            res.forEach(busqueda => {
                tem += `
            <tr idc="${busqueda.id}" class="dataCompras">
                <td class="text-center">${busqueda.nombres}</td>
                <td>${busqueda.telf}</td>
                <td>${busqueda.lugar}</td>
                <td>${busqueda.email}</td>
                <td>${busqueda.monto}</td>
                <td>${busqueda.fecha}</td>
                <td>${busqueda.codigo}</td>                                   
                <td><input type="text" id="estado" class="estado" value="${busqueda.status}"></td>                   
            </tr>`
            })
            $("#compras").html(tem);
        })
        .catch(function (err) {
            console.log(err)
        })
    })
    // console.log($('#search').val)
}
