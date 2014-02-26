<?php 
session_start();
require_once('lib/config.conf.php');
require_once('lib/functions.php');
//CREAR PDF
$fileparser='libs/roslib/class.ezpdf.php';
if (file_exists($fileparser)){
	require_once($fileparser);
	//$pdf= new Cezpdf('a4','landscape');
}
$dbn=new op_mysql();
$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
$dbn2=new op_mysql();
$dbn2->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
//echo($dbn->getIDConn());
if($_GET["logout"]=="true"){
	$_SESSION = array();
	session_destroy();
}
if(isset($_POST["user"])){
    $query  = "SELECT * FROM usuarios WHERE email='".$_POST["user"]."' AND clave='".md5($_POST["pass"])."'";
    //echo $query;
	if($dbn->QuerySQL($query)==0){
		if($dbn->getFilas()>0){
			/*getData obtiene informacion de la consulta */
			//echo("FILAS".$dbn->getFilas());
			$datasql=$dbn->getData();
            $_SESSION['Nombre_Admin']        = $datasql['nombre'];
            $_SESSION['Correo_Admin']        = $datasql['email'];
            $_SESSION['Tipo_Identificacion'] = $datasql['tipoidentificacion'];
            $_SESSION['Nro_Identificacion']  = $datasql['cedula'];
            $_SESSION["logged"]              = true;
			$_SESSION['idusuario']			 = $datasql['ID'];
            header("location: index.php");
		}
	}
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	    <link rel="stylesheet" href="css/bootstrap-responsive.css" />
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon2.png">
	    <style type="text/css">
	      body {
	        padding-top: 40px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
	      }
	
	      .form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
	        margin: 0 auto 20px;
	        background-color: #fff;
	        border: 1px solid #e5e5e5;
	        -webkit-border-radius: 5px;
	           -moz-border-radius: 5px;
	                border-radius: 5px;
	        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	                box-shadow: 0 1px 2px rgba(0,0,0,.05);
	      }
	      .form-signin .form-signin-heading,
	      .form-signin .checkbox {
	        margin-bottom: 10px;
	      }
	      .form-signin input[type="text"],
	      .form-signin input[type="password"] {
	        font-size: 16px;
	        height: auto;
	        margin-bottom: 15px;
	        padding: 7px 9px;
	      }
	    </style>
	    <script src="http://code.jquery.com/jquery.js"></script>
	    <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
		<link rel="stylesheet" type="text/css" href="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js" type="text/javascript"></script>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" type="text/css" rel="stylesheet"></link>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.2/backbone-min.js"></script>
        <!-- <script type="text/javascript" src="http://www.subastafiscal.com:3000/socket.io/socket.io.js"></script> !-->
        <!-- <script type="text/javascript" src="js/chat_admin.js"></script> !-->
        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
		<![endif]-->
		<title>ADMIN SubastaFiscal.com - 2014</title>
    </head>
    <body>
<?php
include('header.php');
cabecera("Bienvenido", 2);
//include 'header_adm.php';
//cabecera_adm("Bienvenido", 2);
if($_SESSION["logged"]!=true){ ?>
        <div class="container">
            <div class="row">
                <div class="span8 offset2" >
                    <div class="well">
                        <h2>Ingrese</h2>
                        <hr>
                        <form class="form-horizontal" id="login_log" autocomplete="off" method="post" action="index.php">
                            <fieldset>
								<?php if(isset($_GET["error"])){ ?>
								    <div class="control-group">
								        <div class="controls">
								            <p class="text-error" style="color: red">Usuario o Contraseña Inválido</p>
								        </div>
								    </div>
								<?php } ?>
                                <div class="control-group">
                                    <label class="control-label" for="usu_nombre">Usuario</label>
                                    <div class="controls">
                                        <input type="text" id="user" placeholder="Usuario del Sistema" name="user">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="usu_clave">Contraseña</label>
                                    <div class="controls">
                                        <input type="password" id="pass"  name="pass">
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button  class="btn" id="signupsubmit" name="signup" type="submit" value="Signup">Ingresar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
	}
	else{
		if($_GET['mod']!=''){
			$modulo="mods/".$_GET['mod'].".php";
			include($modulo);	
		}
	}
	include('footer.php'); 
?>
    </body>
</html>