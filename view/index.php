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
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
                if (isset($_SESSION['user'])) {
                    $user = unserialize($_SESSION['user']);
                    ?>
                    <div class="navbar-form navbar-right">
                        <a class="navbar-brand">BIENVENIDO: <?php echo $user->getEmail() ?> </a>
                        <a class="navbar-brand" href="../controller/controller.php?opcion=salir">SALIR</a>
                    </div>
                    <?php
                } else {
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
<!--            <h2>Carousel Example</h2>  -->
<!--            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                 Indicators 
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                 Wrapper for slides 
                <div class="carousel-inner">
                    <div class="item active" style="width:50%">
                        <img src="../view/img/estilos/sl1.jpg" alt="Los Angeles" style="width:50%" style="height:50%">
                    </div>

                    <div class="item">
                        <img src="../view/img/estilos/sl4.jpg" alt="Chicago" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="../view/img/estilos/sl3.jpg" alt="New york" style="width:100%;">
                    </div>
                </div>

                 Left and right controls 
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>-->




        </div>
            
            
                <center>
                    <!--<h3>@Flowers</h3>
                <p>Dise&ntilde;a tu propio regalo.</p>-->


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                 
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="../view/img/estilos/sl1.jpg" alt="Los Angeles" style="width:72%;">
                    </div>

                    <div class="item">
                        <img src="../view/img/estilos/sl4.jpg" alt="Chicago" style="width:138%;">
                    </div>

                    <div class="item">
                        <img src="../view/img/estilos/sl3.jpg" alt="New york" style="width:91%;">
                    </div>
                </div>

               
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>




                <p><a class="btn btn-primary btn-lg" href="personalizar.php" role="button">CREAR &raquo;</a></p>
                </center>
                
            </div>


        </div>

        <div class="container">
            <!-- Example row of columns AQUI LOS PRODUCTOS -->
            <div class="row">
                <?php
                $gmodel = new GModel();
                $oferta = $gmodel->getOfertasProd();
                foreach ($oferta as $ofer) {
                    ?>

                    <div class="col-md-4">
                        <h4><?php echo "Precio: $" . $ofer->getPreciounit(); ?></h4>
                        <p>ID: <?php echo $ofer->getId_producto(); ?></p>
                        <p>Codigo: <?php echo $ofer->getCodproducto(); ?></p>
                        <p>Descripcion del producto: <?php echo $ofer->getDescripcion(); ?></p>
                        <image class='img-rounded' width="200px" height="200px" src="img/flowers/<?php echo $ofer->getCodproducto(); ?>.jpg">  
                        <form action='../controller/controller.php'>  
                            <input type='hidden' name='idOferta' value='<?php echo $ofer->getId_producto(); ?>'>
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
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = '//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
