<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();
    include_once '../model/GModel.php';
    if(isset($_SESSION['usergeek'])){
        $user=  unserialize($_SESSION['usergeek']);
        $correo= $user->getCorreo();
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
          <a class="navbar-brand">BIENVENIDO: <?php echo $user->getCorreo()?> </a>
          <a class="navbar-brand" href="../controller/controller.php?opcion=salir">SALIR</a>
        </div>
      </div>
    </nav></br>

        
    <div class="container">    
        <div>
        <!--<div class="col-md-4">-->
        <!--
        id_facturas`, `nombre`, `telefono`, `direccion`, `ci_ruc`, `fecha_emision`, `tipo_gasto`, 
          `valor_base`, `iva`, `descuento`, `total`, `id_pedido`, `confirmacion
        -->
            <?php
            if(isset($_SESSION['facturaGeek'])){
            $facturaGeek=  unserialize($_SESSION['facturaGeek']);
                $gmodel=new GModel();
                $lista=$gmodel->getDetalles($facturaGeek->getIdPedido());
            ?>
            <h1>COMPRA EXITOSA:</h1>
            
            <table border="1">
                <thead>
                    <tr>
                        <th colspan="2">Factura: <?php echo $facturaGeek->getIdFacturas();?></th>
                        <th colspan="3">Fecha: <?php echo $facturaGeek->getFecha_emision();?></th>
                    </tr>
                    <tr>
                        <td colspan="5"> </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Nombre: <?php echo $facturaGeek->getNombre();?></td>
                        <td colspan="3">Direccion: <?php echo $facturaGeek->getDireccion();?></td>
                    </tr>
                    <tr>
                        <td>Teléfono: <?php echo $facturaGeek->getTelefono();?></td>
                        <td colspan="2">CI/RUC: <?php echo $facturaGeek->getCi_ruc();?></td>
                        <td colspan="2">Correo: <?php echo $facturaGeek->getCorreo();?></td>
                    </tr>
                    <tr>
                        <td colspan="5"> </td>
                    </tr>
                    <tr>
                        <th colspan="5" align="center">DETALLES</th>
                    </tr>
                    <tr>
                        <th>CodProducto</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>ValorUnit</th>
                        <th>ValorTotal</th>
                    </tr>
                    <?php 
                        foreach ($lista as $detalle) {
                    ?>
                    <tr>
                        <td><?php echo $detalle->getCodProducto();?></td>
                        <td><?php echo $detalle->getDescripcion();?></td>
                        <td><?php echo $detalle->getCantidad();?></td>
                        <td><?php echo $detalle->getValorUnit();?></td>
                        <td><?php echo $detalle->getValorTotal();?></td>
                    </tr>
                    <?php
                        }
                    ?>  
                    <tr>
                        <th colspan="4">SUBTOTAL: </th>
                        <td><?php echo $facturaGeek->getValor_base();?></td>
                    </tr>
                    <tr>
                        <th colspan="4">IVA: </th>
                        <td><?php echo $facturaGeek->getIva();?></td>
                    </tr>
                    <tr>
                        <th colspan="4">VALOR TOTAL: </th>
                        <td><?php echo $facturaGeek->getTotal();?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            }
            ?>
        </div>
        
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
    }
    
    ?>
</html>