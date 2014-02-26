<?php 

session_start();
date_default_timezone_set('America/Caracas');

if (!isset($_SESSION["logged"])){
    header('Location: index.php');
	require_once 'lib/function_gen.php';
	require_once 'lib/gencontrols.php';
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
        <title>Subasta Web/Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 0px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">
        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
            <![endif]-->
    </head>
    <body>
        <?php
        //include 'header.php';
        //cabecera("Subasta Web/Admin", 1);
		include 'header_adm.php';
		cabecera_adm("");
		
        ?>
        <?php include 'footer.php'; ?>
    </body>
</html>
