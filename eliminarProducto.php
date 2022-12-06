<?php

include_once 'php/conexion.php';
$conexion =connect();
$idProducto =$_POST['idproduct'];
//$idProducto =14;
        $errorInsertproductosfoto=false;
        $sql="update producto set disponible=0 where id=:id";
        $sql= $conexion->prepare($sql);
        $sql->bindValue(':id',$idProducto);
        if( $sql->execute()){
            $errorInsertproductosfoto= true;
            echo '{"resultado":"ok"}';
        }else{
            $errorInsertproductosfoto=  false;
            echo '{"resultado":"false"}';
        }

?>