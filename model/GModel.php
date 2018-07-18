<?php

include_once 'Database.php';
include_once 'Proveedor.php';
include_once 'Factura.php';
include_once 'Producto.php';
include_once 'Detalle.php';
include_once 'Categorias.php';
include_once 'Ofertas.php';
include_once 'Pedido.php';
include_once 'Usuario.php';
include_once 'Administrador.php';
include_once 'ProductoProveedor.php';

class GModel {
    
    public function getContenidoFactura($factura,$user){
        try{
        $detalles=$this->getDetalles($factura->getId_pedido());
        
        
        $contenido="<table border=\"1\">
                <thead>
                    <tr>
                        <th colspan=\"2\">Factura: ".$factura->getNum_facturas()."</th>
                        <th colspan=\"3\">Fecha: ".$factura->getFecha_emision()."</th>
                    </tr>
                    <tr>
                        <td colspan=\"5\"> </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan=\"2\">Nombre: ".$factura->getNombre()."</td>
                        <td colspan=\"3\">Direccion: ".$factura->getDireccion()."</td>
                    </tr>
                    <tr>
                        <td>Teléfono: ".$factura->getTelefono()."</td>
                        <td colspan=\"2\">CI/RUC: ".$factura->getRuc()."</td>
                        <td colspan=\"2\">Correo: ".$user->getEmail()."</td>
                    </tr>
                    <tr>
                        <td colspan=\"5\"> </td>
                    </tr>
                    <tr>
                        <th colspan=\"5\" align=\"center\">DETALLES</th>
                    </tr>
                    <tr>
                        <th>CodProducto</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>ValorUnit</th>
                        <th>ValorTotal</th>
                    </tr>";
        foreach ($detalles as $detalle) {
                    $contenido=$contenido."<tr>
                        <td>".$detalle->getCodProducto()."</td>
                        <td>".$detalle->getDescripcion()."</td>
                        <td>".$detalle->getCantidad()."</td>
                        <td>".$detalle->getValorUnit()."</td>
                        <td>".$detalle->getValorTotal()."</td>
                    </tr>";
        }
        $contenido=$contenido."<tr>
                        <th colspan=\"4\">SUBTOTAL: </th>
                        <td>".$factura->getValor_base()."</td>
                    </tr>
                    <tr>
                        <th colspan=\"4\">IVA: </th>
                        <td>".$factura->getIva()."</td>
                    </tr>
                    <tr>
                        <th colspan=\"4\">VALOR TOTAL: </th>
                        <td>".$factura->getTotal()."</td>
                    </tr>
                </tbody>
            </table>";
        }catch (PDOException $e){
            return $e->getMessage();
        }
        return $contenido;
    }
    
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
    
    
    public function insertarPedido($idUsuario){
        $pdo = Database::connect();
        $sql = "insert into Pedidos(confirmacion,id_usuario) values(?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array("N",$idUsuario));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function getPedidoUsuario($id_usuario){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from Pedidos where id_usuario=? and confirmacion=?" ;
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($id_usuario,'N'));
        //Extraemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        if($res!=null){
        //Transformamos el registro obtenido a objeto:
        $pedido = new Pedido($res['id_pedido'],$res['fecha'],$res['confirmacion'],$res['id_usuario']);
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

    public function insertarDetalle($idPedido,$idProducto,$descripcion,$cantidad,$valorUnit){
        $pdo = Database::connect();
        $valorTotal=$valorUnit*$cantidad;
        $sql = "insert into Detalles(id_pedido,id_producto,descripcion,cantidad,valor_unit,valor_total) values(?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($idPedido,$idProducto,$descripcion,$cantidad,$valorUnit,$valorTotal));
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
            $tipo_gasto,$idPedido){
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
        $numFact=0;
        $sql = "select id_facturas from Facturas";
        $resultado = $pdo->query($sql);
        foreach ($resultado as $res){
            $numFact+=1;
        }
        $numFact+=1;
        $sql = "insert into Facturas(nombre, cedula, telefono, direccion, num_facturas, 
            ruc, tipo_gasto, valor_base, iva, descuento, total, 
            id_pedido, confirmacion) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($nombre, $ruc,$telefono, $direccion,$numFact, $ruc,
            $tipo_gasto, $valor_base,$iva,$descuento,$total,$idPedido,"N"));
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
            //$id_facturas, $nombre, $cedula, $telefono, $direccion, $num_facturas, 
            //$ruc, $fecha_emision,$tipo_gasto, $valor_base, $iva, $descuento, $total, 
            //$id_pedido, $confirmacion;
            $factura = new Factura($res['id_facturas'],$res['nombre'],$res['cedula'],$res['telefono'],$res['direccion'],$res['num_facturas'],$res['ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion']);
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
        $factura = new Factura($res['id_facturas'],$res['nombre'],$res['cedula'],$res['telefono'],$res['direccion'],$res['num_facturas'],$res['ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion']);
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
        $factura = new Factura($res['id_facturas'],$res['nombre'],$res['cedula'],$res['telefono'],$res['direccion'],$res['num_facturas'],$res['ruc'],$res['fecha_emision'],$res['tipo_gasto'],$res['valor_base'],$res['iva'],$res['descuento'],$res['total'],$res['id_pedido'],$res['confirmacion']);
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
    
    
    //****************************// CATALOGO
    

    
    public function getCategorias(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from categoria order by id_cat";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Proveedor:
        $listado = array();
        foreach ($resultado as $res){//$codproveedor, $nombre, $telefono, $email, $direccion
            $categoria = new Categorias($res['id_cat'],$res['nombreCat']);                    
            array_push($listado, $categoria);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
     public function eliminarCategoria($id_cat){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from categoria where id_cat=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($id_cat));
        Database::disconnect();
    }
    
    public function actualizarCategoria($nombreCat,$id_cat){
        $pdo = Database::connect();
        $sql = "update categoria set nombreCat=? where id_cat=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombreCat,$id_cat));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function insertarCategorias($nombreCat){
        $pdo = Database::connect();
        $sql = "insert into categoria(nombreCat) values(?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($nombreCat));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }


    public function getCategoria($id_cat){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from categoria where id_cat=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($id_cat));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $categoria = new Categorias($dato['id_cat'],$dato['nombreCat']);
        Database::disconnect();
        return $categoria;
    }
    
    //************************************** OFERTAS ****************//
    
    public function getOfertas(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from ofertas order by id_oferta";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Proveedor:
        $listado = array();
        foreach ($resultado as $res){//$codproveedor, $nombre, $telefono, $email, $direccion
            $oferta = new Ofertas($res['id_oferta'],$res['cod_oferta'],$res['precio'],$res['descripcion'],$res['categoria']);                    
            array_push($listado, $oferta);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    public function getOfertasProd(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from Productos where tipoProducto='Oferta'";
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
    
    public function getOfertaProd($idProducto){
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
    
     public function eliminarOferta($id_oferta){
        //Preparamos la conexion a la bdd:
        $pdo=Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from ofertas where id_oferta=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($id_oferta));
        Database::disconnect();
    }
    
    public function actualizarOferta($cod_oferta, $precio, $descripcion, $categoria, $id_oferta){
        $pdo = Database::connect();
        $sql = "update ofertas set cod_oferta=?, precio=?, descripcion=?, categoria=? where id_oferta=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_oferta, $precio, $descripcion, $categoria, $id_oferta));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }
    
    public function insertarOferta($cod_oferta, $precio, $descripcion, $categoria){
        $pdo = Database::connect();
        $sql = "insert into ofertas(cod_oferta, precio, descripcion, categoria) values(?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($cod_oferta, $precio, $descripcion, $categoria));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }


    public function getOferta($id_oferta){
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from ofertas where id_oferta=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($id_oferta));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $oferta = new Ofertas($dato['id_oferta'],$dato['cod_oferta'],$dato['precio'],$dato['descripcion'],$dato['categoria']);
        Database::disconnect();
        return $oferta;
    }
    
    
    
    
    
}
