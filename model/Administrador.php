<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author Jordy
 */
class Administrador {
    private $idAdministrador, $usuario, $password,$nombre,$apellido,$direccion, $telefono,$email;
    function __construct($idAdministrador, $usuario, $password, $nombre, $apellido, $direccion, $telefono, $email) {
        $this->idAdministrador = $idAdministrador;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
    }
    
    function getIdAdministrador() {
        return $this->idAdministrador;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }


}
