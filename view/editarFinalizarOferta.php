<!DOCTYPE html>
<?php
session_start();
include_once '../model/GModel.php';
include_once '../model/Detalle.php';
?>
<html>
    <head>
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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="controller/controller.php?opcion=salir">SALIR</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">

                    <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                        <input type="hidden" name="opcion" value="ingresarfactura" >
                        <button type="submit" class="btn btn-block" >Volver</button>
                    </form>

                </div><!--/.navbar-collapse -->
            </div>
        </nav>



        <?php        
        //session_start();
        $listadod = unserialize($_SESSION['listadod']);
        ?>

        <form action="controller/controller.php">
            <input type="hidden" name="opcion" value="actualizar">
            <input type="hidden" value="<?php echo $lisatadod->getIdDetalles(); ?>" name="idDetalles">
            <table>
                
                
                <tr>
                    <td>Id Pedido: </td>
                    <td>
                        <?php echo $listadod->getId_producto; ?>
                        <input type="hidden" name="id_pedido" value="<?php echo $listadod->getId_pedido(); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <td>Id Producto: </td>
                    <td>
                        <?php echo $listadod->getId_producto; ?>
                        <input type="hidden" name="id_producto" value="<?php echo $listadod->getId_producto(); ?>" />
                    </td>
                </tr>
                
                
                <tr>
                    <td>Descripción: </td>
                    <td>
                        <input pattern="[a-9]{5}" type="text" name="descripcion"  value="<?php echo $listadod->getDescripcion(); ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td>Cantidad.</td>
                    <td><input type='number' step='0.01' min='0' name='cantidad' value="<?php echo $listadod->getCantidad(); ?>" required></td>
                </tr> 
                
                
                <tr>
                    <td>Descripción: </td>
                    <td>
                        <input pattern="[a-9]{5}" type="text" name="valor_unit"  value="<?php echo $listadod->getValor_unit(); ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td>Valor Unit</td>
                    <td><input type='number' step='0.01' min='0' name='valor_total' value="<?php echo $listadod->getValor_total(); ?>" required></td>
                </tr>
                
                
                
                <tr>
                    <td>Valor Total </td>
                    <td>
                        <?php echo $listadod->getId_producto; ?>
                        <input type="hidden" name="id_producto" value="<?php echo $listadod->getId_producto(); ?>" />
                    </td>
                </tr>
                

                                           
                

            </table>
            <input class='btn-warning' type='submit' value='Guardar'>
        </form>

    </body>
//    <?php
//    } else {
//        header("location: login.php");
//    }
//    ?>
</html>
