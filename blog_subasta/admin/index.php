<?php
session_start();
//REVISAR PAGINA COMPLETA MANANA
include("conf/config.conf.php");
include("conf/functions.php");
$conexion=mysql_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD);
if($conexion){
	$seleccionar=mysql_select_db(NOMBRE_BD);
	mysql_query("SET NAMES 'utf8'");
}
?>
<!DOCTYPE html>
<html>
	<head>
	<script type="text/javascript" src="libs/ckeditor/ckeditor.js"></script>
    <title>Sistema de Administracion web oscarcarvallo.com</title>
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
    </head>
    <body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
	<link rel="stylesheet" type="text/css" href="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js" type="text/javascript"></script>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" type="text/css" rel="stylesheet"></link>
<?php
	if($_SESSION['usuarioreg']==''){
		?>
		    <div class="navbar navbar-inverse navbar-fixed-top">
		      <div class="navbar-inner">
		        <div class="container-fluid">
		          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="brand" href="#">subastafiscal.com Blog</a>
		          </div><!--/.nav-collapse -->
		        </div>
		      </div>
		    </div>
		   <div class="container">
		      <form method="POST" enctype="multipart/form-data" class="form-signin">
		        <h2 class="form-signin-heading">Entrar</h2>
		        <input name="usuariot" id="usuariot" type="text" class="input-block-level" placeholder="Email">
		        <input name="clavet" id="clavet" type="password" class="input-block-level" placeholder="Clave">
		        <label class="checkbox">
		          <input type="checkbox" value="remember-me"> Recu&eacute;rdame
		        </label>
		        <input id="btningresar" name="btningresar" type="submit" class="btn btn-large btn-primary" value="Entrar"></input>
<?php
	$btnlog=$_POST['btningresar'];
	if($btnlog){
		//echo("HOLA1");
		$usuario=$_POST['usuariot'];
		$clave=md5($_POST['clavet']);
		$sqlog="SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
		$pedidolog=mysql_query($sqlog,$conexion);
		echo(mysql_error());
		//echo("HOLA2");
		if($pedidolog){
			//echo("HOLA3");
			echo(mysql_error());
			$filaslog=mysql_num_rows($pedidolog);
			if($filaslog>0){
				//echo("HOLA4");
				$datoslog=mysql_fetch_array($pedidolog);
				$_SESSION['usuarioreg']=$datoslog['usuario'];
				$_SESSION['idusuario']=$datoslog['ID'];
				$_SESSION['nombrereal']=strtoupper($datoslog['nombre']." ".$datoslog['apellido']);
				$_SESSION['nivel']=$datoslog['nivel'];
				$_SESSION['email']=$datoslog['email'];
				$_SESSION['cedula']=$datoslog['cedula'];
				$_SESSION['telefono']=$datoslog['telefono'];
				$_SESSION['loggedin']="true";
				echo("Usuario Registrado: ".$_SESSION['usuarioreg']);
				?>
				<script type="text/javascript" language="JavaScript">
					location.href="index.php?mod=adminnoticias&opcion=&subopcion=agregar";
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript" language="JavaScript">
					alert("Usuario/Contraseña Incorrecto!");
				</script>
				<?php
			}
		}
	}
?>
		      </form>
		    </div> <!-- /container -->
		<?php
	}
	else{
		?>
		    <div class="navbar navbar-inverse navbar-fixed-top">
		      <div class="navbar-inner">
		        <div class="container-fluid">
		          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="brand" href="#">subastafiscal.com Blog</a>
		          <div class="nav-collapse collapse">
		            <p class="navbar-text pull-right">
		              <a href="#" class="navbar-link"><?php echo($_SESSION['usuarioreg']); ?></a>
		            	&nbsp;
		              	|
		              	&nbsp;
		              <a href="cerrarsession.php" class="navbar-link">Cerrar Sesi&oacute;n</a>
		            </p>
		            <ul class="nav">
		              <li><a href="index.php?mod=adminnoticias&opcion=noticias&subopcion=agregar&entrar=">Noticias</a></li>
		              <li><a href="index.php?mod=admindescargas&opcion=descargas&subopcion=agregar&entrar=">Descargables</a></li>
		            </ul>
		          </div><!--/.nav-collapse -->
		        </div>
		      </div>
		    </div>
		<?php
		$plantilla=$_GET['mod'];
		if($plantilla!=''){
			$modul="mods/".$plantilla.".php";
			if(file_exists($modul)){
				include($modul);
			}
			else{
				?>
					<script type="text/javascript">
						location.href="index.php";
					</script>
				<?php
			}
		}
	}
?>
    
	</body>
</html>
