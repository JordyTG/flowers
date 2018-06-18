<?php

class Proveedor {
    private  $id_proveedor,$codproveedor,$nombre,$telefono,$email,$direccion;
    function __construct($id_proveedor, $codproveedor, $nombre, $telefono, $email, $direccion) {
        $this->id_proveedor = $id_proveedor;
        $this->codproveedor = $codproveedor;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
    }
    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getCodproveedor() {
        return $this->codproveedor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getDireccion() {
        return $this->direccion;
    }



}
