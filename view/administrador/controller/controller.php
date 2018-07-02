<?php

require_once '../../../model/GModel.php';
session_start();
$gmodel = new GModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];

switch($opcion){
    case "salir":
        unset($_SESSION['admin']);
        header('Location: ../index.php');
        break;
    case "loginadmin":
        //obtenemos los parametros del formulario:
        $usuario=$_REQUEST['usuario'];
        $password=$_REQUEST['password'];
        $user=$gmodel->getAdministrador($usuario, $password);
        if($user==null){
            $_SESSION['mensajeerror']="Usuario o password incorrecto.";
            header('Location: ../login.php');
        }else{
            $_SESSION['admin'] = serialize($user);
            $listado = $gmodel->getPedidos();
            $_SESSION['listadoGeek'] = serialize($listado);
            $_SESSION['opcion']="listarpedidos";
            header('Location: ../index.php');
        }
        break;
    case "listarpedidos":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getPedidos();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarpedidos";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    case "listarfacturas":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getFacturas();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarfacturas";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    case "listarproductos":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getProductoProvedores();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproductos";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    case "verfactura":
        //obtenemos la lista de facturas:
        $factura = $gmodel->getFactura($_REQUEST['idFactura']);
        //y los guardamos en sesion:
        $_SESSION['facturaGeek'] = serialize($factura);
        $_SESSION['opcion']="listarfacturas";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../verfactura.php');
        break;
    case "listarproveedores":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getProveedores();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproveedores";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    case "listarsoloproductos":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getProductos();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarsoloproductos";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    case "editarproducto":
        $objeto=$gmodel->getProducto($_REQUEST['idProducto']);
        $_SESSION['objeto']=serialize($objeto);
        header('Location: ../editarProducto.php');
        break;
    case "actualizarproducto":
        
        $stock=$_REQUEST['stock'];$descripcion=$_REQUEST['descripcion'];$precioUnit=$_REQUEST['precioUnit'];$idProveedor=$_REQUEST['idProveedor'];$codProducto=$_REQUEST['codProducto'];$idProducto=$_REQUEST['idProducto'];$tipoProducto=$_REQUEST['tipoProducto'];
        $gmodel->actualizarProducto($codProducto,$stock,$descripcion,$precioUnit,$idProveedor,$tipoProducto,$idProducto);
        $listado = $gmodel->getProductos();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarsoloproductos";
        header('Location: ../index.php');
        break;
    case "ingresarProducto":
        $stock=$_REQUEST['stock'];$descripcion=$_REQUEST['descripcion'];$precioUnit=$_REQUEST['precioUnit'];$idProveedor=$_REQUEST['idProveedor'];$codProducto=$_REQUEST['codProducto'];$tipoProducto=$_REQUEST['tipoProducto'];//TipoProducto
        $gmodel->insertarProducto($codProducto, $stock, $descripcion, $precioUnit, $idProveedor, $tipoProducto);
        $listado = $gmodel->getProductos();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarsoloproductos";
        header('Location: ../index.php');
        break;    
    case "eliminarproducto":
        $gmodel->eliminarProducto($_REQUEST['idProducto']);
        $listado = $gmodel->getProductos();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarsoloproductos";
        header('Location: ../index.php');
        break;
    case "eliminarfactura":
        $gmodel->eliminarFactura($_REQUEST['idFactura']);
        $listado = $gmodel->getFacturas();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarfacturas";
        header('Location: ../index.php');
        break;
    case "verfactura":
        $factura=$gmodel->getFactura($_REQUEST['idFactura']);
        $_SESSION['facturaGeek'] = serialize($factura);
        header('Location: ../factura.php');
        break;
    case "confirmarfactura":
        $factura=$gmodel->getFactura($_REQUEST['idFactura']);
        $_SESSION['facturaGeek'] = serialize($factura);
        header('Location: ../factura.php');
        break;
    //-------------------------------------------------//
    case "editarproveedor":
        $objeto=$gmodel->getProveedor($_REQUEST['idProveedor']);
        $_SESSION['objeto']=serialize($objeto);
        header('Location: ../editarProveedor.php');
        break;
    case "actualizarproveedor": //idProveedor codigoproveedor nombre telefono email
        $idProveedor=$_REQUEST['idProveedor']; $codigoproveedor=$_REQUEST['codigoproveedor']; $nombre=$_REQUEST['nombre']; $telefono=$_REQUEST['telefono']; $email=$_REQUEST['email'];$direccion=$_REQUEST['direccion'];
        $gmodel->actualizarProveedor($codigoproveedor,$nombre ,$telefono, $email,$direccion,$idProveedor);
        $listado = $gmodel->getProveedores();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproveedores";
        header('Location: ../index.php');
        break;
    case "ingresarProveedor": //codproveedor nombre telefono email direccion
        $codproveedor=$_REQUEST['codproveedor']; $nombre=$_REQUEST['nombre']; $telefono=$_REQUEST['telefono']; $email=$_REQUEST['email']; $direccion=$_REQUEST['direccion'];
        $gmodel->insertarProveedor($codproveedor, $nombre, $telefono, $email, $direccion);
        $listado = $gmodel->getProveedores();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproveedores";
        header('Location: ../index.php');
        break;    
    case "eliminarproveedor":
        $gmodel->eliminarProveedor($_REQUEST['idProveedor']);
        $listado = $gmodel->getProveedores();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproveedores";
        header('Location: ../index.php');
        break;
    //-----------------------------------------//
    case "eliminarpedido":
        $gmodel->eliminarPedido($_REQUEST['idPedido']);
        $listado = $gmodel->getPedidos();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarpedidos";
        header('Location: ../index.php');
        break;
    //-----------------------------------------//
    case "registrar":
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $gmodel->insertarUsuario($email, $password);
        header('Location: ../view/index.php');
        break;
    case "registro":
        header('Location: ../../../view/registro.php');
        break;
        
    // -----------------------------categoria-------//
    
    case "listaCategorias":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getCategorias();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listaCategorias";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    
    case "editarCategoria":
        $objeto=$gmodel->getCategoria($_REQUEST['id_cat']);
        $_SESSION['objeto']=serialize($objeto);
        header('Location: ../editarCategoria.php');
        break;
    
    case "actualizarCategorias": //idProveedor codigoproveedor nombre telefono email
        $id_cat=$_REQUEST['id_cat'];
        $nombreCat=$_REQUEST['nombreCat'];
        $gmodel->actualizarCategoria($nombreCat, $id_cat);
        $listado = $gmodel->getCategorias();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listaCategorias";
        header('Location: ../index.php');
        break;
    
    case "ingresarCategoria": //
        
        $nombreCat=$_REQUEST['nombreCat'];
        $gmodel->insertarCategorias($nombreCat);
        $listado = $gmodel->getCategorias();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listaCategorias";
        header('Location: ../index.php');
        break;    
    
    case "eliminarCategorias":
        $gmodel->eliminarCategoria($_REQUEST['id_cat']);
        $listado = $gmodel->getCategorias();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listaCategorias";
        header('Location: ../index.php');
        break;
    
    
     // -----------------------------OFERTAS-------//
    
    case "listarOfertas":
        //obtenemos la lista de facturas:
        $listado = $gmodel->getOfertas();
        //y los guardamos en sesion:
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarOfertas";
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;
    
    case "editarOferta":
        $objeto=$gmodel->getOferta($_REQUEST['id_oferta']);
        $_SESSION['objeto']=serialize($objeto);
        header('Location: ../editarOfertas.php');
        break;
    
    case "actualizarOfertas": //idProveedor codigoproveedor nombre telefono email
        $id_oferta=$_REQUEST['id_oferta'];
        $cod_oferta=$_REQUEST['cod_oferta'];
        $precio=$_REQUEST['precio'];
        $descripcion=$_REQUEST['descripcion'];
        $categoria=$_REQUEST['categoria'];                
        $gmodel->actualizarOferta($cod_oferta, $precio, $descripcion, $categoria, $id_oferta);
        $listado = $gmodel->getOfertas();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarOfertas";
        header('Location: ../index.php');
        break;
    
    case "ingresarOfertas": //
        
        $cod_oferta=$_REQUEST['cod_oferta'];
        $precio=$_REQUEST['precio'];
        $descripcion=$_REQUEST['descripcion'];
        $categoria=$_REQUEST['categoria'];
        $gmodel->insertarOferta($cod_oferta, $precio, $descripcion, $categoria);
        $listado = $gmodel->getOfertas();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarOfertas";
        header('Location: ../index.php');
        break;    
    
    case "eliminarOferta":
        $gmodel->eliminarOferta($_REQUEST['id_oferta']);
        $listado = $gmodel->getOfertas();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarOfertas";
        header('Location: ../index.php');
        break;
    
    
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}

