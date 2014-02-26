var caramo=1;
function nuevoAjax(){
	var xmlhttp=false;
	 try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
	  try {
	   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
	   xmlhttp = false;
	  }
	 }

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
	}

	function cambiarDisplay(id) {
		  if (!document.getElementById) return false;
		  
		  fila = document.getElementById(id);
		  
		  if (fila.style.display != "none") {
		    fila.style.display = "none"; //ocultar fila 
		  } else {
		    fila.style.display = ""; //mostrar fila 
		  }
	}

	function gup(name){
		var regexS = "[\\?&]"+name+"=([^&#]*)";
		var regex = new RegExp ( regexS );
		var tmpURL = window.location.href;
		var results = regex.exec( tmpURL );
		
		if( results == null ){
			return"";	
		}
		else{
			return results[1];
		}
	}

	function validar_modulo(varurl,modimg){
		var modulo;
		var modmos;
		
		modulo=gup(varurl);
		mostrar(modulo);
	}

	function mostrar(id){
		if (!document.getElementById) return false;
		fila = document.getElementById(id);
		fila.style.display = ""; //mostrar fila 	
	}

	function ocultar(id){
		if (!document.getElementById) return false;
		fila = document.getElementById(id);
		fila.style.display = "none";
	}

//scripts en AJAX (con jabon) jejeje
	
	function calcular_fecha(mesid,anioid,contenedorid,textid){
		var ani;
		var mesa;
		var contenedor;
		var cadena;
		
		anio=document.getElementById(anioid);
		mesas=document.getElementById(mesid);
		ani=anio.value;
		mesa=mesas.value;		
		contenedor=document.getElementById(contenedorid);
		ajaxcalendarcalc=nuevoAjax();
		ajaxcalendarcalc.open("POST","mods/calendarioajax.php",true);
		ajaxcalendarcalc.onreadystatechange=function() {
			if (ajaxcalendarcalc.readyState==4){
				cadena=ajaxcalendarcalc.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendarcalc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendarcalc.send("calcularfecha=true&mescalc=" + mesa + "&aniocalc=" + ani + "&txtbox=" + textid);
	}
	
	function mostrar_evento(fecha){
		var contenedor=document.getElementById("contenedorfecha");
		var cadena;
		ajaxcalendareve=nuevoAjax();
		ajaxcalendareve.open("POST","calendarioajax.php",true);
		ajaxcalendareve.onreadystatechange=function() {
			if (ajaxcalendareve.readyState==4){
				cadena=ajaxcalendareve.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendareve.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendareve.send("calcularevento=true&fecha=" + fecha);
	}

	function mostrar_evento2(fecha){
		var contenedor=document.getElementById("contenedorfecha");
		var cadena;
		ajaxcalendareve2=nuevoAjax();
		ajaxcalendareve2.open("POST","calendarioajax.php",true);
		ajaxcalendareve2.onreadystatechange=function() {
			if (ajaxcalendareve2.readyState==4){
				cadena=ajaxcalendareve2.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		ajaxcalendareve2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajaxcalendareve2.send("calcularevento=true&fecha=" + fecha);
	}
	
	function escribir_fecha(idtext,iddia,idmes,idanio){
		var contenedor=document.getElementById(idtext);
		var cadenafecha;
		
		cadenafecha=idanio + "-" + idmes + "-" + iddia;
		contenedor.value=cadenafecha;
	}
	
	function escribir_fecha_txt(desde,hasta){
		var desdetxt=document.getElementById(desde).value;
		var hastatxt=document.getElementById(hasta);
		
		hastatxt.value=desdetxt;		
	}
	
	function tecla(e){
		if(window.event)keyCode=window.event.keyCode;
		else if(e) keyCode=e.which;
		
		return keyCode;
	}	
	
	function ingresarprod(e,codigo,factura,cantidad){
		var txtbox=document.getElementById(codigo);
		var codigo=document.getElementById(codigo).value;
		var facturan=document.getElementById(factura).value;
		var txtcantidad=document.getElementById(cantidad).value;
		
		ajaxingreso=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxingreso.open("POST","mods/opciones.php",true);
			ajaxingreso.onreadystatechange=function() {
				if (ajaxingreso.readyState==4) {
					cadena=ajaxingreso.responseText;
					txtbox.value='';
					if(cadena!=''){
						alert(cadena);
					}
			 	}
			}
			
			ajaxingreso.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxingreso.send("ingresarprod=true&codigo="+codigo+"&factura="+facturan + "&cantidad="+txtcantidad);	
		}
	}
	
	function validarnombre(e,nombre){
		var txtbox=document.getElementById(nombre);
		var txtnombre=document.getElementById(nombre).value;
		
		ajaxrnombre=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxrnombre.open("POST","mods/opciones.php",true);
			ajaxrnombre.onreadystatechange=function() {
				if (ajaxrnombre.readyState==4) {
					cadena=ajaxrnombre.responseText;
					txtbox.value='';
					if(cadena!=''){
						alert(cadena);
					}
			 	}
			}
			
			ajaxrnombre.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrnombre.send("revisarnombre=true&nombre="+txtnombre);	
		}
	}
	
	function actualizarlista(e,factura,contenedorid){
		var txtfactura=document.getElementById(factura).value;
		var contenedor=document.getElementById(contenedorid);
		var contenedortxt=document.getElementById('montocomp');
		
		ajaxrlista=nuevoAjax();
		teclap=tecla(e);
		if(teclap==13){
			ajaxrlista.open("POST","mods/opciones.php",true);
			ajaxrlista.onreadystatechange=function() {
				if (ajaxrlista.readyState==4) {
					cadena=ajaxrlista.responseText;
					contenedor.innerHTML=cadena;
			 	}
			}
			
			ajaxrlista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrlista.send("updatelist=true&idfactura="+txtfactura);
			
			ajaxrmonto.open("POST","modulos/opciones.php",true);
			ajaxrmonto.onreadystatechange=function() {
				if (ajaxrmonto.readyState==4) {
					cadena=ajaxrmonto.responseText;
					contenedortxt.value=cadena;
			 	}
			}
			
			ajaxrmonto.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxrmonto.send("updatemonto=true&idfactura="+txtfactura);
		}		
	}
	
	function cambiarselect(categoria,idcontenedor){
		var contenedor=document.getElementById(idcontenedor);
		ajaxrselecti=nuevoAjax();
		ajaxrselecti.open("POST","mods/opciones.php",true);
		ajaxrselecti.onreadystatechange=function() {
				if (ajaxrselecti.readyState==4) {
					cadena=ajaxrselecti.responseText;
					contenedor.innerHTML=cadena;
			 	}
				else{
					contenedor.innerHTML="ESPERE...";
				}
			}
			
		ajaxrselecti.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxrselecti.send("cambiarselect=true&categoria="+categoria);
	}
	
	function selectdes(categoriass,marcad,contid){
		var contenedorw=document.getElementById(contid);
		ajaxcambiara=nuevoAjax();
		ajaxcambiara.open("POST","mods/opciones.php",true);
		ajaxcambiara.onreadystatechange=function() {
				if (ajaxcambiara.readyState==4) {
					cadenah=ajaxcambiara.responseText;
					contenedorw.innerHTML=cadenah;
			 	}
				else{
					contenedorw.innerHTML="ESPERE...";
				}
			}
			
		ajaxcambiara.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxcambiara.send("selectotro=true&categoria="+categoriass+"&marca="+marcad);
	}
	
	function escribir_prod(codigo,variable,contenedorid,contenedoriddos){
		var contenedorw=document.getElementById(contenedorid);
		var contenedorx=document.getElementById(contenedoriddos);
		contenedorw.value=variable;
		contenedorx.value=codigo;
	}
	
	function mostrarinfp(e){
		var codigofab=document.getElementById('nomcodigo').value;
		var nombredelprod=document.getElementById('nombreprodu');
		var categoria=document.getElementById('nomcateg');
		var marca=document.getElementById('nommarca');
		var descripcion=document.getElementById('nomdesc');
		var precio=document.getElementById('precioart');
		var cantidad=document.getElementById('cantiart');
		
		ajaxmostrarp=nuevoAjax();
		ajaxmostrarp.open("POST","mods/opciones.php",true);
		ajaxmostrarp.onreadystatechange=function() {
			if (ajaxmostrarp.readyState==4) {
				cadena=ajaxmostrarp.responseText;
				cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
				result=cadena.split('-');
				nombredelprod.value=result[0];
				categoria.value=result[1];
				marca.value=result[2];
				descripcion.value=result[3];
				precio.value=result[4];
				cantidad.value=result[5];
		 	}
		}
		
		ajaxmostrarp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxmostrarp.send("mostrarinfoprod=true&codigoprod="+codigofab);	
	}
	
	function mostrarinfopersona(e){
		var cedularif=document.getElementById('cedularif').value;
		var nombre=document.getElementById('nomusrio');
		var apellido=document.getElementById('apeusrio');
		var telefono=document.getElementById('telef');
		var direccion=document.getElementById('direxion');
		var email=document.getElementById('email');
			teclap=tecla(e);
			ajaxmostrarp=nuevoAjax();
			ajaxmostrarp.open("POST","mods/opciones.php",true);
			ajaxmostrarp.onreadystatechange=function() {
				if (ajaxmostrarp.readyState==4) {
					cadena=ajaxmostrarp.responseText;
					cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
					result=cadena.split('-');
					nombre.value=result[0];
					apellido.value=result[1];
					telefono.value=result[2];
					direccion.value=result[3];
					email.value=result[4];
			 	}
			}
			
			ajaxmostrarp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajaxmostrarp.send("mostrarinfoclient=true&cedulacli="+cedularif);
	}

	function bloq_num(e){
		teclap=tecla(e);
		teclan=chr(teclap);
		if(IsNumeric(teclan)==false){
			alert("Solo está peritido escribir numeros");
		}
	}
	
	function cambiarselectinv(categoria,idcontenedor){
		var contenedor=document.getElementById(idcontenedor);
		ajaxrselecti=nuevoAjax();
		ajaxrselecti.open("POST","mods/opciones.php",true);
		ajaxrselecti.onreadystatechange=function() {
				if (ajaxrselecti.readyState==4) {
					cadena=ajaxrselecti.responseText;
					contenedor.innerHTML=cadena;
			 	}
				else{
					contenedor.innerHTML="ESPERE...";
				}
			}
			
		ajaxrselecti.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxrselecti.send("cambiarselectinv=true&categoria="+categoria);
	}
	
	function selectdesinv(categoriass,marcad,contid){
		var contenedorw=document.getElementById(contid);
		ajaxcambiara=nuevoAjax();
		ajaxcambiara.open("POST","mods/opciones.php",true);
		ajaxcambiara.onreadystatechange=function() {
				if (ajaxcambiara.readyState==4) {
					cadenah=ajaxcambiara.responseText;
					contenedorw.innerHTML=cadenah;
			 	}
				else{
					contenedorw.innerHTML="ESPERE...";
				}
			}
			
		ajaxcambiara.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxcambiara.send("selectotroinv=true&categoria="+categoriass+"&marca="+marcad);
	}
	
	function buscarcliente(cliente,contenedorid){
		var contenedorw=document.getElementById(contenedorid);
		var clientedat=document.getElementById(cliente).value;
		
		ajaxclientep=nuevoAjax();
		ajaxclientep.open("POST","mods/opciones.php",true);
		ajaxclientep.onreadystatechange=function() {
			if(ajaxclientep.readyState==4){
				cadena=ajaxclientep.responseText;
				cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
				contenedorw.innerHTML=cadena;
		 	}
			else{
				contenedorw.innerHTML="<SELECT><OPTION>ESPERE...</OPTION></SELECT>";
			}
		}
		
		ajaxclientep.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxclientep.send("buscarclientes=true&datocliente=" + clientedat);
	}
	
	function borrar_texto(contendorid){
		var contenedorw=document.getElementById(contendorid);
		
		contenedorw.value='';
	}
	
	function vertodosclientes(contenedorid){
		var contenedorw=document.getElementById(contenedorid);

		ajaxvertodos=nuevoAjax();
		ajaxvertodos.open("POST","mods/opciones.php",true);
		ajaxvertodos.onreadystatechange=function() {
			if(ajaxvertodos.readyState==4){
				cadena=ajaxvertodos.responseText;
				cadena=cadena.replace(/\s*[\r\n][\r\n \t]*/g, "");
				contenedorw.innerHTML=cadena;
		 	}
		}
		
		ajaxvertodos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxvertodos.send("vertodosclientes=true");
	}
	
	function escribir_datos_clientes(cedula,email,nombre,apellido,direccion,telefono){
		var txtcedula=document.getElementById('cedularif');
		var txtemail=document.getElementById('email');
		var txtnombre=document.getElementById('nomusrio');
		var txtapellido=document.getElementById('apeusrio');
		var txtdireccion=document.getElementById('direxion');
		var txttelefono=document.getElementById('telef');
		txtcedula.value=cedula;
		txtemail.value=email;
		txtnombre.value=nombre;
		txtapellido.value=apellido;
		txtdireccion.value=direccion;
		txttelefono.value=telefono;
	}
	
	
	function guardar_var(nomvar,content,idcontenedor){
		var txtcedula=document.getElementById(idcontenedor).value;
		var contenedor=document.getElementById(idcontenedor);		
		ajaxguardar=nuevoAjax();
		ajaxguardar.open("POST","mods/opciones.php",true);
		ajaxguardar.onreadystatechange=function() {
			if(ajaxguardar.readyState==4){
				cadena=ajaxguardar.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		
		ajaxguardar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxguardar.send("guardarvariable=true&contenido=" + txtcedula  + "&variable=" + nomvar);
	}
	
	function enviaremailpcontacto(){
		var txtnombre=document.getElementById('nombrepc').value;
		var txtapellido=document.getElementById('apellidopc').value;
		var txttelefono=document.getElementById('telefonopc').value;
		var txtemail=document.getElementById('emailpc').value;
		var txtmensaje=document.getElementById('mensajepc').value;

		ajaxenviarc=nuevoAjax();
		ajaxenviarc.open("POST","mods/opciones.php",true);
		ajaxenviarc.onreadystatechange=function() {
			if(ajaxenviarc.readyState==4){
				cadena=ajaxenviarc.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		
		ajaxenviarc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxenviarc.send("enviaremailcontactopc=true&nombre=" + txtnombre  + "&apellido=" + txtapellido + "&telefono=" + txttelefono + "&email=" + txtemail + "&mensaje=" + txtmensaje);
	}
	
	function enviaremailpcontactohome(){
		var txtnombre=document.getElementById('nombre').value;
		var txtapellido=document.getElementById('apellido').value;
		var txttelefono=document.getElementById('telefono').value;
		var txtemail=document.getElementById('email').value;
		var txtmensaje=document.getElementById('mensaje').value;

		ajaxenviarc=nuevoAjax();
		ajaxenviarc.open("POST","mods/opciones.php",true);
		ajaxenviarc.onreadystatechange=function() {
			if(ajaxenviarc.readyState==4){
				cadena=ajaxenviarc.responseText;
				contenedor.innerHTML=cadena;
		 	}
		}
		
		ajaxenviarc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajaxenviarc.send("enviaremailcontacto=true&nombre=" + txtnombre  + "&apellido=" + txtapellido + "&telefono=" + txttelefono + "&email=" + txtemail + "&mensaje=" + txtmensaje);
	}