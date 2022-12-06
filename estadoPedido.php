<?php

include_once 'php/conexion.php';
$conexion =connect();
$estadopedido =$_POST['estadopedido'];
$id =$_POST['id'];


$sql="update pedido set estatusVenta=:estadopedido where id=:id;";
$sql= $conexion->prepare($sql);
$sql->bindValue(':estadopedido',$estadopedido);
$sql->bindValue(':id',$id);
if( $sql->execute()){
    echo '{"resultado":"ok"}'; 
}else{
    echo '{"resultado":"false"}'; 
}


?>