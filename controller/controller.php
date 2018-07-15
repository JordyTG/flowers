<?php

require_once '../model/GModel.php';
session_start();
$gmodel = new GModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];

switch($opcion){
    case "registro":
        header('Location: ../view/registro.php');
        break;
    case "oferta":
        $oferta=$gmodel->getOfertaProd($_REQUEST['idOferta']);
        $_SESSION['oferta']=serialize($oferta);
        header('Location: ../view/pedido.php');
        break;
    case "registrar_usuario":
        
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $nombre=$_REQUEST['nombre'];
        $apellido=$_REQUEST['apellido'];
        $direccion=$_REQUEST['direccion'];
        $telefono=$_REQUEST['telefono'];
        
        $gmodel->insertarUsuario($email,$password,$nombre,$apellido,$direccion,$telefono);
        header('Location: ../view/index.php');
        break;
	case "registrar":
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $gmodel->insertarUsuario($email, $password);
        header('Location: ../view/index.php');
        break;
    case "pedir":
        $correo=$_REQUEST['email'];
        if(($gmodel->getPedidoUsuario($correo))==null){
            $gmodel->insertarPedido($correo);
        }
        $pedido=$gmodel->getPedidoUsuario($correo);
        $_SESSION['pedidogeek']=  serialize($pedido);
        $_SESSION['correogeek']=$correo;////(BORRAR DESPUES DE CREAR LOGIN)NO LO OLVIDES .. CUANDO SE INICIE SESION SE CREARA UN ATRIBUTO DE SESION CORREOGEEK Y ESTA LINEA NO SERA NECESARIA
        $cantidad=$_REQUEST['cantidad'];
        $oferta=  unserialize($_SESSION['productogeek']);
        $gmodel->insertarDetalle($pedido->getIdPedido(), $oferta->getCodProducto(), $oferta->getDescripcion(), $cantidad, $oferta->getPrecioUnit());
        header('Location: ../view/finalizar.php');
        break;
    case "pedirOferta":
        $idUsuario=$_REQUEST['idUsuario'];
        if(($gmodel->getPedidoUsuario($idUsuario))==null){
            $gmodel->insertarPedido($idUsuario);
        }
        $pedido=$gmodel->getPedidoUsuario($idUsuario);
        $_SESSION['pedidoOferta']=  serialize($pedido);
        $cantidad=$_REQUEST['cantidad'];
        $productoOferta=  unserialize($_SESSION['oferta']);
        $gmodel->insertarDetalle($pedido->getIdPedido(), $productoOferta->getId_producto(), $productoOferta->getDescripcion(), $cantidad, $productoOferta->getPreciounit());
        header('Location: ../view/finalizarOferta.php');
        break;
    //---------------------------
    case "login":
        //obtenemos los parametros del formulario:
        $usuario=$_REQUEST['usuario'];
        $password=$_REQUEST['password'];
        $user=$gmodel->getUsuario($usuario, $password);
        if($user==null){
            $_SESSION['mensajeerror']="Usuario o password incorrecto.";
            header('Location: ../view/login.php');
        }else{
            $_SESSION['user'] = serialize($user);
            header('Location: ../view/index.php');
        }
        break;
    case "salir":
        unset($_SESSION['user']);
        header('Location: ../view/index.php');
        break;
    case "ingresarfactura":
        $nombre=$_REQUEST['nombre']; $telefono=$_REQUEST['telefono']; $direccion=$_REQUEST['direccion']; $ruc=$_REQUEST['ruc']; $tipo_gasto=$_REQUEST['tipoGasto'];$idPedido=$_REQUEST['idPedido'];
        $gmodel->insertarFactura($nombre, $telefono, $direccion, $ruc, $tipo_gasto,$idPedido);
        $facturaGeek=$gmodel->getFacturaporPedido($idPedido);
        $_SESSION['facturaF']=serialize($facturaGeek);
        header('Location: ../view/factura.php');
        break;
    case "eliminardetalle":
        $idDetalle=$_REQUEST['idDetalle'];
        $gmodel->eliminarDetalle($idDetalle);
        header('Location: ../view/finalizar.php');
        break;
    
    
    //****************************** crud categoriaa ******* //
    
    
    
        
    
    
    default:
        header('Location: ../view/index.php');
}

