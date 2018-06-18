<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
       <div class = "container">
	<div class="wrapper">
            <form action="controller/controller.php" method="post" name="Login_Form" class="form-signin">       
		    <h3 class="form-signin-heading">Bienvenido Administrador!</h3>
			  <hr class="colorgraph"><br>
                          <input type="hidden" name="opcion" value="loginadmin">
			  <input type="text" class="form-control" name="usuario" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Entrar</button>  			
            </form>			
        </div>
       </div>
    </body>
</html>
