<?php

/**
 * Description of Usuario
 *
 * @author Jordy
 */
class Usuario {
    private $id_usuario, $email,$password, $nombre,$apellido,$direccion, $telefono;
    function __construct($id_usuario, $email, $password, $nombre, $apellido, $direccion, $telefono) {
        $this->id_usuario = $id_usuario;
        $this->email = $email;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getEmail() {
        return $this->email;
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

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }    
}
