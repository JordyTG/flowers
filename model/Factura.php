<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factura
 * `id_facturas`, `nombre`, `telefono`, `direccion`, `ci_ruc`, `fecha_emision`, `tipo_gasto`, 
 * `valor_base`, `iva`, `descuento`, `total`, `id_pedido`, `confirmacion
 * @author Jordy
 */
class Factura {
    private $id_facturas, $nombre, $cedula, $telefono, $direccion, $num_facturas, 
            $ruc, $fecha_emision,$tipo_gasto, $valor_base, $iva, $descuento, $total, 
            $id_pedido, $confirmacion;
    
    function __construct($id_facturas, $nombre, $cedula, $telefono, $direccion, $num_facturas, $ruc, $fecha_emision, $tipo_gasto, $valor_base, $iva, $descuento, $total, $id_pedido, $confirmacion) {
        $this->id_facturas = $id_facturas;
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->num_facturas = $num_facturas;
        $this->ruc = $ruc;
        $this->fecha_emision = $fecha_emision;
        $this->tipo_gasto = $tipo_gasto;
        $this->valor_base = $valor_base;
        $this->iva = $iva;
        $this->descuento = $descuento;
        $this->total = $total;
        $this->id_pedido = $id_pedido;
        $this->confirmacion = $confirmacion;
        
    }

    function getId_facturas() {
        return $this->id_facturas;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getNum_facturas() {
        return $this->num_facturas;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getFecha_emision() {
        return $this->fecha_emision;
    }

    function getTipo_gasto() {
        return $this->tipo_gasto;
    }

    function getValor_base() {
        return $this->valor_base;
    }

    function getIva() {
        return $this->iva;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getTotal() {
        return $this->total;
    }

    function getId_pedido() {
        return $this->id_pedido;
    }

    function getConfirmacion() {
        return $this->confirmacion;
    }




}
