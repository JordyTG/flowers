<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    include_once '../../model/GModel.php';
    if(isset($_SESSION['admin'])){
        $user=  unserialize($_SESSION['admin']);
        $gmodel=new GModel();
    
?>
<html>
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
          <input type="hidden" name="opcion" value="listarproveedores" >
          <button type="submit" class="btn btn-block" >Volver</button>
          </form>
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
        
        <?php
        $objeto=unserialize($_SESSION['objeto']);
        ?>
        
        <form action="controller/controller.php">
        <input type="hidden" name="opcion" value="actualizarproveedor">
        <table>
                <tr>
                    <td>Id Producto: </td>
                    <td>
                        <?php echo $objeto->getId_proveedor();?>
                        <input type="hidden" name="idProveedor" value="<?php echo $objeto->getId_proveedor(); ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Codigo de Proveedor: </td>
                    <td><input type='text' name='codigoproveedor' value="<?php echo $objeto->getCodproveedor();?>"></td>
                </tr>
                <tr>
                    <td>Nombre: </td>
                    <td><input type='text' name='nombre' value="<?php echo $objeto->getNombre();?>"></td>
                </tr>
                <tr>
                    <td>Telefono: </td>
                    <td><input type='text' name='telefono' value="<?php echo $objeto->getTelefono();?>"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type='text' name='email' value="<?php echo $objeto->getEmail();?>"></td>
                </tr>
                <tr>
                    <td>Direccion: </td>
                    <td><input type='text' name='direccion' value="<?php echo $objeto->getDireccion();?>"></td>
                </tr>
        </table>
        <input class='btn-warning' type='submit' value='Guardar'>
        </form>

        
    </body>
    
    
        <?php
    
            }else{
                header("location: login.php");
            }
    ?>
    
    
</html>
