<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Detalle
 *
 * @author Jordy
 */
class Detalle {
    private $idDetalles,$idPedido,$codProducto,$descripcion,$cantidad,$valorUnit,$valorTotal;
    function __construct($idDetalles, $idPedido, $codProducto, $descripcion, $cantidad, $valorUnit, $valorTotal) {
        $this->idDetalles = $idDetalles;
        $this->idPedido = $idPedido;
        $this->codProducto = $codProducto;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->valorUnit = $valorUnit;
        $this->valorTotal = $valorTotal;
    }

    function getIdDetalles() {
        return $this->idDetalles;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getCodProducto() {
        return $this->codProducto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getValorUnit() {
        return $this->valorUnit;
    }

    function getValorTotal() {
        return $this->valorTotal;
    }


    
}
