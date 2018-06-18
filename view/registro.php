<!DOCTYPE html>
<?php
require '../model/Usuario.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="js/jquery-1.4.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
    </head>
    <body>
        <div align="center">
            <div class="container">
                <div class="page-header">
                    <h1>BIENVENIDO AL REGISTRO DE USUARIO</h1>      
                </div>
                <p>Llenar todos los campos :)</p>      
                
            </div>
            <br>
        <form action="../controller/controller.php">
            <table>
                <input type="hidden" name="opcion" value="registrar_usuario">       
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" placeholder="email"  class="form-control"  required="true"></td>                    
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Password" class="form-control"  required="true"></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" placeholder="nombre"  class="form-control" required="true"></td>
                </tr>    
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" name="apellido" placeholder="apeliido"   class="form-control" required="true"></td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td><input type="text" name="direccion" placeholder="direccion"  class="form-control" required="true"></td>                    
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input type="text" name="telefono" placeholder="telefono" class="form-control" required="true"></td>                    
                </tr>
                
               
               <tr>
                    <td>
                    <br>                
                    <input type="submit" value="REGISTRAR" class="btn btn-success"></td>
                    <td>
                    
               </tr> 
               
            </table>        
        </form>
            <br>
            <br>
            <form action="../view/index.php">
                <table>
                    <tr>                                        
                    <td><input type="submit" value="VOLVER AL INICIO" class="btn btn-info"></td>                        
                    </tr>
                </table>
                
            </form>    
            </div>
    </body>
</html>

