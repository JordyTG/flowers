<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();
    include_once '../model/Producto.php';
    include_once '../model/Usuario.php';
    if(isset($_SESSION['user'])){
        $user=  unserialize($_SESSION['user']);
        
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-form navbar-right">
          <a class="navbar-brand">BIENVENIDO: <?php echo $user->getEmail()?> </a>
          <a class="navbar-brand" href="../controller/controller.php?opcion=salir">SALIR</a>
        </div>
      </div>
    </nav>
     
        
        <?php
        if(isset($_SESSION['oferta'])){
        $oferta=  unserialize($_SESSION['oferta']);    
        ?>
    <div class="container">    
        
        <div class="col-md-4">
            
            <h1><?php echo $oferta->getCod_oferta()?></h1>
            
            <!--<image class='img-rounded' width="200px" height="200px" src="img/<?php echo $oferta->getCodproducto();?>.jpg">-->  
            <form action='../controller/controller.php'>
            <table>
                <tr>
                    <td>Cod. Producto: </td>
                    <td><?php echo $oferta->getCod_oferta()?></td>
                </tr>
                <tr>
                    <td>Correo: </td>
                    <td><input type="text" name="email" value="<?php echo $user->getEmail()?>" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Cantidad: </td>
                    <td><input type="number" name="cantidad" value="1" min='1' max='10'/></td>
                </tr>
                <input type='hidden' name='idOferta' value='<?php echo $oferta->getId_oferta()?>'>
                <input type='hidden' name='opcion' value='pedir'>
            </table></br>
            <input type="submit" value="Confirmar" class='btn-success'/>   
            </form>
            
        </div>
        
        <?php
        }else{
        ?>
        
        <h1>No has seleccionado nada aún.</h1>
        </br>
        <form action="index.php">
                <table>
                    <tr>                                        
                    <td><input type="submit" value="VOLVER AL INICIO" class="btn btn-info"></td>                        
                    </tr>
                </table>
                
            </form>  
        <?php
        }
        ?>
        </br>
        <footer>
        <p>&copy; Company 2015</p>
        </footer>
    </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
    <?php 
    
    }else{
        header("location: login.php");
    }?>
</html>
