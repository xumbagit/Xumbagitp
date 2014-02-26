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
		
		public function cronw_msql($mensaje,$tipocambio,$usuario){
			$sqlsel="INSERT INTO historial(idusuario,tipocambio,descripcion,fechacambio,horacambio) VALUES('$usuario','$tipocambio','$mensaje','".date("Y-m-d")."','".date("H:i:s")."')";
			if($dbn->QuerySQL($sqlsel)==0){
				return 0;
			}
			else{
				return -1;
			}
		}
		
		public function comprobar_ruta($root){
			if(file_exists($root)){
				return 0;
			}
			else{
				return -1;
			}
		}
	}
?>