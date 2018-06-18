<?php
/**
 * Description of Pedido
 * @author Jordy
 */
class Pedido {
    private $idPedido,$fecha,$confirmacion,$correo;
    
    function __construct($idPedido,$fecha, $confirmacion,$correo) {
        $this->idPedido = $idPedido;
        $this->fecha = $fecha;
        $this->confirmacion = $confirmacion;
        $this->correo = $correo;
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

    function getCorreo() {
        return $this->correo;
    }


}
