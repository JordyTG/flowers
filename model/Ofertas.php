<?php

/**
 * Description of Ofertas
 *
 * @author Steven
 */
class Ofertas {
    private $id_oferta, $cod_oferta, $precio, $descripcion, $categoria;
    
    function __construct($id_oferta, $cod_oferta, $precio, $descripcion, $categoria) {
        $this->id_oferta = $id_oferta;
        $this->cod_oferta = $cod_oferta;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
    }
    
    function getId_oferta() {
        return $this->id_oferta;
    }

    function getCod_oferta() {
        return $this->cod_oferta;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setId_oferta($id_oferta) {
        $this->id_oferta = $id_oferta;
    }

    function setCod_oferta($cod_oferta) {
        $this->cod_oferta = $cod_oferta;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
}
