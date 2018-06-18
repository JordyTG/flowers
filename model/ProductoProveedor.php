<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoProveedor
 *
 * @author Jordy
 */
class ProductoProveedor {
    private $idProducto, $stock, $descripcion, $precioUnit, $idProveedor, $nombre, $telefono, $correo;
    function __construct($idProducto, $stock, $descripcion, $precioUnit, $idProveedor, $nombre, $telefono, $correo) {
        $this->idProducto = $idProducto;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
        $this->precioUnit = $precioUnit;
        $this->idProveedor = $idProveedor;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getStock() {
        return $this->stock;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecioUnit() {
        return $this->precioUnit;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }


    
}
