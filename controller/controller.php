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
    case "pedido":
        $productogeek=$gmodel->getProducto($_REQUEST['codProducto']);
        $_SESSION['productogeek']=serialize($productogeek);
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
        $producto=  unserialize($_SESSION['productogeek']);
        $gmodel->insertarDetalle($pedido->getIdPedido(), $producto->getCodProducto(), $producto->getDescripcion(), $cantidad, $producto->getPrecioUnit());
        header('Location: ../view/finalizar.php');
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
        $nombre=$_REQUEST['nombre']; $telefono=$_REQUEST['telefono']; $direccion=$_REQUEST['direccion']; $ruc=$_REQUEST['ruc']; $tipo_gasto=$_REQUEST['tipoGasto'];$idPedido=$_REQUEST['idPedido'];$correo=$_REQUEST['correo'];
        $gmodel->insertarFactura($nombre, $telefono, $direccion, $ruc, $tipo_gasto,$idPedido,$correo);
        $facturaGeek=$gmodel->getFacturaporPedido($idPedido);
        $_SESSION['facturaGeek']=serialize($facturaGeek);
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

