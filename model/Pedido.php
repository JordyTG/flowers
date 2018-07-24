<?php
/**
 * Description of Pedido
 * @author Jordy
 */
class Pedido {
    private $idPedido,$fecha,$confirmacion,$id_usuario;
    
    function __construct($idPedido,$fecha, $confirmacion,$id_usuario) {
        $this->idPedido = $idPedido;
        $this->fecha = $fecha;
        $this->confirmacion = $confirmacion;
        $this->id_usuario = $id_usuario;
    }
    function getIdPedido() {
        return $this->idPedido;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getConfirmacion() {
        return $this->confirmacion;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }


}
