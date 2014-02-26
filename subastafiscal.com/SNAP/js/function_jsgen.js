
function select_tipopersona(valor){
	var htmlline;
	
	if 	(valor == 'N'){
		//Natural
		
		//Cedula
		document.getElementById('cedula').innerHTML = "Cédula:";
		//Nombre / Empresa
		document.getElementById('nombre').innerHTML = "Nombre Completo:";
		
		//Tipo Identificacion
		htmlline = '<select name="nacionalidad" class="seleccion1">';
		htmlline += '<option value="V" selected>V</option>';
		htmlline += '<option value="E">E</option>';
		htmlline += '</select>';
		document.getElementById('tipoidentificacion').innerHTML = htmlline;
		
		//Contribuyente
		document.getElementById('tipocontribuyentename').innerHTML = ''
		document.getElementById('tipocontribuyentevalor').innerHTML = '';
	
	}else{
		
				
		//Juridica
		//Cedula
		document.getElementById('cedula').innerHTML = "Rif:";
		//Nombre / Empresa
		document.getElementById('nombre').innerHTML = "Empresa:";
		
		//Tipo Identificacion
		htmlline = '<select name="nacionalidad" class="seleccion1">';
		htmlline += '<option value="J" selected>J</option>';
		htmlline += '</select>';
		document.getElementById('tipoidentificacion').innerHTML = htmlline;
		
		//Contribuyente
		htmlline ='<span class="textformulario">Tipo Contribuyente:</span>';
		document.getElementById('tipocontribuyentename').innerHTML = htmlline;
		
		htmlline ='<select name="tipo_contribuyente" class="seleccion">';
		//htmlline +='<option value="">[Seleccione]</option>';
		htmlline +='<option value="0" selected>Ordinario</option>';
		htmlline +='<option value="1">Especial</option>';
		htmlline +='</select>';
		document.getElementById('tipocontribuyentevalor').innerHTML = htmlline;
		
	} 
}

function cambiaSelect(valor,objectdiv,acc){
	
	var request = $.ajax({
		type: "POST",
  		data: {accionpage:acc,codreg:valor},
		dataType:"html",
		url: "lib/function_gen.php",
		success: function(data){
			//alert(data);
			$("#"+objectdiv).html(data);
		},
		fail:function(jqXHR, textStatus) { 
		//alert( "Request failed: " + textStatus ); 
		}
					
	});
}		
