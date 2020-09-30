$(document).ready(function() {
	obtenerd()
	// ENVIAR DATOS
	$('#addProducts').submit(function (e) {
		var datos = new FormData($('#addProducts')[0]);

		$.ajax({
			url: 'php/insertpd.php',
			type: 'POST',
			data: datos,
			contentType: false,
			processData: false,
			success: function (datos){
				$('#addProducts').trigger('reset');
				obtenerd();
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
				<tr>
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
						<a><span class="btn btn-sm btn-danger glyphicon glyphicon-trash"></span></a>
						<a><span class="btn btn-sm btn-primary glyphicon glyphicon-pencil"></span></a>
						<a><span class="btn btn-sm btn-warning glyphicon glyphicon-info-sign"></span></a>
					</td>
				</tr>>`
				})
				$("#productos").html(tem)
			}
		})
	} 
})
// ${pd.imagen}