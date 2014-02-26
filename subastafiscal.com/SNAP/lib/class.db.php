<?
class db{
	private $vardb;
	
	public function __construct(){
		$this->vardb="mysql";
	}
	/* 
		Funcion generica para conectarse a la bd
		Parametros:
			$imprime  = default false, determina si se usa
						el servidor de reportes pdf
		
	*/
	public function db_connect(){
		
		/* mysql: */ 
		$par_host = "68.178.143.68";
		$par_user = "subastafiscal1";
		$par_pass = "Subastaf01!";
		$dbName   = "subastafiscal1";
		
		/* odbc:*/
		//$dsn_name = "dsn_sf";
		//$par_user = "dba";
		//$par_pass = "sql";
		//$dbName   = "";
				
		switch ($this->vardb){
			case "sybase":
				$this->conid = @sybase_connect($par_host,$par_user,$par_pass);
				$GLOBALS['conid']=$this->conid;
				if ($GLOBALS['conid']>0){
					$a=$this->db_select_db($dbName);
					if ($a<1){
						echo "No se encontro la base de datos ".$dbName." en el servidor.";
					}
					//echo $a;
				}else{
					echo "Problemas al conectar con el servidor de datos... verifique la conexion a '".$par_host."'";
					die(@sybase_get_last_message());
				}
				return $this->conid;
					
			case "odbc": 
				$this->conid = @odbc_connect($dsn_name,$par_user,$par_pass);
				$GLOBALS['conid']=$this->conid;
				
				if (!isset($GLOBALS['conid'])){
					echo "No se encontro la base de datos ".$dbName." en el servidor.";
				}
								
				return $this->conid;
				
			case "mysql":
				$this->conid = mysql_connect($par_host,$par_user,$par_pass);
				$GLOBALS['conid']=$this->conid;
				if ($GLOBALS['conid']>0){
					$a=$this->db_select_db($dbName);
					if ($a<1){
						echo "No se encontro la base de datos ".$dbName." en el servidor.";
					}
					//echo $a;
				}else{
					die ("Problemas al conectar con el servidor de datos... verifique la conexion a '".$par_host."'");
				}
				return $this->conid;
				
			default:
				echo "Error al intentar ejecutar conexion, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica para seleccionar bd a traves de 
		  manejador de conexion
		Parametros:
			$par_name = Nombre de la bd a seleccionar
			$par_con  = Manejador de conexion actual
		
	*/
	public function db_select_db($par_name){
		switch ($this->vardb){
			case "sybase":
				$this->bdsel = @sybase_select_db($par_name,$this->conid);
				return $this->bdsel;
				
			case "mysql":
				$this->bdsel = @mysql_select_db($par_name,$this->conid);
				return $this->bdsel;
			case "odbc": 
				/*
				$this->bdsel = @mysql_select_db($par_name,$this->conid);
				return $this->bdsel;
				*/
			default:
				echo "Error al intentar ejecutar select_db, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica para ejecutar un query a la
		  bd a traves del manejador de conexion
		Parametros:
			$par_query = Query solicitada
			$par_con   = Manejador de conexion actual
		
	*/
	public function db_query($par_query){
		switch ($this->vardb){
			case "sybase":
				$this->result = @sybase_query($par_query,$this->conid);
				return $this->result;
				
			case "mysql":
				$this->result = mysql_query($par_query,$this->conid);
				return $this->result;
			case "odbc":
				$this->result = @odbc_exec($this->conid,$par_query);
				return $this->result;	
				
			default:
				echo "Error al intentar ejecutar query, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}

	/* 
		Funcion generica que devuelve las filas de un
		  query como una matriz enumerada
		Parametros:
			$par_result = resultado del query hecho
	
	*/
	public function db_fetch_row(){
		switch ($this->vardb){
			case "sybase":
				 $this->frow = @sybase_fetch_row($this->result);
				 return $this->frow;
				 
			case "mysql":
				$this->frow = mysql_fetch_row($this->result);
				return $this->frow;
			case "odbc":
				$this->frow = @odbc_fetch_row($this->result);
				return $this->frow;	
				
			default:
				echo "Error al intentar ejecutar fetch_row, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica que devuelve las filas de un
		  query como una matriz con los nombres de campos
		  como indices 
		Parametros:
			$par_result = resultado del query hecho
		
	*/
	public function db_fetch_array(){
		switch ($this->vardb){
			case "sybase":
				$this->farry = @sybase_fetch_array($this->result);
				return $this->farry;
				
			case "mysql":
				$this->farry = mysql_fetch_array($this->result);
				return $this->farry;
			case "odbc":
				$this->farry = @odbc_fetch_array($this->result);
				return $this->farry;	
				
			default:
				echo "Error al intentar ejecutar fetch_array, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica que finaliza una coneccion a la bd
		Parametros:
			$par_con   = Manejador de conexion actual
		
	*/
	public function db_close(){
		switch ($this->vardb){
			case "sybase":
				$this->cls = @sybase_close($this->conid);
			case "mysql":
				$this->cls = @mysql_close($this->conid);
			case "odbc":
				$this->cls = @odbc_close($this->conid);	
			default:
				echo "Error al intentar ejecutar close, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica que cuenta las filas devueltas por un query
		Parametros:
			$par_result = resultado del query hecho
		
	*/
	public function db_num_rows(){
		switch ($this->vardb){
			case "sybase":
				$this->nrow = @sybase_num_rows($this->result);
				return $this->nrow;
				
			case "mysql":
				$this->nrow = mysql_num_rows($this->result);
				return $this->nrow;
			case "odbc":
				$this->nrow = @odbc_num_rows($this->result);
				return $this->nrow;	
			default:
				echo "Error al intentar ejecutar num_rows, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
	
	/* 
		Funcion generica que cuenta los campos devueltos por un query
		Parametros:
			$par_result = resultado del query hecho
		
	*/
	public function db_num_fields($par_result){
		switch ($this->vardb){
			case "sybase":
				$this->nfields = @sybase_num_fields($this->result);
				return $this->nfields;
				
			case "mysql":
				$this->nfields = mysql_num_fields($par_result);
				return $this->nfields;
			case "odbc":
				$this->nfields = @odbc_field_num($par_result);
				return $this->nfields;	
			default:
				echo "Error al intentar ejecutar num_fields, se debe 
					  indicar el tipo de base de datos de trabajo en
					  configuracion del sistema";
		}
	}
}
?>