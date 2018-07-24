<?php

require_once '../model/GModel.php';
require_once '../lib/envioCorreo.php';
session_start();
$gmodel = new GModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];

switch($opcion){
    case "registro":
        header('Location: ../view/registro.php');
        break;
    case "actualizarCantidad":
        $idDetalle=$_REQUEST['idDetalle'];
        $cantidad=$_REQUEST['cantidad'];
        $valorUnit=$_REQUEST['valorUnit'];
        $gmodel->actualizarDetalle($cantidad, $valorUnit, $idDetalle);
        header('Location: ../view/finalizarOferta.php');
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
    case "pedirPersonalizar":
        $idUsuario=$_REQUEST['idUsuario'];
        $Flores=$_REQUEST['Flores'];
        $Dulces=$_REQUEST['Dulces'];
        $Chocolates=$_REQUEST['Chocolates'];
        $Peluches=$_REQUEST['Peluches'];
        $Tarjeta=$_REQUEST['Tarjeta'];
        $Frutas=$_REQUEST['Frutas'];
        $listado = array();
        if($Flores!="Ninguno"){ array_push($listado,$gmodel->getProducto($Flores));}
        if($Dulces!="Ninguno"){ array_push($listado,$gmodel->getProducto($Dulces));}
        if($Chocolates!="Ninguno"){ array_push($listado,$gmodel->getProducto($Chocolates));}
        if($Peluches!="Ninguno"){ array_push($listado,$gmodel->getProducto($Peluches));}
        if($Tarjeta!="Ninguno"){ array_push($listado,$gmodel->getProducto($Tarjeta));}
        if($Frutas!="Ninguno"){ array_push($listado,$gmodel->getProducto($Frutas));}
        if(($gmodel->getPedidoUsuario($idUsuario))==null){
            $gmodel->insertarPedido($idUsuario);
        }
        $pedido=$gmodel->getPedidoUsuario($idUsuario);
        $_SESSION['pedido']=  serialize($pedido);
        foreach($listado as $producto){
           $gmodel->insertarDetalle($pedido->getIdPedido(), $producto->getId_producto(), $producto->getDescripcion(), 1, $producto->getPreciounit());
        }
        header('Location: ../view/finalizarOferta.php');
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
        $envio=new Email('Flowers',"ibarraanonimo@gmail.com","Feniletilamina1");
        $user= unserialize($_SESSION['user']);
        $envio->agregar($user->getEmail(),$user->getNombre());
        if($envio->enviar("Factura Flowers: ".$user->getNombre(), $gmodel->getContenidoFactura($facturaGeek,$user))){
            header('Location: ../view/factura.php');
        }else{
            header('Location: ../view/finalizarOferta.php');
        }
        
        break;
    
    
    
    
    //****************************** crud categoriaa ******* //
    
    case "editarFinalizar":
            $idDetalles = $_REQUEST['idDetalles'];
            $listadod = $gmodel->getDetalle($idDetalles);
            $_SESSION['listadod']=$listadod;
            header('Location: ../view/editarFinalizar.php');
            break;
        
        
    case "actualizar":
            $idDetalles = $_REQUEST['idDetalles'];
            $id_pedido = $_REQUEST['id_pedido'];
            $id_producto = $_REQUEST['id_producto'];
            $dscricpcion = $_REQUEST['descripcion'];          
            $cantidad = $_REQUEST['cantidad'];            
            $valor_unit = $_REQUEST['valor_unit'];            
            $valor_total = $_REQUEST['valor_total'];            
            $listadod ->edita($id_integrante, $nombre_integrante, $correo_integrante, $celular_integrante);
            $listado = $integranteModel ->getIntegrantes();            
            $_SESSION['listado'] = serialize($listado);            
            header('Location: ../view/integrantes.php');
            break;
    
    
    case "actualizarDetalle": //idProveedor codigoproveedor nombre telefono email
        //Detalle($dato['id_detalles'],$dato['id_pedido'],$dato['id_producto'],$dato['descripcion'],$dato['cantidad'],$dato['valor_unit'],$dato['valor_total']);
        $id_producto=$_REQUEST['id_producto']; $descripcion=$_REQUEST['descripcion']; $cantidad=$_REQUEST['cantidad']; 
        $gmodel->actualizarProveedor($codigoproveedor,$nombre ,$telefono, $email,$direccion,$idProveedor);
        $listado = $gmodel->getProveedores();
        $_SESSION['listadoGeek'] = serialize($listado);
        $_SESSION['opcion']="listarproveedores";
        header('Location: ../FinalizarOferta.php');
        break;
    
    case "editardetalle":
        $idDetalles=$_REQUEST['idDetalles'];
        $gmodel->actualizarDetalle($idDetalles);
        header('Location: ../view/finalizar.php');
        break;
    
    case "eliminardetalle":
        $idDetalle=$_REQUEST['idDetalle'];
        $gmodel->eliminarDetalle($idDetalle);
        header('Location: ../view/finalizar.php');
        break;
    
    default:
        header('Location: ../view/index.php');
}

