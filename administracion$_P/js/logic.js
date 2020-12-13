$(document).ready(function() {
	let preview = document.getElementById("img");
	// let newImg = document.getElementById("newImg")
	let form = document.getElementById("addProducts");
	let edit = false;
	obtenerd()
	// ENVIAR DATOS
	$('#addProducts').submit(function (e) {
		const datos = new FormData($('#addProducts')[0]);
		let url = edit === false ? 'insertpd.php' : 'edit.php';
		if (verify(edit)) {
			$.ajax({
				url: 'php/'+url,
				type: 'POST',
				data: datos,
				contentType: false,
				processData: false,
				success: function (datos){
					console.log(datos)
					msgAlert(datos);
					$('#addProducts').trigger('reset');
					$('#previewImg').children("div").remove()
					obtenerd();
					if(url === "edit.php"){
						edit = false;
						console.log(edit)
					}
				}
			})
		}else{
			msgAlert("Debe llenar los campos requeridos");
		}
		e.preventDefault()
	});
	// OBTENER LOS DATOS
	function obtenerd(){
		$.ajax({
			url:"php/mostrarp.php",
			method:"POST",
			success: function(data){
				const prod = JSON.parse(data);
				let tem = "";
				prod.forEach(pd => {
					tem += `
				<tr idp="${pd.id}">
					<td class="img_carro"><img src="../img-products/${pd.imagen}"></td>
					<td>${pd.name}</td>
					<td>${pd.descript}</td>
					<td>${pd.precio}</td>
					<td>${pd.categoria}</td>
					<td class="text-center">
						<button class="btn-delete"><span class="btn btn-sm btn-danger glyphicon glyphicon-trash"></span></button>
						<button class="btn-edit"><span class="btn btn-sm btn-primary glyphicon glyphicon-pencil"></span></button>
						<button class="btn-inf"><span class="btn btn-sm btn-warning glyphicon glyphicon-info-sign"></span></button>
					</td>
				</tr>>`
				})
				$("#productos").html(tem)
			}
		})
	}

	$(document).on('click', '.btn-delete' ,function(){
		if (confirm('estas seguro de eliminar este producto?')) {
			let element = $(this)[0].parentElement.parentElement;
			let id = $(element).attr('idp');
	
			$.post('php/eliminarpd.php', {id}, function(res){
				obtenerd();
				console.log(res);
				msgAlert(res);
			});
		}
	});

	$(document).on('click', '.btn-edit' ,function(){
		let element = $(this)[0].parentElement.parentElement;
		let id_edit = $(element).attr('idp');
	
		$.post('php/eliminarpd.php', {id_edit}, function(res){
			const prod = JSON.parse(res);
			$('#nombre').val(prod.nombre);
			$('#descript').val(prod.description);
			$('#txt-img').val(prod.imagen);
			let temp = `
			<div class="preview"><img src="../img-products/${prod.imagen}"></div>
			`;
			let cont = document.getElementById("previewImg");
			cont.innerHTML = temp;
			$('#precio').val(prod.precio);
			$('#categoria').val(prod.categoria);
			$('#idn').val(prod.id);
			edit = true;
		});
	})
	function msgAlert(msg) {
		let content = document.getElementById("alert");
		let div = document.createElement("div");
		let p = document.createElement("p");

		div.setAttribute("class", "col-md-12");
		p.setAttribute("class", "text-center bg-warning well");

		content.appendChild(div);
		div.appendChild(p);

		p.innerHTML = msg;
		// let alert = document.getElementById("nombre");
		// alert.style.background="red";
		setInterval(function(){
			div.remove();
		},4000);
	}
	function verify(accion) {
		if (accion) {
			if (form.nombre.value !="" && form.precio.value !="" && form.categoria.value !="" && form.descripcion.value !="") {
				return true;
			}else{
				return false;
			}
		}else{
			if (form.nombre.value !="" && form.precio.value !="" && form.categoria.value !="" && form.descripcion.value !="" && form.imagen.value !="") {
				return true;
			}else{
				return false;
			}
		}
	}

	preview.addEventListener('change', function () {	
		let txtImg = document.getElementById("txt-img");
		let files = this.files;
		let element;
		let imgSupport = ["image/jpeg", "image/png", "image/jpg"];
		let elementInvalid = false;

		element = files[0];
		if (imgSupport.indexOf(element.type) !=-1) {
			txtImg.value = element.name;
			createPreview(element);
		}else{
			elementInvalid = true;
		}
		if (elementInvalid) {
			alert("Typo de imagen no valida");
		}
	})

	function createPreview(file){
		let imgUrl = URL.createObjectURL(file);
		let temp = `
		<div class="preview"><img src="${imgUrl}"></div>
		`;
		let cont = document.getElementById("previewImg");
		cont.innerHTML = temp;
	}
})