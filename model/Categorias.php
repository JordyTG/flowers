<?php
/**
 * Description of Categorias
 *
 * @author Steven
 */
class Categorias {
    private $id_cat, $nombreCat;
    function __construct($id_cat, $nombreCat) {
        $this->id_cat = $id_cat;
        $this->nombreCat = $nombreCat;
    }
    
    function getId_cat() {
        return $this->id_cat;
    }

    function getNombreCat() {
        return $this->nombreCat;
    }

    function setId_cat($id_cat) {
        $this->id_cat = $id_cat;
    }

    function setNombreCat($nombreCat) {
        $this->nombreCat = $nombreCat;
    }



}
