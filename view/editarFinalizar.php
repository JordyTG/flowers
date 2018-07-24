<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body>
        <?php
        include_once '../model/GModel.php';
        include_once '../model/Detalle.php';
        session_start();
        $listadod = $_SESSION['listadod'];
        ?>
        <form action="../controller/controller.php">
            <input type="hidden" value="actualizar" name="opcion">
            <input type="hidden" value="<?php echo $listadod->getIdDetalles(); ?>" name="idDetalles">
            Id Pedido:<b><?php echo $listadod->getIdPedido();?></b><br>
            Id Producto:<b><?php echo $listadod->getId_producto();?></b><br>
            Descripcion :<input type="text" name="descripcion" value="<?php echo $listadod->getDescripcion();?>"> <br>
            Cantidad :<input type="text" name="cantidad" value="<?php echo $listadod->getCantidad();?>"><br>                       
            Valor Unit:<b><?php echo $listadod->getValor_unit();?></b><br>
            <br>
            <br>
            <input type="submit" value="Editar Integrante">                                                
        </form>
        
    </body>
</html>
