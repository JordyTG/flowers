<?php

include_once 'Database.php';
include_once 'Proveedor.php';
include_once 'Factura.php';
include_once 'Producto.php';
include_once 'Detalle.php';
include_once 'Pedido.php';
include_once 'Usuario.php';
include_once 'Administrador.php';
include_once 'ProductoProveedor.php';

class GModel {
     
    public function getUsuario($usuario, $password){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from usuarios where email=? and password=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($usuario, $password));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        if($dato==null){
            $user=null;    
        }else{//
            $user = new Usuario($dato['id_usuario'],$dato['email'],$dato['password'],$dato['nombre'],$dato['apellido'],$dato['direccion'],$dato['telefono']);
        }
        Database::disconnect();
        return $user;
    }
    public function getAdministrador($usuario, $password){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from administrador where usuario=? and password=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($usuario, $password));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        if($dato==null){
            $user=null;    
        }else{//$idAdministrador, $usuario, $password, $nombre, $apellido, $direccion, $telefono, $email
            $user = new Administrador($dato['id_administrador'],$dato['usuario'],$dato['password'],$dato['nombre'],$dato['apellido'],$dato['direccion'],$dato['telefono'],$dato['email']);
        }
        Database::disconnect();
        return $user;
    }
    
    
    public function insertarUsuario($email,$password,$nombre,$apellido,$direccion,$telefono){
        $pdo = Database::connect();
        $sql = "insert into usuarios(email,password,nombre,apellido,direccion,telefono) values(?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($email,$password,$nombre,$apellido,$direccion,$telefono));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    
    
    public function insertarProveedor($codproveedor, $nombre, $telefono, $email, $direccion){
        $pdo = Database::connect();
        $sql = "insert into Proveedor(codproveedor, nombre, telefono, email, direccion) values(?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($codproveedor, $nombre, $telefono, $email, $direccion));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function getProveedor($idProveedor){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Proveedor where id_proveedor=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idProveedor));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $proveedor = new Proveedor($dato['id_proveedor'],$dato['codproveedor'],$dato['nombre'],$dato['telefono'],$dato['email'],$dato['direccion']);
        Database::disconnect();
        return $proveedor;
    }
    
    public function getTipoProductos(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from tipoproducto";
        $resultado = $pdo->query($sql);
        $listado = array();
        foreach ($resultado as $res){
            $tipoProducto = new TipoProducto($res['id_tipoproducto'],$res['tipoProducto']);
            array_push($listado, $tipoProducto);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    public function getProveedores(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from Proveedor order by id_proveedor";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Proveedor:
        $listado = array();
        foreach ($resultado as $res){//$codproveedor, $nombre, $telefono, $email, $direccion
            $proveedor = new Proveedor($res['id_proveedor'],$res['codproveedor'],$res['nombre'],$res['telefono'],$res['email'],$res['direccion']);
            array_push($listado, $proveedor);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    public function getProductoProvedores(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "SELECT p.id_producto,p.stock,p.descripcion,p.precio_unit,pr.id_proveedor,pr.nombre,pr.telefono,pr.correo FROM productos p INNER JOIN proveedor pr on p.id_proveedor=pr.id_proveedor";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Proveedor:
        $listado = array();
        foreach ($resultado as $res){
            $proveedor = new ProductoProveedor($res['id_producto'],$res['stock'],$res['descripcion'],$res['precio_unit'],$res['id_proveedor'],$res['nombre'],$res['telefono'],$res['correo']);
            array_push($listado, $proveedor);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    
    /**
     * Retorna la lista de facturas de la bdd.
     * @return array
     */
    //
    public function insertarProducto($codProducto, $stock, $descripcion, $precioUnit, $idProveedor,$tipoProducto){
        $pdo = Database::connect();
        $sql = "insert into Productos(codProducto, stock, descripcion, precio_unit, id_proveedor,tipoProducto) values(?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($codProducto, $stock, $descripcion, $precioUnit, $idProveedor, $tipoProducto));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    
    public function getProducto($idProducto){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Productos where id_producto=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idProducto));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:$id_producto, $codproducto, $stock, $descripcion, $preciounit, $id_proveedor, $tipoProducto
        $producto = new Producto($dato['id_producto'],$dato['codproducto'],$dato['stock'],$dato['descripcion'],$dato['precio_unit'],$dato['id_proveedor'],$dato['tipoProducto']);
        Database::disconnect();
        return $producto;
    }


    
    public function getProductos(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from Productos order by id_producto asc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listado = array();
        foreach ($resultado as $res){//$codProducto, $stock, $descripcion, $precioUnit, $idProveedor, $tipoProducto
            $producto = new Producto($res['id_producto'],$res['codproducto'],$res['stock'],$res['descripcion'],$res['precio_unit'],$res['id_proveedor'],$res['tipoProducto']);
            array_push($listado, $producto);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    
    public function insertarPedido($correo){
        $pdo = Database::connect();
        $sql = "insert into Pedidos(confirmacion,correo) values(?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array("N",$correo));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function getPedidoUsuario($correo){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Pedidos where correo=? and confirmacion=?" ;
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($correo,'N'));
        //Extraemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        if($res!=null){
        //Transformamos el registro obtenido a objeto:
        $pedido = new Pedido($res['id_pedido'],$res['fecha'],$res['confirmacion'],$res['correo']);
        }else{
            $pedido=null;
        }
        Database::disconnect();
        return $pedido;
    }

    
    public function getPedidos(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from Pedidos order by fecha desc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listado = array();
        foreach ($resultado as $res){
            $pedido = new Pedido($res['id_pedido'],$res['fecha'],$res['confirmacion'],$res['correo']);
            array_push($listado, $pedido);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    public function getPedido($idPedido){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Pedidos where id_pedido=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idPedido));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $pedido = new Pedido($dato['id_pedido'],$dato['fecha'],$dato['confirmacion'],$dato['correo']);
        Database::disconnect();
        return $pedido;
    }

    public function insertarDetalle($idPedido,$codProducto,$descripcion,$cantidad,$valorUnit){
        $pdo = Database::connect();
        $valorTotal=$valorUnit*$cantidad;
        $sql = "insert into Detalles(id_pedido,id_producto,descripcion,cantidad,valor_unit,valor_total) values(?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($idPedido,$codProducto,$descripcion,$cantidad,$valorUnit,$valorTotal));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function getDetalles($idPedido){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from Detalles where id_pedido=".$idPedido;
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listado = array();
        foreach ($resultado as $res){
            $detalle = new Detalle($res['id_detalles'],$res['id_pedido'],$res['id_producto'],$res['descripcion'],$res['cantidad'],$res['valor_unit'],$res['valor_total']);
            array_push($listado, $detalle);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    public function getDetalle($idDetalles){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Detalles where id_detalles=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idDetalles));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $detalle = new Detalle($dato['id_detalles'],$dato['id_pedido'],$dato['id_producto'],$dato['descripcion'],$dato['cantidad'],$dato['valor_unit'],$dato['valor_total']);
        Database::disconnect();
        return $detalle;
    }

    public function insertarFactura($nombre, $telefono, $direccion, $ruc, 
            $tipo_gasto,$idPedido, $correo){
        $pdo = Database::connect();
        $listado=$this->getDetalles($idPedido);
        $valor_base=0.0;
        foreach ($listado as $res){
            $valor_base+=$res->getValorTotal();
        }
        $iva=0.14*$valor_base;
        $descuento=0.0*$valor_base;
        $total=$valor_base+$iva-$descuento;
        //
        $sql = "insert into Facturas(nombre, telefono, direccion, ci_ruc, 
            tipo_gasto, valor_base, iva, descuento, total, 
            id_pedido, confirmacion, correo ) values(?,?,?,?,?,?,?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($nombre, $telefono, $direccion, $ruc,
            $tipo_gasto, $valor_base,$iva,$descuento,$total,$idPedido,"N",$correo));
            $this->actualizarPedido($idPedido, 'S');
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        
    }
    
    public function getFacturas(){
        $pdo = Database::connect();
        $sql = "select * from Facturas order by fecha_emision desc";
        $resultado = $pdo->query($sql);
        //
        $listado = array();
        foreach ($resultado as $res){
            $factura = new Factura($res['id_facturas'],$res['nombre'],$res['telefono'],$res['direccion'],$res['ci_ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion'],$res['correo']);
            array_push($listado, $factura);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    public function getFactura($idFacturas){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Facturas where id_facturas=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idFacturas));
        //Extraemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $factura = new Factura($res['id_facturas'],$res['nombre'],$res['telefono'],$res['direccion'],$res['ci_ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion'],$res['correo']);
        Database::disconnect();
        return $factura;
    }
    public function getFacturaporPedido($idPedido){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Facturas where id_pedido=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($idPedido));
        //Extraemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $factura = new Factura($res['id_facturas'],$res['nombre'],$res['telefono'],$res['direccion'],$res['ci_ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion'],$res['correo']);
        Database::disconnect();
        return $factura;
    }
    
    public function confirmarFactura($idFactura,$confirmacion){
        $pdo = Database::connect();
        $sql = "update Facturas set confirmacion=? where id_facturas=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($idFactura,$confirmacion));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function eliminarProveedor($idProveedor){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Proveedor where id_proveedor=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($idProveedor));
        Database::disconnect();
    }
    
    public function actualizarProveedor($codigoproveedor,$nombre ,$telefono, $email,$direccion,$idProveedor){
        $pdo = Database::connect();
        $sql = "update Proveedor set codproveedor=?, nombre=?,telefono=?,email=?, direccion=? where id_proveedor=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($codigoproveedor,$nombre ,$telefono, $email,$direccion,$idProveedor));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function eliminarProducto($codProducto){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Productos where id_producto=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codProducto));
        Database::disconnect();
    }
    
    public function actualizarProducto($codProducto,$stock,$descripcion,$precioUnit,$idProveedor,$tipoProducto,$idProducto){
        $pdo = Database::connect();
        $sql = "update Productos set codproducto=?, stock=?,descripcion=?,precio_unit=?,id_proveedor=?,tipoProducto=? where id_producto=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($codProducto,$stock,$descripcion,$precioUnit,$idProveedor,$tipoProducto,$idProducto));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
        public function eliminarPedido($idPedido){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Detalles where id_pedido=?; delete from Pedidos where id_pedido=?;";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($idPedido,$idPedido));
        Database::disconnect();
    }
    
    public function actualizarPedido($idPedido, $confirmacion){
        $pdo = Database::connect();
        $sql = "update Pedidos set confirmacion=? where id_pedido=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($confirmacion,$idPedido));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function eliminarDetalle($idDetalles){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Detalles where id_detalles=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($idDetalles));
        Database::disconnect();
    }
    
    public function actualizarDetalle($cantidad,$valorUnit,$idDetalles){
        $pdo = Database::connect();
        $valorTotal=$cantidad*$valorUnit;
        $sql = "update Detalles set cantidad=?,valor_unit=?,valor_total=? where id_detalles=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cantidad,$valorUnit,$valorTotal,$idDetalles));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function eliminarFactura($idFacturas){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Facturas where id_facturas=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($idFacturas));
        Database::disconnect();
    }
    
    
    public function actualizarUsuario($correo,$password){
        $pdo = Database::connect();
        $valorTotal=$cantidad*$valorUnit;
        $sql = "update Usuarios set correo=?, password=? where correo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($correo,$password));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function eliminarUsuario($correo){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from Usuarios where correo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($correo));
        Database::disconnect();
    }
    
    public function getSumaDetalles($listaDetalles){
        $total=0.0;
        foreach ($listaDetalles as $d) {
            $total+=$d->getValorTotal();
        }
        return $total;
    }
    
    
    
    
}
