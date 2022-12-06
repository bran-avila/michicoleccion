<?php

include_once 'php/conexion.php';

$nombre ="brandon";
$descripcion="dsgsddsgdsg";
$anio ="2000";
$stock="10";
$precio ="1200";
$categoria ="1";
$estado ="1";
$marca ="1";
$idFoto="2";
$errorInsertproductos=false;
$sql="insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio) 
values(:categoria,:estado,:marca,:idFoto,:nombre,:descripcion,:anio,:stock,:precio)";
$sql= connect()->prepare($sql);
$sql->bindValue(':categoria',$categoria);
$sql->bindValue(':estado',$estado);
$sql->bindValue(':stock',$stock);
$sql->bindValue(':marca',$marca);
$sql->bindValue(':idFoto',$idFoto);
$sql->bindValue(':nombre',$nombre);
$sql->bindValue(':descripcion',$descripcion);
$sql->bindValue(':anio',$anio);
$sql->bindValue(':precio',$precio);
if( $sql->execute()){
    $errorInsertproductos= true;
}else{
    $errorInsertproductos=  false;
}



?>