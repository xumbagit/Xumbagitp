<?php
//EL MENU TIENE HASTA AHORA 2 NIVELES NADA MAS WTF
include('xmlclass.class.php'); 

class artxml{	
	private $xml,$directeti,$bd,$clase_gral,$archivofis,$subc,$subr,$tabusr;
	private $palab,$recentclass;
	private $archivoconf=array();
	private $menu_geral=array();
	private $menu_padre=array();
	private $submenu_padre=array();
	private $linkmenu_padre=array();
	private $pertenece_padre=array();
	private $niveles=array();
	private $link_menu=array();
	private $index_menu=0;
	private $index_submenu=0;
	private $index_linksubmenu=0;
	private $index_niveles=0;
	private $lastmenu;
	private $menudir,$menuhtmldir;
	private $namefilemenu;
	private $childs;
	private $cantmenuppal;
	//variables de los menus
	private $lcabecera,$hcabecera,$lmenu,$hmenu,$nmenu,$forecabecera,$foremenu;
	
	//Manejador de Base de datos ARTXML
	//funcion que "conecta" a la BD ARTXML
	public function setNameXML($rutarchivo){
		if(file_exists($rutarchivo)){
			$this->archivofis=$rutarchivo;
			return 0;
		}
		else{
			return -1;
		}
	}
	
	public function getNameXML(){
		if($this->archivofis!=''){
			return $this->archivofis;
		}
		else{
			return -1;
		}
	}
	/* LEGACY
	 *
	 *	public function artxml_connect_old($rutarchivo,$nombrebd,$clase){
		if(file_exists($rutarchivo)){
			$this->xml = simplexml_load_file($rutarchivo);
			$this->directeti = file_get_contents($rutarchivo);
			$this->bd=$nombrebd;
			$this->clase_gral=$clase;
			$this->archivofis=$rutarchivo;
			return 0;
		}
		else{
			return -1;
		}
	}
	//cambia la propiedad de la clase padre
	public function artxml_cambiar_clase($clase){
		$this->clase_gral=$clase;
	}
	//cambia la propiedad de el campo padre
	public function artxml_cambiar_camp($subclase){
		$this->subc=$subclase;
	}
	//cambia la propiedad del registro padre
	public function artxml_cambiar_reg($subreg){
		$this->subr=$subreg;
	}
	//cambia la propiedad de la tabla padre
	public function artxml_cambiar_tab($tabe){
		$this->tabusr=$tabe;
	}
	*/
	
	function echoutf8($string){
		echo(utf8_decode($string));
		return 0;
	}
	
	//obtiene elementos por el nombre de la etiqueta
	function getElementByTagName($etiqueta){
		$coinc=array();
		$nombrearch=$this->getNameXML();
		if(!($archivo = fopen($nombrearch,"r"))){
	   		return -1;
		}
		else{
			$i=0;
			while($linea=fgets($archivo,1024)){
				/* Remover espacios en blanco de la cadena: */
				$linea = trim($linea);
				/* Remover etiquetas HTML: */
				$modelo="/<".$etiqueta."[^>]*>(.*?)<\/".$etiqueta.">/";
				preg_match_all($modelo,$linea,$palabras);
				if($palabras[1][0]!=''){
					$coinc[$i]=$palabras[1][0];
					$i++;
				}
				else{
					$modelod="/<(".$etiqueta.")>/";
					preg_match_all($modelod,$linea,$palabras);
					if($palabras[1][0]!=''){
						$coinc[$i]=$palabras[1][0];
						$i++;
					}
					else{
						$modelo="/<(".$etiqueta.")[^>]*>(.*?)<\/(".$etiqueta.")>/";
						preg_match_all($modelo,$linea,$palabras);
						if($palabras[1][0]!=''){
							$coinc[$i]=$palabras[1][0];
							$i++;
						}					
					}				
				}
			}
			fclose($archivo);
			
			$valores=$i;
			if($valores<2){
				$string=$coinc[0];
				return $string;
			}
			else{
				return $coinc;			
			}
		}
	}
	function getTagByValueName($valbus){
		$coinval=array();
		$nombrearch=$this->getNameXML();
		if(!($archivo = fopen($nombrearch,"r"))){
	   		return -1;
		}
		else{
			$i=0;
			while($linea=fgets($archivo,1024)){
				/* Remover espacios en blanco de la cadena: */
				$linea = trim($linea);
				/* Remover etiquetas HTML: */
				$modelo="/<(.*?)>".$valbus."<(.*?)>/";
				preg_match_all($modelo,$linea,$palabras);
				if($palabras[1][0]!=''){
					$coinval[$i]=$palabras[1][0];
					$encontrado=1;
					$i++;
				}
				else{
					$modelod="/<".$valbus."[^>]*>/";
					preg_match_all($modelod,$linea,$palabras);
					if($palabras[1][0]!=''){
						$coinc[$i]=$palabras[1][0];
						$i++;
					}				
				}
			}
			fclose($archivo);

			if($encontrado!=1){
				return -1;
			}
			else{
				return $coinval;
			}
		}
	}
	//cambiar valor a etiquetas unicas
	function ReplaceData($etiqueta,$valorrep){
		$coinc=array();
		$nombrearch=$this->getNameXML();
		if(!($archivo = fopen($nombrearch,"r+"))){
	   		return -1;
		}
		else{
			$archxml=file($nombrearch);
			$i=0;
			while($linea=fgets($archivo,1024)){
				/* Remover espacios en blanco de la cadena: */
				$linea = trim($linea);
				/* Remover etiquetas HTML: */
	/* INFORMACION DE LAS VARIABLES DECLARADAS
	 * obtiene elementos 	
	private $menu_padre=array();
	private $link_menu=array();
	private $index_menu;
	private $index_submenu;
	private $index_linksubmenu;
	*/
				$modelo="/<".$etiqueta."[^>]*>(.*?)<\/".$etiqueta.">/";
				preg_match($modelo,$linea,$palabras);
				$palab=$palabras[0];
				if($palab!=''){
					$string = $linea;
					$pattern = "/<".$etiqueta."[^>]*>(.*?)<\/".$etiqueta.">/";
					$replacement = "<".$etiqueta.">".$valorrep."</".$etiqueta.">";
					$rep=preg_replace($pattern, $replacement, $string);
					$i++;
				}
			}
			
			$u=count($archxml);
			for($i=0;$i<=($u-1);$i++){
				$modelo="/<".$etiqueta."[^>]*>(.*?)<\/".$etiqueta.">/";
				$linea=$archxml[$i];
				$linea=trim($linea);
				preg_match($modelo,$linea,$palabras);
				if($palabras[0]!=''){
					$pattern = "/<".$etiqueta."[^>]*>(.*?)<\/".$etiqueta.">/";
					$replacement = "\t\t\t<".$etiqueta.">".$valorrep."</".$etiqueta.">\n";
					$rep=preg_replace($pattern, $replacement, $string);
					$archxml[$i]=$rep;
				}
			}
			
			file_put_contents($nombrearch,$archxml);
			fclose($archivo);
			return 0;
		}
	}
	
	function AppendData($arbol){
		$archivo_arr=array();
		$brakeline='';
		$i=0;
		$archivo=$this->getNameXML();
		if($archivo!='' && $arbol!=''){
			if(file_exists($directorio)){
				if($fpuntero=fopen($directorio, "r")){
					while(!feof($fpuntero)){
					    //read file line by line into a new array element 
					    $archivo_arr[]=fgets($fpuntero, 4096);
					    $i++;
					}
				}
				fclose($fpuntero);
				
				if($fpuntero=fopen($directorio, "a")){
					fwrite($fpuntero,"\n");
					fwrite($fpuntero,$arbol);
					fwrite($fpuntero,"\n");
				}
				fclose($fpuntero);
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}
	}
	
	function CreateXML($directorio,$contenido){
		if(!file_exists($directorio)){
			$archivo=fopen($directorio,"w+");
			if($archivo){
				$cabeza="<?xml version='1.0' encoding='utf-8'?>\n";
				fwrite($archivo,$cabeza);
				fwrite($archivo,$contenido);
				fclose($archivo);
				return 0; 
			}
			else{
				return -1;
			}			
		}
		else{
			return -2;
		}
	}

	function CreatePHP($directorio,$contenido){
		if(!file_exists($directorio)){
			$archivo=fopen($directorio,"w+");
			if($archivo){
				/*CABEZA Y PIE*/
				$cabeza="<?php\n";
				$pie="?>\n";
				/**************/
				fwrite($archivo,$cabeza);
				fwrite($archivo,$contenido);
				fwrite($archivo,$pie);
				fclose($archivo);
				return 0; 
			}
			else{
				return -1;
			}			
		}
		else{
			return -2;
		}
	}

	function CreatePHPConfig($directorio,$opcion){
		if($opcion=='u'){
				$archivo=fopen($directorio,"w");
				if($archivo){
					/*CABEZA Y PIE*/
					$cabeza="<?php\n";
					/**************/
					fwrite($archivo,$cabeza);
					for($i=0;$i<=(count($this->archivoconf)-1);$i++){
						$string=$this->archivoconf[$i]."\n";
						fwrite($archivo,$string);
					}
					$pie="?>\n";
					fwrite($archivo,$pie);
					fclose($archivo);
					return 0; 
				}
				else{
					return -1;
				}		
		}
		else{
			if(!file_exists($directorio)){
				$archivo=fopen($directorio,"w+");
				if($archivo){
					/*CABEZA Y PIE*/
					$cabeza="<?php\n";
					/**************/
					fwrite($archivo,$cabeza);
					for($i=0;$i<=(count($this->archivoconf)-1);$i++){
						$string=$this->archivoconf[$i]."\n";
						fwrite($archivo,$string);
					}
					$pie="?>\n";
					fwrite($archivo,$pie);
					fclose($archivo);
					return 0; 
				}
				else{
					return -1;
				}			
			}
			else{
				return -2;
			}
		}
	}
	
	function CreateCSS($directorio,$contenido){
		if(!file_exists($directorio)){
			$archivo=fopen($directorio,"w+");
			if($archivo){
				fwrite($archivo,$contenido);
				fclose($archivo);
				return 0; 
			}
			else{
				return -1;
			}			
		}
		else{
			return -2;
		}
	}
		
	function LabelToDefine($etiqueta,$def){
		$nombre=$this->getElementByTagName($etiqueta);
		$n=count($nombre);
		if($nombre==''){
			return -2;
		}
		else{
			$str_PHP="define('".$def."','".$nombre."');";
			$this->archivoconf[]=$str_PHP;
			return $str_PHP;
		}
	}

	function LabelToDefine_se($valor,$def){
		$str_PHP="define('".$def."','".$valor."');";
		$this->archivoconf[]=$str_PHP;
		return $str_PHP;
	}
	
	function setTreeConfig(){
		$valor=array();$item=array();
		/*diferenciar el lado derecho del aldo izq porque el lado izquiero esta en mayusculas
		y el lado derecho en minusculas */
		$numero=func_num_args();
		$argu=func_get_args();
		$nombrearbol=$argu[0];
		$modelo="/^nom_[a-z]*/";
		//$modelo2="/^i_[a-z]*/";
		//$modelo3="/^v_[a-z]*/";
		$modelonum="/^[0-9]*/";
		preg_match($modelo,$nombrearbol,$coinc);
		if($coinc!=''){
			for($i=1;$i<=(count($argu)-1);$i++){
				$str1=$argu[$i];
				$str2=strtoupper($argu[$i]);
				preg_match($modelonum,$str2,$numeco);
				if($str2==$str1 && $numeco[0]==''){
					$item[]=$argu[$i];
				}
				elseif($str2==$str1 && $numeco[0]!=''){
					$valor[]=$argu[$i];
				}				
				else{
					if($str2!=$str1){
						$valor[]=$argu[$i];	
					}
				}
			}
			$valores=((($numero-1)/2));
			$nombreqs=$coinc[0];
			$nombres=explode('_',$nombreqs);
			$result="\$conf['".$nombres[1]."'](\n";
			for($i=0;$i<=$valores;$i++){
				if($i!=$valores && $i!=$valores-1){
					$result.="\t'".$item[$i]."'=>'".$valor[$i]."',\n";
				}
				elseif($i==($valores-1)){
					$result.="\t'".$item[$i]."'=>'".$valor[$i]."'\n";
				}
				else{
					$result.=");\n\n\n";
				}
			}
			$this->archivoconf[]=$result;
			return $result;
		}
		else{
			return -1;
		}
	}
	
	// Abre un directorio conocido, y procede a leer el contenido
	function AnalizeDir(){
		$directorio=$this->getNameXML();
		$i=0;
		$archivosnom='';
		if (is_dir($directorio)) {
		    if ($dh = opendir($directorio)) { 	
		        while (($file = readdir($dh)) !== false) {
					if($file!='.' || $file!='..' || $file!='...'){
						$archivosnom[$i]=$file;
					}
			        $i++;
		        }
		        closedir($dh);
		    }
		}
		else{
			die("El directorio no existe");
		}
		return $archivosnom;
	} 
	
	function ListFileMulti(){
		$directorio=$this->getNameXML();
		if($directorio!=''){
			$i=0;
			$narchivos=0;
			if (is_dir($directorio)) {
			    if ($dh = opendir($directorio)) { 	
			        while (($file = readdir($dh)) !== false) {
						$narchivos++;
			        }
			        closedir($dh);
			    }
			}
			else{
				die("El directorio no existe");
			}
			return $narchivos;
		}
		else{
			return -1;
		}
	} 
	
	function ListFileSingle(){
		$directorio=$this->getNameXML();
		if($directorio!=''){
			$i=0;
			if (is_dir($directorio)) {
			    if ($dh = opendir($directorio)) {
			    	echo("Nombre del Archivo "."|Directorio: $directorio "."<br>");
			    	echo("-------------------------------------------------------<br>");
			        while (($file = readdir($dh)) !== false) {
			        	if(strlen($file)>2){
			        		echo($directorio.$file."<br>");
			        	}
			            $i++;
			        }
			        closedir($dh);
			        return 0; 
			    }
			}
		}
		else{
			return -1;
		}
	}
	
	function setModuloDir($direc){
		//setear el directorio de donde se va a hacer el menu 
		if(is_dir($direc)){
			$this->menudir=$direc;
			return 0;
		}
		else{
			return -1;
		}
	}
	
	function getModuloDir(){
	//obtener el directorio de donde se va a hacer el menu
		if($this->menudir!=''){
			return $this->menudir;
		}
		else{
			return -1;
		}
	}

	function setMenuDir($direc){
		//setear el directorio de donde se va a hacer el menu 
		if(is_dir($direc)){
			$this->menuhtmldir=$direc;
			return 0;
		}
		else{
			return -1;
		}
	}

	function getMenuDir(){
	//obtener el directorio de donde se va a hacer el menu
		if($this->menuhtmldir!=''){
			return $this->menuhtmldir;
		}
		else{
			return -1;
		}
	}
	
	function VerModulos(){
		$coinc=array();
		$modulos=array();
		//si opcion=0 entonces es simple, si opcion=1 entonces es un menu completo con niveles
		$directorio=$this->getModuloDir();
		if($directorio!=''){
			$directotal=$directorio.'modulosall_actual.xml';
			$this->setNameXML($directotal);
			$res=$this->getElementByTagName('numero_modulos');
			return $res; 
		}	
	}
	
	
	function ActualizarModulos(){
		$coinc=array();
		$modulos=array();
		//si opcion=0 entonces es simple, si opcion=1 entonces es un menu completo con niveles
		$directorio=$this->getModuloDir();
		if($directorio!=''){
			$i=0;
			if(is_dir($directorio)){
				$i=0;
				$narchivos=0;
				if(is_dir($directorio)){
				    if($dh = opendir($directorio)){
				    	$directotal=$directorio.'modulosall_actual.xml';
						$myclas= new xmlclass();
						$myclas->XMLDocNew($directotal);
						$myclas->MkNodeFirst('sistema');
						//Crear las clases de la estructura XML
						//////////////////////////////
						//Establecer la clase Persona
						//u= indica que es la ultima etiqueta de la clase
						//uf=indica que es la ultima clase
						//Leer el direcotrio especificado
				        while (($file = readdir($dh)) !== false) {
					        if(preg_match_all("/^([A-Za-z]*)(.php|.html|.xhtml|.php3)/",$file,$coinc)){
					        	echo($coinc[0][0]);
					        	$modulos[]=$file;
								$narchivos++;
					        }
				        }
				        closedir($dh);
						$myclas->MkSetClase('modulos');
				        for($i=0;$i<=($narchivos-1);$i++){
				        	$cadena='modulo'.$i;
				        	if($i==($narchivos-1)){
				        		$myclas->MkSubNode($cadena,$modulos[$i],'u');
				        	}
				        	else{	
								$myclas->MkSubNode($cadena,$modulos[$i]);
				        	}
				        }
				        $myclas->MkSetClase('modulos_info');
				        $myclas->MkSubNode("numero_modulos",$narchivos,'uf');
				//Crear las clases de la estructura XML
				//////////////////////////////
				//Establecer la clase Persona
				//u= indica que es la ultima etiqueta de la clase
				//uf=indica que es la ultima clase
						return 0;
				    }
				    else{
				    	return -3;
				    }
				}
				else{
					die("El directorio no existe");
				}
			}
		}
		else{
			return -4;
		}
	}
	/*TERMINAR FUNCION de INSTALAR MODULO
	 * Creacion automatica de menus
	 * Instalacion de modulo por el sistema
	 * Edicion del menu automatica
	 * Migrar Módulos del sistema viejo al nuevo y adaptarlos a las nuevas librerias YEA		
	*/
	function InstalarModulo($modulo){
		$modulos=array();
		//si opcion=0 entonces es simple, si opcion=1 entonces es un menu completo con niveles
		$directorio=$this->getModuloDir();
		if($directorio!=''){
			$i=0;
			if(is_dir($directorio)){
				$modulofile=$directorio.$modulo;
				if(file_exists($modulofile)){
					
				}
			}
		}
	}
	
	function setColorMenu($color,$seccion){
		//establece color para ciertas areas del menu
		
		if($seccion=='link_cabecera'){
			$this->lcabecera=$color;
		}
		elseif($seccion=='hover_cabecera'){
			$this->hcabecera=$color;
		}
		elseif($seccion=='link_menu'){
			$this->lmenu=$color;
		}
		elseif($seccion=='hover_menu'){
			$this->hmenu=$color;
		}
		elseif($seccion=='fore_cabecera'){
			$this->forecabecera=$color;
		}
		elseif($seccion=='fore_menu'){
			$this->foremenu=$color;
		}
		else{
			//normal (el gris ese soso)
			$this->nmenu=$color;
		}
	}
	
	function printCSSMenu(){
		if($this->lcabecera==''){
			$this->lcabecera='710069';
		}
		
		if($this->hcabecera==''){
			$this->hcabecera='36f';
		}
		
		if($this->lmenu==''){
			$this->lmenu='6a3';
		}
		
		if($this->hmenu==''){
			$this->hmenu='6fc';
		}
		
		if($this->nmenu==''){
			$this->nmenu='ddd';
		}
		
		if($this->forecabecera==''){
			$this->forecabecera='fff';
		}
		
		if($this->foremenu==''){
			$this->foremenu='fff';
		}
		$cadena="<style type=\"text/css\">
		/* ================================================================ 
		This copyright notice must be untouched at all times.
		
		The original version of this stylesheet and the associated (x)html
		is available at http://www.cssplay.co.uk/menus/dd_valid.html
		Copyright (c) 2005-2007 Stu Nicholls. All rights reserved.
		This stylesheet and the assocaited (x)html may be modified in any 
		way to fit your requirements.
		=================================================================== */
		/* common styling */
		.menu {font-family: arial, sans-serif; width:800px; height:150px; position:relative; font-size:15px; z-index:100;}
		.menu ul li a, .menu ul li a:visited {display:block; text-decoration:none; color:#000;width:107px; height:30px; text-align:center; color:#".$this->forecabecera."; border:1px solid #fff; background:#".$this->lcabecera."; line-height:30px; font-size:15px; overflow:hidden;}
		.menu ul {padding:0; margin:0; list-style: none;}
		.menu ul li {float:left; position:relative;}
		.menu ul li ul {display: none;}
		
		/* specific to non IE browsers */
		.menu ul li:hover a {color:#fff; background:#".$this->hcabecera.";}
		.menu ul li:hover ul {display:block; position:absolute; top:31px; left:0; width:auto;}
		.menu ul li:hover ul li a.hide {background:#".$this->lmenu."; color:#".$this->foremenu.";}
		.menu ul li:hover ul li:hover a.hide {background:#".$this->hmenu."; color:#000;}
		.menu ul li:hover ul li ul {display: none;}
		.menu ul li:hover ul li a {display:block; background:#".$this->nmenu."; color:#000;}
		.menu ul li:hover ul li a:hover {background:#".$this->hmenu."; color:#000;}
		.menu ul li:hover ul li:hover ul {display:block; position:absolute; left:108px; top:0;}
		.menu ul li:hover ul li:hover ul.left {left:-105px;}
		</style>";
		echo($cadena);
		return 0;
	}
	
	function CrearCSSMenu(){
		//nombre del archivo cssmenu.css
		if(!is_dir('css_menu/')){
			mkdir('css_menu');
			if(!file_exists('css_menu/estilo.css')){
				$archivo=fopen('css_menu/estilo.css','w');
				if($archivo){
					$cadena="/* ================================================================ 
					This copyright notice must be untouched at all times.
					
					The original version of this stylesheet and the associated (x)html
					is available at http://www.cssplay.co.uk/menus/dd_valid.html
					Copyright (c) 2005-2007 Stu Nicholls. All rights reserved.
					This stylesheet and the assocaited (x)html may be modified in any 
					way to fit your requirements.
					=================================================================== */
					/* common styling */
					.menu {font-family: arial, sans-serif; width:800px; height:150px; position:relative; font-size:15px; z-index:100;}
					.menu ul li a, .menu ul li a:visited {display:block; text-decoration:none; color:#000;width:104px; height:30px; text-align:center; color:#".$this->forecabecera."; border:1px solid #fff; background:#".$this->lcabecera."; line-height:30px; font-size:15px; overflow:hidden;}
					.menu ul {padding:0; margin:0; list-style: none;}
					.menu ul li {float:left; position:relative;}
					.menu ul li ul {display: none;}
					
					/* specific to non IE browsers */
					.menu ul li:hover a {color:#fff; background:#".$this->hcabecera.";}
					.menu ul li:hover ul {display:block; position:absolute; top:31px; left:0; width:auto;}
					.menu ul li:hover ul li a.hide {background:#".$this->lmenu."; color:#".$this->foremenu.";}
					.menu ul li:hover ul li:hover a.hide {background:#".$this->hmenu."; color:#000;}
					.menu ul li:hover ul li ul {display: none;}
					.menu ul li:hover ul li a {display:block; background:#".$this->nmenu."; color:#000;}
					.menu ul li:hover ul li a:hover {background:#".$this->hmenu."; color:#000;}
					.menu ul li:hover ul li:hover ul {display:block; position:absolute; left:105px; top:0;}
					.menu ul li:hover ul li:hover ul.left {left:-105px;}";
					fwrite($cadena,$archivo);
					fclose($archivo);
					return 0;
				}
				else{
					return -1;
				}
			}
		}
		
	}
	
	function RenderMenuSimple(){
		$coinc=array();
		$divis=array();
		$directorio=$this->getModuloDir();
		if($directorio!=''){
		//Contar los archivos que hay en el direcotrio especificado
		//colocar un ultimo caracter que defina si el archivo va al menu o no
			$directorio_dos = opendir($directorio);
			$modelo='/^[A-Za-z0-9_-]{0,64}_[A-Za-z0-9_-]{0,64}_[a-z]{1}.php/';
			$numarchivos=0;
			while ($archivo = readdir($directorio_dos)){
				if($archivo!='.' || $archivo!='..'){
					if(preg_match_all($modelo,$archivo,$coinc)){
						$numarchivos++;
					}
				}
			}
			//crear el menu :):):):):-P
			$directorio_dos = opendir($directorio);
			echo('<table style=\"width:800px;height:40px;\">');
				echo('<tr>');
			$i=0;
			while ($archivo = readdir($directorio_dos)){
				if(preg_match_all($modelo,$archivo,$coinc)){
					echo('<td>');
					$divis=explode('_',$coinc[0][0]);
					$divdos=explode('.',$divis[2]);
					$cadena=$divis[0];
					$id=$divis[2];
					if($divdos[0]=='m'){
						$cadena=str_replace('-', ' ', $cadena);
						$cadena=ucwords($cadena);
						echo("<a href='".$divis[1]."'>".$cadena."</a>");
						echo('</td>');
						if($i<($numarchivos-1)){
							echo('<td style=\"width:40px;\">|</td>');
						}
					}
					$i++;
				}
			}
				echo('</tr>');
			echo('</table>');
		}
		else{
			return -1;
		}
	}

	/* INFORMACION DE LAS VARIABLES DECLARADAS
	 * obtiene elementos 	
	private $menu_padre=array();
	private $link_menu=array();
	private $index_menu;
	private $index_submenu;
	private $index_linksubmenu;
	*/
	function setParentMenu($menu,$nivel){
		//establece un menu padre
		if($menu!='' && $nivel!=''){
			$nivel=0;
			$menu=str_replace(' ','_',$menu);
			$this->menu_padre[$this->index_menu]=$menu;
			$this->niveles[$this->menu_padre[$this->index_menu]]=$nivel;
			$this->index_menu++;
			$this->lastmenu=$menu;
			return 0;		
		}
		
		else{
			return -1;
		}
	}
	
	function getLastParentMenu(){
		//devuelve una cadena del ultimo menu parent que se introdujo
		if($this->lastmenu!=''){
			return $this->lastmenu;
		}
		else{
			return -1;
		}
	}
	
	function seekParentMenu($menu){
		/**busca si el menu existe, devuelve 0 si el procedimiento es exitoso -2 si no lo es y 
		-1 si esta vacia la variable**/
		if(count($this->menu_padre)>0){
			for($i=0;$i<=(count($this->menu_padre)-1);$i++){
				if($this->menu_padre[$i]==$menu){
					$parent=$this->menu_padre[$i];
					return 0;
				}
			}
			return -2;
		}
		else{
			return -1;
		}
	}
	
	function showMenuPadre(){
		if(count($this->menu_padre)>0){
			for($i=0;$i<=(count($this->menu_padre)-1);$i++){
				$parent=$this->menu_padre[$i];
				echo($i.". ".$parent.', NIVEL: '.$this->niveles[$this->menu_padre[$i]].'<br>');
			}
		}
	}
	
	function seekChildParent(){
			/**busca si el menu existe, devuelve 0 si el procedimiento es exitoso -2 si no lo es y 
		-1 si esta vacia la variable**/
		if(count($this->menu_padre)>0){
			for($i=0;$i<=(count($this->submenu_padre)-1);$i++){
				if($this->submenu_padre[$i]==$menu){
					$child=$this->submenu_padre[$i];
					return 0;
				}
			}
			return -2;
		}
		else{
			return -1;
		}	
	}
	
	function MenuAppendChild($menupadre,$menuhijo,$enlacemhijo){
		//relaciona el menu con el menu padre y su correspondiente enlace a otro lugar...
		if($this->seekParentMenu($menupadre)==0){
			if($menupadre!='' && $menuhijo!='' && $enlacemhijo!=''){
				$nivel=1;
				$enlacemhijo=str_replace(' ','_',$enlacemhijo);
				$menupadre=str_replace(' ','_',$menupadre);
				$menuhijo=str_replace(' ','_',$menuhijo);
				$this->niveles[$menupadre]=$nivel;
				$this->submenu_padre[$menupadre][$this->index_submenu]=$menuhijo;
				$this->linksubmenu_padre[$menupadre][$this->index_submenu]=$enlacemhijo;
				$this->index_submenu++;
				$this->index_linksubmenu++;
			}
		}
		else{
			return -1;
		}
	}

	function RenderXMLMenu(){
		/*
		 * escribir las directivas XMl del menu en los archivos 
		correspondientes para despues ser renderizados en HTML
		con la funcion RenderHTMLMenu();
		*/
	
		//crea el archivo de los menus padre
		$myclasqq= new xmlclass();
		$myclasqq->XMLDocNew('menus_padre.xml');
		$myclasqq->MkNodeFirst('sistema');
		
		for($i=0;$i<=(count($this->menu_padre)-1);$i++){
			$y=0;
			$q=0;
			//u= indica que es la ultima etiqueta de la clase
			//uf=indica que es la ultima clase
			$str='menu_'.strtolower($this->menu_padre[$i]);
			$myclasqq->MkSetClase($str);	
			$myclasqq->MkSubNode(strtolower($this->menu_padre[$i]).'_nombre',strtolower($this->menu_padre[$i]));
			$x=0;
			foreach($this->submenu_padre[$this->menu_padre[$i]] as $key=>$value){
				if($this->seekParentMenu($value)!=0){
					$cadenasm=strtolower($this->menu_padre[$i]).'_menuoption_'.$y;
					$y++;				
				}
				else{
					$cadenasm=strtolower($this->menu_padre[$i]).'_menuchild_'.$q;
					$q++;				
				}
				//nombre del menu - enlace del menu
				$cadenanombre=strtolower($value).'-'.strtolower($this->linksubmenu_padre[$this->menu_padre[$i]][$key]);
				$myclasqq->MkSubNode($cadenasm,$cadenanombre);
				$x++;
			}
			
			if($this->seekParentMenu($this->menu_padre[$i])==0 && $x!=0){
				$myclasqq->MkSubNode(strtolower($this->menu_padre[$i]).'_numero_submenus',$x);
			}
			else{
				$myclasqq->MkSubNode(strtolower($this->menu_padre[$i]).'_numero_submenus',$x);
			}
			$myclasqq->MkSubNode(strtolower($this->menu_padre[$i]).'_nivel_menu',$this->getNivelMenu($this->menu_padre[$i]),'u');
		}
		
		$numeros=count($this->menu_padre);
		$myclasqq->MkSetClase('Informacion_general');
		//Crear la estructura XML y escribir al archivo
		$myclasqq->MkSubNode('menu_numero_modulos',$numeros,'uf');
	}
	
	
	function getNivelMenu($menu){
		return $this->niveles[$menu];
	}
	function setNameMenuFile($file){
		$this->namefilemenu=$file;
		return 0;
	}
	
	function getNameMenuFile(){
		return $this->namefilemenu;
	}
	
	function RenderMenu(){
		$get=$this->getNameMenuFile();
		if($get!=''){
			if(file_exists($get)){
				$this->RenderXMLMenu();
				$this->RenderHTMLMenu();
				return 0;
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}
	}

	function RenderMenuFile($get){
		if($get!=''){
			if(file_exists($get)){
				$this->RenderXMLMenu();
				$this->RenderHTMLMenu();
				return 0;
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}
	}
	
	function RenderHTMLMenu(){
		//renderizar el menu XML en HTML
		$this->printCSSMenu();
		$get=$this->getNameMenuFile();
		if(file_exists($get)){
			$this->setNameXML($get);
			
			$hcoinc=$this->getElementByTagName('menu_[a-z]{1,50}');
			
			for($i=0;$i<=(count($hcoinc)-1);$i++){
				$aux=explode('_',$hcoinc[$i]);
				$menuaux[]=$aux[1];
				$menul[]=$aux[1];
			}
			
			//buscar los menu que no son de nivel 0
			$encontrado=0;
			$l=0;
			$n=0;
			for($i=0;$i<=(count($hcoinc)-1);$i++){
				$cadena=$menul[$i].'_menuchild_[0-9]{1,5}';
				$conci=$this->getElementByTagName($cadena);
				if(count($conci)>0 && count($conci)<2){
					$auxme=explode('-',$conci);
					$this->childs[$n]=$auxme[0];
					$n++;
				}
				else{
					for($j=0,$x=$n;$j<=(count($conci)-1),$x<=(count($conci)+$n-1);$j++,$x++){
						$auxme=explode('-',$conci[$j]);
						$this->childs[$x]=$auxme[0];
					}
				}
			}
			//pasar los menus que son de nivel 0
			$l=0;
			$e=-2;
			for($i=0;$i<=(count($hcoinc)-1);$i++){
				$menupa=$menul[$i];
				for($j=0;$j<=(count($this->childs)-1);$j++){
					if($this->childs[$j]==$menupa){
						$e=1;
					}
				}
				
				if($e==-2){
					$menufinal[$l]=$menul[$i];
					$l++;
				}
				$e=-2;
			}
			//crear el menu HTML

			?>
			<div class="menu">
			<ul>
			<?php
			for($i=0;$i<=(count($menufinal)-1);$i++){
				$nombremenu=$menufinal[$i];
				$nombremenucs=str_replace('_',' ',$nombremenu);
				echo("<li><a class=\"hide\">".ucwords($nombremenucs)."</a>");
				?>
				<!--[if lte IE 6]>
				<a href=\"#\">DEMOS
				<table><tr><td>
				<![endif]-->
				<ul>
				<?php
				
				$cadena=$nombremenu.'_menuchild[a-z_]{1,50}[0-9]{1,5}';
				$icoinc=$this->getElementByTagName($cadena);
				if(count($icoinc)>0){
					for($j=0;$j<=(count($icoinc)-1);$j++){
						$enlace=$nombremenu.'_menuchild_'.$j;
						$links[]=$this->getElementByTagName($enlace);
					}
					
					for($f=0;$f<=(count($links)-1);$f++){
						$variop=explode('-',$links[$f]);
						$menun='menu_'.$variop[0];
						$cadena=$variop[0].'_menuoption_[0-9]{1,5}';
						$ncoinc=$this->getElementByTagName($cadena);
							$auxmenu=$variop[0];
							$auxmenu=str_replace('_',' ',$auxmenu);
							echo("<li><a class=\"hide\" href='?m=".$variop[0]."' >".ucwords($auxmenu)."></a>")
							?>
						    <!--[if lte IE 6]>
						    <a class="sub" href="../menu/hover_click.html" title="Hover/click with no active/focus borders">HOVER/CLICK &gt;
						    <table><tr><td>
						    <![endif]-->
						
							<ul>
							<?php
							if(count($ncoinc)>0){
								if(count($ncoinc)>0 && count($ncoinc)<2){
									$varios=explode('-',$ncoinc);
									$auxmenu=$varios[0];
									$auxmenu=str_replace('_',' ',$auxmenu);
									echo("<li><a href='?m=".$varios[1]."'>".$auxmenu."</a></li>");
								}
								else{
									$linksb=array();
									for($j=0;$j<=(count($ncoinc)-1);$j++){
										$enlace=$variop[0].'_menuoption_'.$j;
										$linksb[]=$this->getElementByTagName($enlace);
									}
									
									for($k=0;$k<=(count($linksb)-1);$k++){
										$variop=explode('-',$linksb[$k]);
										$auxmenu=$variop[0];
										$auxmenu=str_replace('_',' ',$auxmenu);
										$auxmenu=ucwords($auxmenu);
										echo("<li><a href=\"?m=$variop[1]\">{$auxmenu}</a></li>");
									}
									$linksb=array();
									$ncoinc=array();
									$icoinc=array();
								}
							}
					?>
						</ul>
					<!--[if lte IE 6]>
					</td></tr></table>
				    </a>
				    <![endif]-->
					<?php
					}
					$links=array();
				}

				$cadena=$nombremenu.'_menuoption_[a-z_]{0,50}[0-9]{1,5}';
				$vcoinc=$this->getElementByTagName($cadena);
				if(count($vcoinc)>0){
					if(count($vcoinc)>0 && count($vcoinc)<2){
						$varios=explode('-',$vcoinc);
						$auxmenu=$varios[0];
						$auxmenu=str_replace('_',' ',$auxmenu);
						$auxmenu=ucwords($auxmenu);
						echo("<li><a href='?m=".$varios[1]."'>".$auxmenu."</a></li>");
					}
					else{
						for($j=0;$j<=(count($vcoinc)-1);$j++){
							$enlace=$nombremenu.'_menuoption_'.$j;
							$linksb[]=$this->getElementByTagName($enlace);
						}
						
						for($k=0;$k<=(count($linksb)-1);$k++){
							$variop=explode('-',$linksb[$k]);
							$auxmenu=$variop[0];
							$auxmenu=str_replace('_',' ',$auxmenu);
							$auxmenu=ucwords($auxmenu);
							echo("<li><a href=\"?m=$variop[1]\">{$auxmenu}</a></li>");
						}
						$linksb=array();
						$ncoinc=array();
						$icoinc=array();
					}
				}
			?>
		    <!--[if lte IE 6]>
		    <a class=\"sub\" href=\"../menu/hover_click.html\" title=\"Hover/click with no active/focus borders\">HOVER/CLICK &gt;
		    <table><tr><td>
		    <![endif]-->
			<!--[if lte IE 6]>
			</td>
			</tr>
			</table>
		    </a>
		    <![endif]-->
		
			</li>
			</ul>
			<?php
			}
			?>
			</ul>	
		</div>
		<?php
			return 0;
		}
	}
	
	function getIntoFolder($menu){
		$coinc=array();
		$divis=array();
		$directorio=$this->getModuloDir();
		if($directorio!=''){
			if($this->seekParentMenu($menu)==0){
				//Contar los archivos que hay en el direcotrio especificado
				//colocar un ultimo caracter que defina si el archivo va al menu o no
				$directorio_dos = opendir($directorio);
				$modelo='/^[A-Za-z0-9_-]{0,64}_[A-Za-z0-9_-]{0,64}_[a-z]{1}.php/';
				$numarchivos=0;
				while ($archivo = readdir($directorio_dos)){
					if($archivo!='.' || $archivo!='..'){
						if(preg_match_all($modelo,$archivo,$coinc)){
							$numarchivos++;
						}
					}
				}
				//crear el menu :):):):):-P
				$directorio_dos = opendir($directorio);
				$i=0;
				while ($archivo = readdir($directorio_dos)){
					if(preg_match_all($modelo,$archivo,$coinc)){
						$divis=explode('_',$coinc[0][0]);
						$divdos=explode('.',$divis[2]);
						$cadena=$divis[0];
						$id=$divis[2];
						if($divdos[0]=='m' || $divdos[0]=='a' || $divdos[0]=='t'){
							$cadena=str_replace('-', ' ', $cadena);
							$cadena=ucwords($cadena);
							$this->MenuAppendChild($menu,$divis[0],$divis[1]);
						}
						$i++;
					}
				}
			}
			else{
				return -2;
			}
		}
		else{
			return -1;
		}	
	}
}
?>