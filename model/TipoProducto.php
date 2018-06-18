<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProducto
 *
 * @author JordyTG
 */
class TipoProducto {
    private $idTipoProducto, $tipoProducto;
    function __construct($idTipoProducto, $tipoProducto) {
        $this->idTipoProducto = $idTipoProducto;
        $this->tipoProducto = $tipoProducto;
    }

    function getIdTipoProducto() {
        return $this->idTipoProducto;
    }

    function getTipoProducto() {
        return $this->tipoProducto;
    }


}
