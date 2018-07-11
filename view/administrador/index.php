<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php
    session_start();

    include_once '../../model/GModel.php';
    if (isset($_SESSION['admin'])) {
        $user = unserialize($_SESSION['admin']);
        $gmodel = new GModel();
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
                            <input type="hidden" name="opcion" value="listarfacturas" >
                            <button type="submit" class="btn btn-block" >Facturas</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listarpedidos" >
                            <button type="submit" class="btn btn-block" >Pedidos</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listarproductos" >
                            <button type="submit" class="btn btn-block" >Productos y Proveedor</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listarsoloproductos" >
                            <button type="submit" class="btn btn-block">Productos</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listarproveedores" >
                            <button type="submit"  class="btn btn-block">Proveedores</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listaCategorias" >
                            <button type="submit"  class="btn btn-block">Categorias</button>
                        </form>
                        <form action="controller/controller.php" class="navbar-form navbar-right" role="form">
                            <input type="hidden" name="opcion" value="listarOfertas" >
                            <button type="submit"  class="btn btn-block">Ofertas Regalos</button>
                        </form>
                    </div><!--/.navbar-collapse -->
                </div>
            </nav>
            </br>    
            <div class="container">          
                <?php
                if ($_SESSION['opcion'] == "listarproductos") {
                    ?>
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>id_producto</th>
                                <th>stock</th>
                                <th>descripcion</th>
                                <th>tipoProducto</th>
                                <th>precio_unit</th>
                                <th>id_provedor</th>
                                <th>nombre</th>
                                <th>telefono</th>
                                <th>correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //verificamos si existe en sesion el listado de facturas:
                            if (isset($_SESSION['listadoGeek'])) {
                                $listado = unserialize($_SESSION['listadoGeek']);
                                foreach ($listado as $obj) {
                                    echo "<tr>";
                                    echo "<td>" . $obj->getIdProducto() . "</td>";
                                    echo "<td>" . $obj->getStock() . "</td>";
                                    echo "<td>" . $obj->getDescripcion() . "</td>";
                                    echo "<td>" . $obj->getTipoProducto() . "</td>";
                                    echo "<td>" . $obj->getPrecioUnit() . "</td>";
                                    echo "<td>" . $obj->getIdProveedor() . "</td>";
                                    echo "<td>" . $obj->getNombre() . "</td>";
                                    echo "<td>" . $obj->getTelefono() . "</td>";
                                    echo "<td>" . $obj->getCorreo() . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "No se han cargado datos.";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>

                <?php
                if ($_SESSION['opcion'] == "listarfacturas") {
                    //nombre,cedula, telefono, direccion, num_facturas, ruc,
                    //fecha_emision, tipo_gasto,valor_base,iva,descuento,total, id_pedido,confirmacion) values(?,?,?,?,?,?,?,?,?,?,?,?,?)
                    ?>
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>Num_Factura</th>
                                <th>Nombre</th>
                                <th>CI/RUC</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Total</th>
                                <th>Eliminar</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //verificamos si existe en sesion el listado de facturas:
                            if (isset($_SESSION['listadoGeek'])) {
                                $listado = unserialize($_SESSION['listadoGeek']);
                                foreach ($listado as $obj) {
                                    echo "<tr>";
                                    echo "<td>" . $obj->getIdFacturas() . "</td>";
                                    echo "<td>" . $obj->getNombre() . "</td>";
                                    echo "<td>" . $obj->getCi_ruc() . "</td>";
                                    echo "<td>" . $obj->getCorreo() . "</td>";
                                    echo "<td>" . $obj->getTelefono() . "</td>";
                                    echo "<td>" . $obj->getTotal() . "</td>";
                                    echo "<td><a href='controller/controller.php?opcion=eliminarfactura&idFactura=" . $obj->getIdFacturas() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                    echo "<td><a href='controller/controller.php?opcion=verfactura&idFactura=" . $obj->getIdFacturas() . "'><span class='glyphicon glyphicon-pencil'> Ver </span></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "No se han cargado datos.";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>


                <?php
                if ($_SESSION['opcion'] == "listarsoloproductos") {
                    ?>
                    <input type="button" value="Nuevo Producto" onclick="$('#capaproducto').css('display', 'block')" class="btn btn-primary">
                    <div id="capaproducto" style="display: none;padding: 10px; background-color: #FFE4C4">
                        <form action="controller/controller.php">
                            <input type='hidden' name='opcion' value='ingresarProducto'>    
                            <table>
                                <tr>
                                    <td>Cod Producto: </td>
                                    <td>
                                        <input pattern="[a-9]{5}" type="text" name="codProducto" placeholder='Max 5 Caracteres' value="" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td><input type='number' min='10' max='100' name='stock' value="1" required></td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td><input type='text' name='descripcion' placeholder='Descripcion' value="" required></td>
                                </tr>
                                <tr>
                                    <td>Precio Unit.</td>
                                    <td><input type='number' step='0.01' min='0' name='precioUnit' value="0.99" required></td>
                                </tr>
                                <tr>
                                    <td>Id. Proveedor: </td>
                                    <td><select name="idProveedor">
                                            <?php
                                            $provedores = $gmodel->getProveedores();
                                            foreach ($provedores as $ofer) {
                                                echo "<option value=\"" . $ofer->getId_proveedor() . "\">" . $ofer->getCodproveedor() . "</option>";
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Tipo de Producto: </td>
                                    <td><select name="tipoProducto">
                                            <?php
//                            $tipoProducto=$gmodel->getTipoProductos();
//                            foreach ($tipoProducto as $p) {
//                            echo "<option value=\"".$p->getTipoProducto()."\">".$p->getTipoProducto()."</option>";
//                            }
                                            ?>
                                            <option value="Flores">Flores</option>
                                            <option value="Peluches">Peluches</option>
                                            <option value="Frutas">Frutas</option>
                                            <option value="Dulces">Dulces</option>
                                        </select></td>
                                </tr>

                            </table>
                            <input type="submit" value="Ingresar" />
                        </form>
                    </div>
                    </br>    
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>id_producto</th>
                                <th>codProducto</th>
                                <th>stock</th>
                                <th>descripcion</th>
                                <th>tipoProducto</th>
                                <th>precio_unit</th>
                                <th>id_provedor</th>
                                <th>editar</th>
                                <th>eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //verificamos si existe en sesion el listado de facturas:
                            if (isset($_SESSION['listadoGeek'])) {
                                $listado = unserialize($_SESSION['listadoGeek']);
                                foreach ($listado as $obj) {
                                    echo "<tr>";
                                    echo "<td>" . $obj->getId_producto() . "</td>";
                                    echo "<td>" . $obj->getCodproducto() . "</td>";
                                    echo "<td>" . $obj->getStock() . "</td>";
                                    echo "<td>" . $obj->getDescripcion() . "</td>";
                                    echo "<td>" . $obj->getTipoProducto() . "</td>";
                                    echo "<td>" . $obj->getPreciounit() . "</td>";
                                    echo "<td>" . $obj->getId_proveedor() . "</td>";
                                    echo "<td><a href='controller/controller.php?opcion=editarproducto&idProducto=" . $obj->getId_producto() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                                    echo "<td><a href='controller/controller.php?opcion=eliminarproducto&idProducto=" . $obj->getId_producto() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "No se han cargado datos.";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>

                <?php
                if ($_SESSION['opcion'] == "listarproveedores") {
                    //$id_proveedor,$codproveedor,$nombre,$telefono,$email,$direccion
                    //codproveedor nombre telefono email direccion
                    ?>
                    <input type="button" value="Nuevo Proveedor" onclick="$('#capaproveedor').css('display', 'block')" class="btn btn-primary">
                    <div id="capaproveedor" style="display: none;padding: 10px; background-color: #FFE4C4">
                        <form action="controller/controller.php">
                            <input type='hidden' name='opcion' value='ingresarProveedor'>    
                            <table>
                                <tr>
                                    <td>Codigo de Proveedor: </td>
                                    <td>
                                        <input pattern="[a-9]{5}" type="text" name="codproveedor" placeholder='Codigo' value="" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre u Empresa: </td>
                                    <td><input type='text' name='nombre' value="" placeholder='Proveedor' required></td>
                                </tr>
                                <tr>
                                    <td>Telefono: </td>
                                    <td><input type='text' name='telefono' placeholder='Telefono' value="" required></td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td><input type='text' name='email' placeholder='example@email.com' required></td>
                                </tr>
                                <tr>
                                    <td>Direccion: </td>
                                    <td><input type='text' name='direccion' placeholder='Ubicacion' required></td>
                                </tr>
                            </table>
                            <input type="submit" value="Ingresar" />
                        </form>
                    </div>
                    </br> 
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>id_proveedor</th>
                                <th>codProveedor</th>
                                <th>nombre</th>
                                <th>telefono</th>
                                <th>email</th>
                                <th>direccion</th>
                                <th>editar</th>
                                <th>eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //verificamos si existe en sesion el listado de facturas:
                            if (isset($_SESSION['listadoGeek'])) {
                                $listado = unserialize($_SESSION['listadoGeek']);
                                foreach ($listado as $obj) {
                                    echo "<tr>";
                                    echo "<td>" . $obj->getId_proveedor() . "</td>";
                                    echo "<td>" . $obj->getCodproveedor() . "</td>";
                                    echo "<td>" . $obj->getNombre() . "</td>";
                                    echo "<td>" . $obj->getTelefono() . "</td>";
                                    echo "<td>" . $obj->getEmail() . "</td>";
                                    echo "<td>" . $obj->getDireccion() . "</td>";
                                    echo "<td><a href='controller/controller.php?opcion=editarproveedor&idProveedor=" . $obj->getId_proveedor() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                                    echo "<td><a href='controller/controller.php?opcion=eliminarproveedor&idProveedor=" . $obj->getId_proveedor() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "No se han cargado datos.";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>

                <?php
                if ($_SESSION['opcion'] == "listarpedidos") {
                    //$idPedido,$fecha, $confirmacion,$correo
                    ?> 
                    <table border="1" class="table">
                        <thead>
                            <tr>
                                <th>id_Pedido</th>
                                <th>fecha</th>
                                <th>confirmacion</th>
                                <th>correo</th>
                                <th>eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //verificamos si existe en sesion el listado de facturas:
                            if (isset($_SESSION['listadoGeek'])) {
                                $listado = unserialize($_SESSION['listadoGeek']);
                                foreach ($listado as $obj) {
                                    echo "<tr>";
                                    echo "<td>" . $obj->getIdPedido() . "</td>";
                                    echo "<td>" . $obj->getFecha() . "</td>";
                                    echo "<td>" . $obj->getConfirmacion() . "</td>";
                                    echo "<td>" . $obj->getCorreo() . "</td>";
                                    echo "<td><a href='controller/controller.php?opcion=eliminarpedido&idPedido=" . $obj->getIdPedido() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "No se han cargado datos.";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>

            </div>    
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

            <script src="js/vendor/bootstrap.min.js"></script>

            <script src="js/main.js"></script>






            <?php
            if ($_SESSION['opcion'] == "listaCategorias") {
                //$id_proveedor,$codproveedor,$nombre,$telefono,$email,$direccion
                //codproveedor nombre telefono email direccion
                ?>
                <input type="button" value="Nueva Categoria" onclick="$('#capacategoria').css('display', 'block')" class="btn btn-primary">
                <div id="capacategoria" style="display: none;padding: 10px; background-color: #FFE4C4">
                    <form action="controller/controller.php">
                        <input type='hidden' name='opcion' value='ingresarCategoria'>    
                        <table>
        <!--                                <tr>
                                <td>Codigo de Categoria: </td>
                                <td>
                                    <input pattern="[a-9]{5}" type="text" name="id_cat" placeholder='id categoria' value="" required/>
                                </td>
                            </tr>-->
                            <tr>
                                <td>Nombre Categoria: </td>
                                <td>
                                    <input type='text' name='nombreCat' value="" placeholder='Categoria' required>
                                </td>
                            </tr>

                        </table>
                        <input type="submit" value="Ingresar" />
                    </form>
                </div>
                </br> 
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th>Id Categoria</th>
                            <th>Nombre Categoria</th>                            
                            <th>editar</th>
                            <th>eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //verificamos si existe en sesion el listado de facturas:
                        if (isset($_SESSION['listadoGeek'])) {
                            $listado = unserialize($_SESSION['listadoGeek']);
                            foreach ($listado as $obj) {
                                echo "<tr>";
                                echo "<td>" . $obj->getId_cat() . "</td>";
                                echo "<td>" . $obj->getNombreCat() . "</td>";
                                echo "<td><a href='controller/controller.php?opcion=editarCategoria&id_cat=" . $obj->getId_cat() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                                echo "<td><a href='controller/controller.php?opcion=eliminarCategorias&id_cat=" . $obj->getId_cat() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No se han cargado datos.";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            ?>







            <?php
            if ($_SESSION['opcion'] == "listarOfertas") {

                ?>
                <input type="button" value="Nuevas Ofertas" onclick="$('#capaoferta').css('display', 'block')" class="btn btn-primary">
                <div id="capaoferta" style="display: none;padding: 10px; background-color: #FFE4C4">
                    <form action="controller/controller.php">
                        <input type='hidden' name='opcion' value='ingresarOfertas'>    
                        <table>        
                            <tr>
                                <td>Codigo Oferta Regalo: </td>
                                <td>
                                    <input pattern="[a-9]{5}" type="text" name="cod_oferta" placeholder='Codigo' value="" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Precio Unit.</td>
                                <td><input type='number' step='0.01' min='0' name='precio' value="0.99" required></td>
                            </tr>                            
                            <tr>
                                <td>Descripción: </td>
                                <td><input type='text' name='descripcion' placeholder='descripción' required></td>
                            </tr>
                            <tr>
                                <td>Categoria: </td>
                                <td><input type='text' name='categoria' placeholder=Categoria' required></td>
                            </tr>

                        </table>
                        <input type="submit" value="Ingresar" />
                    </form>
                </div>
                </br> 
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th>Id Oferta Regalo</th>
                            <th>Codigo Oferta</th>                            
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Categoria</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //verificamos si existe en sesion el listado de facturas:
                        if (isset($_SESSION['listadoGeek'])) {
                            $listado = unserialize($_SESSION['listadoGeek']);
                            foreach ($listado as $obj) {
                                echo "<tr>";
                                echo "<td>" . $obj->getId_oferta() . "</td>";
                                echo "<td>" . $obj->getCod_oferta() . "</td>";
                                echo "<td>" . $obj->getPrecio() . "</td>";
                                echo "<td>" . $obj->getDescripcion() . "</td>";
                                echo "<td>" . $obj->getCategoria() . "</td>"; 
                                echo "<td><a href='controller/controller.php?opcion=editarOferta&id_oferta=" . $obj->getId_oferta() . "'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                                echo "<td><a href='controller/controller.php?opcion=eliminarOferta&id_oferta=" . $obj->getId_oferta() . "'><span class='glyphicon glyphicon-pencil'> Eliminar </span></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No se han cargado datos.";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            ?>



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
        <?php
    } else {
        header("location: login.php");
    }
    ?>
</html>
