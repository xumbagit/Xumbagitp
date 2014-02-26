<?php
	class seguridad{
		private $fileauth;
		private $prefijoclv;
		private $constantes;
		
		public function def_constante($nombre,$valor){
			define($nombre,$valor);
		}
		
		public function generar_clave_validacion(){
			$patron="/[A-Z]{4}\d{4}[a-z]{4}[A-Z]{2}\D{4}/";
			$cadena='';
		
			for($i=1;$i<=4;$i++){
				//letras MAYUSCULAS
				$num=rand(65,90);
				$cadena=$cadena.chr($num);
			}
			
			for($i=1;$i<=4;$i++){
				//numeros
				$num=rand(48,57);
				$cadena=$cadena.chr($num);
			}
			
			for($i=1;$i<=4;$i++){
				//letras minusculas
				$num=rand(97,122);
				$cadena=$cadena.chr($num);
			}
			
			for($i=1;$i<=2;$i++){
				//letras MAYUSCULAS
				$num=rand(65,90);
				$cadena=$cadena.chr($num);
			}
			
			for($i=1;$i<=4;$i++){
				//Caracteres especales
				$num=rand(33,125);
				$cadena=$cadena.chr($num);
			}
			
			return $cadena;
		}
		
		public function setPreClave($nombre){
			$this->prefijoclv=$nombre;
		}

		public function getPreClave(){
			if($this->prefijoclv!=''){
				return $this->prefijoclv;
			}
			else{
				return -1;
			}
		}
		
		public function generar_clave_producto(){
			$cadena=$this->getPreClave();
			if($cadena!=''){
				for($i=1;$i<=5;$i++){
					//letras MAYUSCULAS
					$num=rand(65,90);
					$cadena=$cadena.chr($num);
				}
				
				for($i=1;$i<=2;$i++){
					//numeros
					$num=rand(48,57);
					$cadena=$cadena.chr($num);
				}
				
				for($i=1;$i<=3;$i++){
					//Caracteres especales
					$num=rand(33,125);
					$cadena=$cadena.chr($num);
				}
				
				$cadena=md5($cadena);
				
				return $cadena;
			}
			else{
				return -1;
			}
		}
		
		public function generar_llave($cantchar){
		
			for($i=1;$i<=$cantchar;$i++){
				//Caracteres especales
				$num=rand(33,125);
				$cadena=$cadena.chr($num);
			}
			
			return $cadena;
		}
		
		public function encriptar_clave_md5($clave){
			$clave=md5($clave);
			return $clave; 
		}
		
		public function convertir_MD5($cadena){
			$cadena=md5($cadena);
			return $cadena; 
		}
		
		public function redir_d($dir){
			if($dir!=''){
				header($dir);
			}
			else{
				return -1;
			}
		}
		
		public function setFileAuth($nombre){
			$this->fileauth=$nombre;
		}

		public function getFileAuth(){
			if($this->fileauth!=''){
				return $this->fileauth;
			}
			else{
				return -1;
			}
		}
		
		public function loadauth(){
			$archivo=$this->getFileAuth(); 
			
			if(!file_exists($archivo)){
				return -1;
			}
			else{
				return 0;
			}
		}
		
		/*
		 * ERROR 101: No hay conexion con la base de datos
		 * ERROR 102: Faltan Archivos
		 * ERROR 112: Falta archivo de configuracon ppal
		 * */
		//escribir error en el LOG de errores
		
		public function ew_display_s($mensaje){
			echo("<h3>".$mensaje."</h3>");
		}
		
		public function errorw($mensaje){
			$ruta=ROOT_LOGS.DEFAULT_ERROR_LOG;
			$archivo=fopen($ruta,'a');
			if($archivo){
				fwrite($archivo,$mensaje);
				fclose($archivo);
			}
			else{
				return -1;
			}
		}
		//error de conexion!
		public function cronw_conexion($mensaje,$conexion){
			if(!$conexion){
				$this->errorw("No esta conectado al servidor MySQL");	
			}
			sleep(5);
		}
		//error de modulo
		public function cronw_modulo($mensaje,$modulo){
			$modulo=$modulo.DEFAULT_T_ARCH;
			$dirmod=ROOT_MODULOS.$modulo;
			if(file_exists($dirmod)){
				$mensajecomp="El modulo ruta: ".$archivo." fue Encontrado<br>";
				$this->errorw($mensajecomp);
				return 0;
			}
			else{
				$mensajecomp="El módulo ".$modulo." no existe!<br>";
				$this->errorw($mensajecomp);
				return -1;
			}
			sleep(5);
		}
		//error de cualquier otro archivo que no sea modulo o no haqya sido la conexion fallida!
		public function cronw_archivo($root,$archivo){
			$dirmod=$root.$archivo;
			if(file_exists($dirmod)){
				$mensajecomp="El archivo ruta: ".$archivo." fue Encontrado<br>";
				$this->errorw($mensajecomp);
				return 0;
			}
			else{
				$mensajecomp="El archivo ".$archivo." no existe!<br>";
				$this->errorw($mensajecomp);
				return -1;
			}
			sleep(5);	
		}
		
		public function cronw_archivo_dir($archivo){
			$dirmod=$archivo;
			if(file_exists($dirmod)){
				$mensajecomp="El archivo ruta: ".$archivo." fue Encontrado<br>";
				$this->errorw($mensajecomp);
				return 0;
			}
			else{
				$mensajecomp="El archivo ruta: ".$archivo." no existe!<br>";
				$this->errorw($mensajecomp);
				return -1;
			}
			sleep(5);	
		}
		
		public function comprobar_ruta($root){
			if(file_exists($root)){
				return 0;
			}
			else{
				return -1;
			}
		}
		
		public function incluir_archivo($ruta){
			if($this->comprobar_ruta($ruta)==0){
				include($ruta);
				//$this->ew_display_s("HECHO1");
				$this->errorw($ruta." 202 Success!".date("Y-m-d h:i:s"));
				return 0;
			}
			else{
				$this->errorw($ruta." no encontrado!".date("Y-m-d h:i:s"));
				return -1;
			}
			return 0;
		}
	}
?>