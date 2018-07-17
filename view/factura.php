<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();
    include_once '../model/GModel.php';
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
    </nav></br>

    <center>
    
        <!--<div class="col-md-4">-->
        <!--
        id_facturas`, `nombre`, `telefono`, `direccion`, `ci_ruc`, `fecha_emision`, `tipo_gasto`, 
          `valor_base`, `iva`, `descuento`, `total`, `id_pedido`, `confirmacion
        -->
            <?php
            if(isset($_SESSION['facturaF'])){
            $facturaGeek=  unserialize($_SESSION['facturaF']);
                $gmodel=new GModel();
                $lista=$gmodel->getDetalles($facturaGeek->getId_pedido());
            ?>
            <h1>COMPRA EXITOSA:</h1>
            <div id="Impresion">
            <table border="1" class="table-condensed">
                <thead>
                    <tr>
                        <th colspan="2">Factura: <?php echo $facturaGeek->getNum_facturas();?></th>
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
                        <td colspan="2">CI/RUC: <?php echo $facturaGeek->getRuc();?></td>
                        <td colspan="2">Correo: <?php echo $user->getEmail();?></td>
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
            <br>
            
            <form action="javascript:imprSelec('Impresion')">
                <input type="submit" class="btn btn-danger" value="IMPRIMIR" >
            </form>
            <br>
            <form action="../view/personalizar.php">
                <input type="submit" class="btn btn-success" value="PERSONLAIZA TU REGALO" >
            </form>
<!--            <h1><a href="javascript:imprSelec('Impresion')" class="btn-info">Imprimir</a></h1>-->
        <script type="text/javascript">

        function imprSelec(historial) {
            var ficha = document.getElementById(historial);
            var ventimp = window.open('', 'new div', 'height=500,width=900');
            ventimp.document.write("");
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }



        </script>    
            
        </div>
        
        </br>
        <footer>
        <p>&copy; Company 2018</p>
        </footer>
    </div> 
        </center>    
        <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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