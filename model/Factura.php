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
    private $idFacturas,$nombre,$telefono, $direccion, $ci_ruc,
            $fecha_emision, $tipo_gasto, $valor_base, $iva, $descuento, $total,
            $idPedido,$confirmacion, $correo;
    
    function __construct($idFacturas, $nombre, $telefono, $direccion, $ci_ruc, $fecha_emision, $tipo_gasto, $valor_base, $iva, $descuento, $total, $idPedido, $confirmacion, $correo) {
        $this->correo = $correo;
        $this->idFacturas = $idFacturas;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->ci_ruc = $ci_ruc;
        $this->fecha_emision = $fecha_emision;
        $this->tipo_gasto = $tipo_gasto;
        $this->valor_base = $valor_base;
        $this->iva = $iva;
        $this->descuento = $descuento;
        $this->total = $total;
        $this->idPedido = $idPedido;
        $this->confirmacion = $confirmacion;
    }
    function getCorreo() {
        return $this->correo;
    }

        function getIdFacturas() {
        return $this->idFacturas;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCi_ruc() {
        return $this->ci_ruc;
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

    function getIdPedido() {
        return $this->idPedido;
    }

    function getConfirmacion() {
        return $this->confirmacion;
    }



}
