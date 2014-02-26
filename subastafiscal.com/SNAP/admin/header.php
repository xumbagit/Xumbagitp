<?php
function cabecera($titulo, $ref){
	session_start();
?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="index.php">Subasta Fiscal</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class=""><a href="index.php?"><i class="icon-home icon-white"></i> Inicio</a></li>
                        <li>
                        	<?php if (isset($_SESSION['logged'])) { ?>
                            <li><a href="index.php?mod=documentorev_grid"><i class="icon-file icon-white"></i> Validar Documentos</a></li>
                            <li><a href="index.php?mod=documento_pago_grid"><i class="icon-shopping-cart icon-white"></i> Validar Pagos</a></li>
                            <li><a href="index.php?mod=adminbanners"><i class=" icon-flag icon-white"></i> Banners</a></li>
                            <li><a href="index.php?mod=adminnoticias"><i class="  icon-globe icon-white"></i> Noticias</a></li>
                            <!--<li class="divider-vertical"></li>-->
                            <!--<li class="divider-vertical"></li>-->
                            <li><a href="index.php?mod=chat_sf_admin"><i class="icon-comment icon-white"></i> Chat</a></li>
                            <li><div class="dropdown">
								  <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" class="btn dropdown-toggle">
								    Admin <span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									<li><a href="index.php?mod=adminmodulos"><i class="icon-hdd icon-black"></i> M&oacute;dulos</a></li>
								    <li><a href="index.php?mod=adminperfiles"><i class="icon-user icon-black"></i> Perfiles</a></li>
								    <li><a href="index.php?mod=gethistorial"><i class="icon-list icon-black"></i> Historial</a></li>
								    <li><a href="index.php?mod=adminusuarios"><i class="icon-user icon-black"></i> Usuarios</a></li>
								  </ul>
								</div>
							</li>
                            <? } ?>
                            <li class="divider-vertical"></li>
                    </ul>
                    <ul class="nav pull-right">
                        <?php if(!isset($_SESSION['logged'])){ ?>
                            <li ><a href="index.php"><i class="icon-off icon-white"></i> Log in</a></li>
                        <?php 
                        	}
                        	else{ 
                        ?>
                            <li ><a href="index.php?logout=true"><i class="icon-off icon-white"></i> Log out</a></li>
                        <?php } ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <?php
    if($_GET['mod']==''){
	    ?>
		    <div class="container">
		        <div class="row">
		            <div class="span12">
		                <h2><? echo($titulo." ".$_SESSION['Nombre_Admin']."!"); ?></h2>
		                <hr /> 
		            </div>
		        </div>
		    </div>
		<?php
    }
}
?>