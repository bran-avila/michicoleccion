<?php

include_once 'php/conexion.php';
$conexion =connect();
$nombre =$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$anio =$_POST['anio'];
$stock=$_POST['stock'];
$precio =$_POST['precio'];
$categoria =$_POST['categoria'];
$estado =$_POST['Estado'];
$marca =$_POST['Marca'];

$response = array("nombre" => $nombre, "descripcion" => $descripcion,"anio"=> $anio,"stock" => $stock, "precio" => $precio,"categoria"=> $categoria,"estado" => $estado, "marca" => $marca,"resultado"=>"ok");
if($_FILES['foto']['error'] == 0){
    if(move_uploaded_file($_FILES['foto']['tmp_name'], "galeria/".$_FILES['foto']['name'])){
        $idFoto;
        $errorInsertfoto=false;
        $sql="insert into foto(nombre) 
        values(:nombre)";
        $sql= $conexion->prepare($sql);
        $sql->bindValue(':nombre',$_FILES['foto']['name']);
        if( $sql->execute()){
            $errorInsertfoto= true;
            $idFoto = $conexion->lastInsertId();
        }else{
            $errorInsertfoto=  false;
        }


        $errorInsertproductos=false;
        $idProducto=0;
        $sql="insert into producto(idcategoria,idestadoproducto,idmarca,idfoto,nombre,descripcion,anio,cantidad,precio,disponible) 
        values(:categoria,:estado,:marca,:idFoto,:nombre,:descripcion,:anio,:stock,:precio,true)";
        $sql= $conexion->prepare($sql);
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
            $idProducto=$conexion->lastInsertId();
        }else{
            $errorInsertproductos=  false;
        }


        $errorInsertproductosfoto=false;
        $sql="insert into galeria(idproducto,idfoto) 
        values(:idproducto,:idfoto)";
        $sql= $conexion->prepare($sql);
        $sql->bindValue(':idproducto',$idProducto);
        $sql->bindValue(':idfoto',$idFoto);
        if( $sql->execute()){
            $errorInsertproductosfoto= true;
        }else{
            $errorInsertproductosfoto=  false;
        }



        echo   json_encode($response);
    }else{
        echo '{"resultado":"false"}';    
    }


}else{
    echo '{"resultado":"error"}';

}
?>