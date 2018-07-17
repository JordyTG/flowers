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
        $idUsuario= $user->getId_usuario();
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

        
    <div class="container">    
        <div>
        <!--<div class="col-md-4">-->
            
            <h1>DETALLES DE COMPRA:</h1>
            <?php 
                $gmodel=new GModel();
                $pedido=$gmodel->getPedidoUsuario($idUsuario);
                if($pedido!=null){
                $idPedido=$pedido->getIdPedido();
                $lista=$gmodel->getDetalles($idPedido);
                $subtotal=$gmodel->getSumaDetalles($lista);
                //$nombre, $telefono, $direccion, $ruc, $tipo_gasto,$idPedido
            ?>
            <table border="1" class="table">
                <thead>
                    <tr>
                        <th class="active">id_producto</th>
                        <th class="active">descripcion</th>
                        <th class="active">cantidad</th>
                        <th class="active">valor. unit.</th>
                        <th class="active">valor total</th>
                        <th class="active">eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($lista as $detalle) {
                        
                    ?>                
                        
                    <tr>
                        <td><?php echo $detalle->getCodProducto();?></td>
                        <td><?php echo $detalle->getDescripcion();?></td>
                        <td><?php echo $detalle->getCantidad();?></td>
                        <td><?php echo $detalle->getValorUnit();?></td>
                        <td><?php echo $detalle->getValorTotal();?></td>
                        <?php echo "<td><a href='../controller/controller.php?opcion=eliminardetalle&idDetalle=".$detalle->getIdDetalles()."'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";?>
                    </tr>
                    <?php
                        }
                    ?>  
                    <tr>
                        <td colspan="4">VALOR A PAGAR: </td>
                        <td class="warning"><?php echo $subtotal;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>    
            <h2>CAMPOS OBLIGATORIOS: </h2></br>
            <form action='../controller/controller.php'>
               <table>
                   <tr><td>Nombre: </td><td><input type="text" name="nombre" value='' required/></td></tr> 
                   <tr><td>RUC/CI: </td><td><input type="text" name="ruc" value='' required/></td></tr> 
                   <tr><td>Telefono: </td><td><input type="text" name="telefono" value='' required/></td></tr> 
                   <tr><td>Direccion: </td><td><input type="text" name="direccion" value='' required/></td></tr> 
               </table></br>
               <input type="hidden" name="correo" value='<?php echo $pedido->getId_usuario();?>'/>   
               <input type="hidden" name="opcion" value='ingresarfactura'/>   
               <input type="hidden" name="tipoGasto" value='HOGAR'/>   
               <input type="hidden" name="idPedido" value='<?php echo $idPedido;?>'/>
               <input type="submit" value="Realizar Transaccion" class='btn-success'/>   
            </form>
            
            <?php }else{
                echo "<h2>No hay detalles de compra que mostrar.</h2>";
            } ?>
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