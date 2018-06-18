<?php

/**
 * Description of Producto
 *
 * @author Jordy
 */
class Producto {
    private $id_producto,$codproducto, $stock, $descripcion, $preciounit, $id_proveedor, $tipoProducto;
    function __construct($id_producto, $codproducto, $stock, $descripcion, $preciounit, $id_proveedor, $tipoProducto) {
        $this->id_producto = $id_producto;
        $this->codproducto = $codproducto;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
        $this->preciounit = $preciounit;
        $this->id_proveedor = $id_proveedor;
        $this->tipoProducto = $tipoProducto;
    }
    
    function getTipoProducto() {
        return $this->tipoProducto;
    }

        function getId_producto() {
        return $this->id_producto;
    }

    function getCodproducto() {
        return $this->codproducto;
    }

    function getStock() {
        return $this->stock;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPreciounit() {
        return $this->preciounit;
    }

    function getId_proveedor() {
        return $this->id_proveedor;
    }


}
