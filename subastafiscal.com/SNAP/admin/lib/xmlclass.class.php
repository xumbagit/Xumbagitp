<?php 
//	CLASE QUE TRABAJA EN LA CREACION DE ESTRUCTURAS XML

class xmlclass{
	private $valores=array();
	private $clases=array();
	private $class_ppal=array();
	private $nodos=array();
	private $perte=array();
	private $estrucxml_arr=array();
	private $cant_clases=0;
	private $cant_nodos=0;
	private $i=0;
	private $u=0;
	private $estrucxml,$anode,$encodetext,$nmclass,$mdcstr,$encodestat;
	private $primeravez=0;
	private $etiqcier;
	
	//IMPRIMIR EN UTF8
	function echoutf8($cadena){
		$cadena=utf8_decode($cadena);
		echo($cadena);
		return 0;
	}

	function echoutf8_str($cadena){
		$cadena=utf8_decode($cadena);
		return $cadena;
	}
	
	//ESTABLECE EL ARCHIVO XML A CREAR POSTERIORMENTE
	function XMLDocNew($dircomplet){
		$this->xmldir=$dircomplet;
		return 0;
	}
	
	//CREA una clase O ESTRUCTURA XML (SIN ESCRIBIR AL ARCHIVO TODAVIA)
	function MkClass($class){
		$nodepal=$this->nodeppal;
		$cant_clases=$this->cant_clases;
		
		if($this->xmldir!=''){
			$this->clases[$nodepal][$cant_clases]=$class;
			$this->cant_clases++;
			return 0;
		}
		else{
			return -1;
		}
	}
	//ESTABLECE UNA CLASE XML COMO LA PREDETERMINADA A TRABAJAR EN ELLA
	function SetClass($class){
		$this->nmclass=$class;
		return 0;
	}
	
	function MkSetClase($class){
		$nodepal=$this->nodeppal;
		$cant_clases=$this->cant_clases;
		
		if($this->xmldir!=''){
			$this->clases[$nodepal][$cant_clases]=$class;
			$this->cant_clases++;
			$this->nmclass=$class;
			return 0;
		}
		else{
			return -1;
		}
	}
	
	//CREA el NODO PRINCIPAL de todas las clases
	function MkNodeFirst($nombre){
		$this->nodeppal=$nombre;
		return 0;
	}
	//CREA UN SUB-NODO
	function MkSubNode($nombre,$valor,$option){
		$clase=$this->nmclass;
		if($this->nodos[$clase][$nombre]==''){
			$this->nodos[$clase][$nombre]=$valor;
			$this->perte[$nombre]=$clase;
			$this->anode=$nombre;
			$this->cant_nodos++;
		}
		else{
			return -1;
		}

		if($option=='u'){
			$this->getOutput($option);
		}
		if($option=='r'){
			$this->getOutput($option);
		}
		elseif($option=='uf'){
			$this->getOutput($option);
		}
		return 0;
	}
	
	//ESTABLECE EL VALOR DE UN NODO X
	function setValSubNode($nombre,$valor){
		$clase=$this->nmclass;
		$this->nodos[$clase][$nombre]=$valor;
		$this->anode=$nombre;
		return 0;
	}	
	//OBTIENE EL VALOR DEL ULTIMO NODO CREADO
	function getvalNode(){
		$clase=$this->nmclass;
		$node=$this->anode;
		$valor=$this->nodos[$clase][$node];
		
		if($valor!=''){
			return $valor;
		}
		else{
			return -1;
		}
	}
	
	//OBTIENE EL VALOR DEL ULTIMO CLASE CREADO
	function getvalClass(){
		$nodepal=$this->nodeppal;
		$cant_clases=$this->cant_clases;
		$valor=$this->clases[$nodepal][$cant_clases];
		
		if($valor!=''){
			return $valor;
		}
		else{
			return -1;
		}
	}
	//OBTIENE UN VALOR DEL NODO QUE SE LE DIGA
	function getvalNode_dif($node){
		$clase=$this->nmclass;
		$valor=$this->nodos[$clase][$node]; 
		
		if($valor!=''){
			return $valor;
		}
		else{
			return -1;
		}
	}
	//OBTIENE EL NODO PRINCIPAL
	function getActualNPpal(){
		return $this->nodeppal;
	}
	//OBTIENE LA CLASE CON LA QUE SE ESTA TRABAJANDO ACTUALMENTE
	function getActualClass(){
		return $this->nmclass;
	}
	//OBTIENE EL ARCHIVO ACTUAL
	function getActualFile(){
		return $this->xmldir;
	}
	//OBTIENE EL ULTIMO NODO QUE SE CREO
	function getActualNode(){
		return $this->anode;
	}
	//OBTIENE EL NUMERO DE CLASES CREADAS
	function getAllClases(){
		$clase=$this->nmclass;
		$u=$this->cant_clases;
		return $u;
	}
	//OBTIENE EL NUMERO DE NODOS CREADOS
	function getAllNodes(){
		$clase=$this->nmclass;
		$u=$this->cant_nodos;
		return $u;
	}
	//DEVUELVE UNA LISTA DE TODAS LAS CLASES CREADAS
	function ListClases(){
		$nodepal=$this->nodeppal;
		echo("Lista de Clases: <br>");
		foreach ($this->clases[$nodepal] as $key=>$value) {
		    echo("$value<br/>\n");
		}
	}
	//DEVUELVE UNA LISTA DE TODOS LOS NODOS CREADOS
	function ListNodos(){
		$clase=$this->nmclass;
		$nodosnum=count($this->nodos[$clase]);
		echo("Lista de Nodos: <br>");
		foreach ($this->nodos[$clase] as $key=>$value) {
		    echo("Clave: $key; Valor: $value<br />\n");
		}
	}
	//DEVUELVE UN STRING CON LA ESTRUCTURA QUE SE HA CREADO
	function str_getStructClass(){
		//Armar la escrutctura del XML
		$claseppal=$this->nodeppal;
		//imprimir la clase ppal
		$cant_clases=$this->cant_clases;
		
		$enctype=$this->encodetext;
		if($enctype!=''){
			$this->estrucxml="<?xml version='1.0' encoding='".$enctype."'?>\n";
		}
		else{
			$this->estrucxml="<?xml version='1.0' encoding='utf-8'?>\n";
		}
		
		$this->estrucxml.="<".$claseppal.">\n";
		foreach ($this->clases[$claseppal] as $llave=>$valor) {
			$this->estrucxml.="\t<".$valor.">\n";
				foreach ($this->nodos[$valor] as $key=>$value) {
					if($this->perte[$key]==$valor){
					    $this->estrucxml.="\t\t<".$key.">".$value."</".$key.">\n";
					}
				}
			$this->estrucxml.="\t</".$valor.">\n";
		}
		$this->estrucxml.="</".$claseppal.">\n";
		//$directorio
		if($this->estrucxml!=''){
			return $this->estrucxml;
		}
		else{
			return -1;
		}
	}
	//Establece la codificacion del archivo XML
	function SetEncoding($encode){
		$this->encodetext=$encode;
	}
	
	function get_codification(){
		if($this->encodetext!=''){
			return $this->encodetext;
		}
	}
	
	function getfileStat(){
		if($this->encodetext!=''){
			$enctype=$this->encodetext;
			if($enctype!=''){
				$this->encodestat="<?xml version='1.0' encoding='".$enctype."'?>\n";
			}
			else{
				$this->encodestat="<?xml version='1.0' encoding='utf-8'?>\n";
			}
			
			return $this->encodestat; 
		}	
	}
	
	//DEVUELVE UN ARRAY CON LA ESRUCTURA XML
	function arr_getStructClass(){
		//Armar la escrutctura del XML
		$claseppal=$this->nodeppal;
		//imprimir la clase ppal
		$cant_clases=$this->cant_clases;
		
		foreach ($this->clases[$claseppal] as $llave=>$valor) {
			$this->estrucxml_arr[]="\t<".$valor.">\n";
				foreach ($this->nodos[$valor] as $key=>$value) {
					if($this->perte[$key]==$valor){			
					    $this->estrucxml_arr[]="\t\t<".$key.">".$value."</".$key.">\n";
					}
				}
			$this->estrucxml_arr[]="\t</".$valor.">\n";
		}
		
		//$directorio
		if($this->estrucxml_arr!=''){
			return $this->estrucxml_arr;
		}
		else{
			return -1;
		}
	}
	
	//DEVUELVE UN ARRAY CON LA ESRUCTURA XML (SOLO PARTE DE LA ESTRUCTURA)
	function arr_getStructClass_clase(){
		//Armar la escrutctura del XML
		$claseppal=$this->nodeppal;
		//imprimir la clase ppal
		$cant_clases=$this->cant_clases;

		foreach ($this->clases[$claseppal] as $llave=>$valor) {
			$this->estrucxml_arr[]="\t<".$valor.">\n";
				foreach ($this->nodos[$valor] as $key=>$value) {
					if($this->perte[$key]==$valor){			
					    $this->estrucxml_arr[]="\t\t<".$key.">".$value."</".$key.">\n";
					}
				}
			$this->estrucxml_arr[]="\t</".$valor.">\n";
		}
		//$directorio
		if($this->estrucxml_arr!=''){
			return $this->estrucxml_arr;
		}
		else{
			return -1;
		}
	}
		
	//CREA EL ARCHIVO XML FISICO Y PLASMA LA ESTRUCTURA XML EN EL
	function getOutput($option){
		$claseppal=$this->nodeppal;
		//imprimir la clase ppal
		$cant_clases=$this->cant_clases;
		$claseppaltext="<".$claseppal.">\n";
		$claseppaltextc="</".$claseppal.">\n";
		
		//Armar la escrutctura del XML
		$claseppal=$this->nodeppal;
		//imprimir la clase ppal
		$cant_clases=$this->cant_clases;
		
		foreach ($this->clases[$claseppal] as $llave=>$valor) {
			$this->estrucxml_arr[]="\t<".$valor.">\n";
				foreach ($this->nodos[$valor] as $key=>$value) {
					if($this->perte[$key]==$valor){			
					    $this->estrucxml_arr[]="\t\t<".$key.">".$value."</".$key.">\n";
					}
				}
			$this->estrucxml_arr[]="\t</".$valor.">\n";
		}
		
		//Armar ARCHIVO XML externo file_put_contents (se ahorran 3 lineas de codigo jejeje)....
		if($this->primeravez!=0){
			$clase=$this->nmclass;
			$dirfile=$this->xmldir;
			$clasppal=$this->nodeppal;
			$contenido=$this->estrucxml_arr;
			
			if($contenido!='' && $dirfile!=''){
				if($option=='c'){
					$this->etiqcier='c';
					file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
					file_put_contents($dirfile, $claseppaltextc, FILE_APPEND| LOCK_EX);
				}		
				if($option=='u'){
					file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
				}
				if($option=='uf'){
					$this->etiqcier='uf';
					file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
					file_put_contents($dirfile, $claseppaltextc, FILE_APPEND| LOCK_EX);
				}
				
				$this->primeravez++;
			}
			else{
				return -1;
			}
		}
		else{
			$contenido=$this->encodestat;
			//Armar ARCHIVO XML externo file_put_contents (se ahorran 3 lineas de codigo jejeje)....
			$clase=$this->nmclass;
			$dirfile=$this->xmldir;
			$clasppal=$this->nodeppal;
			$contenido=$this->estrucxml_arr;
			$enca=$this->encodestat;
			
			if($contenido!='' && $dirfile!=''){
				file_put_contents($dirfile,"<?xml version='1.0' encoding='utf-8'?>\n");
				file_put_contents($dirfile, $claseppaltext, FILE_APPEND| LOCK_EX);
				file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
				$this->primeravez++;
			}
			else{
				return -1;
			}		
		}
		
		$this->valores=array();
		$this->clases=array();
		$this->class_ppal=array();
		$this->nodos=array();
		$this->perte=array();
		$this->estrucxml_arr=array();
		$cant_clases=0;
		$cant_nodos=0;
		$i=0;
		$u=0;
	}
	//FUNCION LEGACY
	function getOutput_new(){
		$contenido=$this->encodestat;
		//Armar ARCHIVO XML externo file_put_contents (se ahorran 3 lineas de codigo jejeje)....
		$clase=$this->nmclass;
		$dirfile=$this->xmldir;
		$clasppal=$this->nodeppal;
		$contenido=$this->estrucxml_arr;
		$enca=$this->encodestat;
		
		if($contenido!='' && $dirfile!=''){
			file_put_contents($dirfile,"<?xml version='1.0' encoding='utf-8'?>\n");
			file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
		}
		else{
			return -1;
		}
	}
	//FUNCION LEGACY	
	function getOutput_file(){
		//Armar ARCHIVO XML externo file_put_contents (se ahorran 3 lineas de codigo jejeje)....
		$clase=$this->nmclass;
		$dirfile=$this->xmldir;
		$clasppal=$this->nodeppal;
		$contenido=$this->estrucxml_arr;
		
		if($contenido!='' && $dirfile!=''){
			echo("NO ESTA VACIO");
			file_put_contents($dirfile, $contenido, FILE_APPEND| LOCK_EX);
			echo("HECHO");
		}
		else{
			return -1;
		}
	}
	
	//Codifica una cadena a MD5
	function XMLEncStr($cadena){
		$this->mdcstr=md5($cadena);
		return $this->mdcstr; 
	}
	
	function vaciarXML(){
		$this->valores=array();
		$this->clases=array();
		$this->class_ppal=array();
		$this->nodos=array();
		$this->perte=array();
		$this->estrucxml_arr=array();
		$cant_clases=0;
		$cant_nodos=0;
		$i=0;
		$u=0;
	}
	
	function getError(){
		if($this->etiqcier==''){
			$error="<h3>No existe etiqueta de cierre FINAL.</h3>";
			return $error;
		}
	}
}
?>