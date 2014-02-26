function escribir_texto(controld,id){
	var control=document.getElementById(id);
	var controldos=document.getElementById(controld).value;
	
	if(controldos=='100'){
		control.value='26';
	}
	else if(controldos=='120'){
		control.value='30';
	}
	else{
		control.value='20';
	}
}

function preguntar(e){
	if(confirm(e)){
		location.replace("salir.php");
	}
}
	var capa = null;
	var _IE_ = navigator.userAgent.indexOf("MSIE") != -1;
	
	function liberaCapa() {
		capa = null;
	}
	
	function clickCapa(e, obj) {
		capa = obj.parentNode;
		if (_IE_) {
			difX = e.offsetX;
			difY = e.offsetY;
		} else {
			difX = e.layerX;
			difY = e.layerY;
		}
	}
	
	function mueveCapa(e) {
		if (capa != null) {
			capa.style.top = (e.clientY-difY)+"px";
			capa.style.left = (e.clientX-difX)+"px";
		}
	}

	function color_over(celda){ 
	   celda.style.backgroundColor="#EEEEEE";
	   celda.style.color="black";
	} 
	function color_out(celda){ 
	   celda.style.backgroundColor="white";
	   celda.style.color="black";
	}
		
	function cerrar_ventana(e){
		ocultar(e);
	}
	
	function minimize(e){
		ocultar(e);		
	}

	function aviso(titul,content){
		document.getElementById('mensajealert').innerHTML = content;
		document.getElementById('menusup1').innerHTML = titul;
		mostrar('alertpers');
	}
	
	function confirmar(titul,content){
		document.getElementById('mensajeconfirm').innerHTML = content;
		document.getElementById('menusup2').innerHTML = titul;
		mostrar('confirmpers');
	}
	
	function formu(titul,content){
		document.getElementById('mensajeprompt').innerHTML = content;
		document.getElementById('menusup3').innerHTML = titul;
		mostrar('promptpers');
	}

	function recdato(control){
		var valor;
		valor=document.getElementById(control).value;
		return valor;
	}
	
	function enviar(direccion,variable,control){
		var valor=recdato(control);
		location.replace([direccion]+"?"+[variable]+"="+[valor]);
	}

	function enviarcv(direccion,variablec,variablev,valorv,control){
		var valorc=recdato(control);
		location.replace([direccion]+"?&"+[variablec]+"="+[valorc]+"&"+[variablev]+"="+[valorv]);
	}

	function enviarcvd(direccion,variablec,variablev,valorv,control,variacb,controld){
		var valorc=recdato(control);
		var valorcd=recdato(controld);
		
		location.replace([direccion]+"?&"+[variablec]+"="+[valorc]+"&"+[variablev]+"="+[valorv]+"&"+[variacb]+"="+[valorcd]);
	}
		
	function enviarsc(direccion,variable,valor){
		location.replace([direccion]+"?"+[variable]+"="+[valor]);
	}
	
	function enviarv(direccion,variable,valor){
		location.href([direccion]+"?"+[variable]+"="+[valor]);
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
	
	function validar_url(modulo){
		modulo=gup('mostrardiv');
		mostrar(modulo);
	}

	function recdatoin(control){
		var valor;
		valor=document.getElementById(control).innerHTML;
		return valor;
	}
	
	
	function selmaquina(e,f){
		var valor=recdatoin(f);
		cel=document.getElementById(f);
		cadena=valor.split(' ');
		control=document.getElementById(e);
		control.value=cadena[1];
		if(cel.style.backgroundColor!="red"){
			cel.style.backgroundColor="red";
			cel.style.color="white";
		}
		else{
			cel.style.backgroundColor="blue";
			cel.style.color="white";
		}
	}
	
	function evaluar_opcion(optid){
		controlval=document.getElementById(optid).value;
		if(controlval=='Producto mas vendido' || controlval=='Producto menos vendido' || controlval=='Fidelidad de Clientes' || controlval=='Incremento de Cartera'){
			ocultar('titulocicli');
			ocultar('txtcicli');
			ocultar('tituloprodcli');
			ocultar('catalogprodcli');
			ocultar('pieprodcli');
		}
		
		if(controlval=='Producto vendido por cliente'){
			ocultar('titulocicli');
			ocultar('txtcicli');
			mostrar('tituloprodcli');
			mostrar('catalogprodcli');
			mostrar('pieprodcli');
		}

		if(controlval=='Ventas por cliente'){
			mostrar('titulocicli');
			mostrar('txtcicli');
			ocultar('tituloprodcli');
			ocultar('catalogprodcli');
			ocultar('pieprodcli');
		}
		
		if(controlval=='Venta de producto por periodo'){
			ocultar('titulocicli');
			ocultar('txtcicli');
			mostrar('tituloprodcli');
			mostrar('catalogprodcli');
			mostrar('pieprodcli');
		}
	}
	
	function enviarpdf(a,b,c,d,e,f){
		aop=document.getElementById(a).value;
		bop=document.getElementById(b).value;
		cop=document.getElementById(c).value;
		dop=document.getElementById(d).value;
		eop=document.getElementById(e).value;
		fop=document.getElementById(f).value;
		
		if(a=='Producto menos vendido'){
			reporten=1;
		}
		
		if(a=='Producto vendido por cliente'){
			reporten=2;
		}
		
		if(a=='Venta de producto por periodo'){
			reporten=3;
		}
		
		if(a=='Ventas por cliente'){
			reporten=4;
		}
		
		if(a=='Fidelidad de Clientes'){
			reporten=5;
		}
		
		if(a=='Producto mas vendido'){
			reporten=6;
		}
		
		if(a=='Incremento de Cartera'){
			reporten=7;
		}
		
		location.replace("index.php?&modulo=result&idrep=" + reporten + "&productotxt=" + aop + "&ingresarcodtxt=" + bop + "&cliente=" + cop + "&hastafecha=" + dop + "&desdefecha=" + eop);
	}
	
	function habpedvid(contvid){
		var control=document.getElementById(contvid);
		control.checked=true;
	}

	function escribirTexto(idcampo,texto,opt){
		var control=document.getElementById(idcampo);
		if(opt=='S'){
			control.value=control.value+"'"+texto+"';";	
		}
		else{
			control.value=control.value+texto+";";
		}
	}