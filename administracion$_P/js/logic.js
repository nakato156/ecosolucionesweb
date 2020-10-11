$(document).ready(function() {
	let edit = false;
	obtenerd()
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
				obtenerd();
				if(url === "edit.php"){
					alert(datos);
					edit = false;
				}
			}
		})
		e.preventDefault()
		console.log(datos)
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
					<td class="text-center">
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
							</label>
						</div>
					</td>
					<td class="img_carro"><img src="../img-products/${pd.imagen}"></td>
					<td>${pd.name}</td>
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
				
			});
		}
	});

	$(document).on('click', '.btn-edit' ,function(){
		let element = $(this)[0].parentElement.parentElement;
		let id_edit = $(element).attr('idp');
	
		$.post('php/eliminarpd.php', {id_edit}, function(res){
			const prod = JSON.parse(res);
			$('#nombre').val(prod.nombre);
			$('#txt-img').val("aun no disponible");
			// $('#img').val(prod.imagen);
			$('#precio').val(prod.precio);
			$('#categoria').val(prod.categoria);
			$('#idn').val(prod.id);
			edit = true;
		});
	})
})