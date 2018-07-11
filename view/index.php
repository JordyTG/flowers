<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();
    include_once '../model/GModel.php';
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
        <?php
            if(isset($_SESSION['user'])){
                $user=  unserialize($_SESSION['user']);     
        ?>
        <div class="navbar-form navbar-right">
          <a class="navbar-brand">BIENVENIDO: <?php echo $user->getEmail()?> </a>
          <a class="navbar-brand" href="../controller/controller.php?opcion=salir">SALIR</a>
        </div>
        <?php
            }else{
        ?> 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="registro.php">Registrarse</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <form action="../controller/controller.php" class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input name="usuario" type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
                <input type="hidden" name="opcion" value="login" />    
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        </div><!--/.navbar-collapse -->
        <?php
            }
        ?>
    </div>    
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>@Flowers</h1>
        <p>Dise&ntilde;a tu propio regalo.</p>
        <p><a class="btn btn-primary btn-lg" href="personalizar.php" role="button">CREAR &raquo;</a></p>
      </div>
      
        
    </div>

    <div class="container">
      <!-- Example row of columns AQUI LOS PRODUCTOS -->
      <div class="row">
      <?php
      $gmodel=new GModel();
      $oferta=$gmodel->getOfertas();
      foreach ($oferta as $ofer) {
      ?>
      
        <div class="col-md-4">
          <h4><?php echo "Precio: $".$ofer->getPrecio();?></h4>
          <p>Codigo: <?php echo $ofer->getCod_oferta();?></p>
          <p>Descripcion del producto: <?php echo $ofer->getDescripcion();?></p>
          <image class='img-rounded' width="200px" height="200px" src="img/flowers/<?php echo $ofer->getCod_oferta();?>.jpg">  
          <form action='../controller/controller.php'>  
          <input type='hidden' name='idOferta' value='<?php echo $ofer->getId_oferta();?>'>
          <input type='hidden' name='opcion' value='oferta'>
          <p><input type='submit' class="btn btn-default" value="Comprar >>"></p>
          </form>
        </div>  
          
      <?php
      }
      ?>
      </div>
      <hr>

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
</html>
