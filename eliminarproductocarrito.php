<?php
session_start();
try{
    $idproducto = "c".$_POST['id'];
    $cantidadProductos = false;
    $precioTotal = $_SESSION['carrito'][$idproducto]['precio']*$_SESSION['carrito'][$idproducto]['cantidad'];
    $cantidadProductoscarrito =$_SESSION['carrito'][$idproducto]['cantidad'];

    unset($_SESSION['carrito'][$idproducto]);
    
    if(count($_SESSION['carrito'])==0 ){

        $cantidadProductos = true;
    }
    
    
    $response = array("idConfirmacion" => $idproducto, "productoNoDisponible" => $cantidadProductos,"total"=> $precioTotal,"cantidadproductos"=>$cantidadProductoscarrito);
    
    echo  json_encode($response);



}catch(Exception $error){
    echo 'error';
}


?>