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
$idProduct=$_POST['idproduct'];
$idfotoSinEditar=$_POST['idfotoSinEditar'];
/*
$nombre ="nuevo editado";
$descripcion="no lo se";
$anio =2000;
$stock=1000;
$precio =12000;
$categoria =1;
$estado =1;
$marca =1;
$idProduct=11;
$idfotoSinEditar=13;*/

$response = array("nombre" => $nombre, "descripcion" => $descripcion,"anio"=> $anio,"stock" => $stock, "precio" => $precio,"categoria"=> $categoria,"estado" => $estado, "marca" => $marca,"resultado"=>"ok");
if($_FILES['foto']['name'] != null){//verificamos que files tiene archivos y si no tiene que se haga lo de else
    if($_FILES['foto']['error'] == 0){//verificamos que si se envio completo la foto y no existe un error
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "galeria/".$_FILES['foto']['name'])){//movemos la imagen a la ruta galeria con su nombre de extension si resulta el movimiento entra en el if
            $idFoto;                         //aqui guardamos el nombre de la foto del producto y el producto en la base de datos
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
            $sql="update producto set idcategoria=:idcategoria, idestadoproducto=:idestadoproducto,idmarca=:idmarca,idfoto=:idfoto,nombre=:nombre,descripcion=:descripcion,anio=:anio, cantidad=:cantidad,precio=:precio where id=:id";
            $sql= $conexion->prepare($sql);
            $sql->bindValue(':idcategoria',$categoria);
            $sql->bindValue(':idestadoproducto',$estado);
            $sql->bindValue(':cantidad',$stock);
            $sql->bindValue(':idmarca',$marca);
            $sql->bindValue(':idfoto',$idFoto);
            $sql->bindValue(':nombre',$nombre);
            $sql->bindValue(':descripcion',$descripcion);
            $sql->bindValue(':anio',$anio);
            $sql->bindValue(':precio',$precio);
            $sql->bindValue(':id',$idProduct);
            if( $sql->execute()){
                $errorInsertproductos= true;
            }else{
                $errorInsertproductos=  false;
            }
    
    
            $errorInsertproductosfoto=false;
            $sql="insert into galeria(idproducto,idfoto) 
            values(:idproducto,:idfoto)";
            $sql= $conexion->prepare($sql);
            $sql->bindValue(':idproducto',$idProduct);
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

}else{
     $errorInsertproductos=false;
    $sql="update producto set idcategoria=:idcategoria, idestadoproducto=:idestadoproducto,idmarca=:idmarca,idfoto=:idfoto,nombre=:nombre,descripcion=:descripcion,anio=:anio, cantidad=:cantidad,precio=:precio where id=:id";
    $sql= $conexion->prepare($sql);
    $sql->bindValue(':idcategoria',$categoria);
    $sql->bindValue(':idestadoproducto',$estado);
    $sql->bindValue(':cantidad',$stock);
    $sql->bindValue(':idmarca',$marca);
    $sql->bindValue(':idfoto',$idfotoSinEditar);
    $sql->bindValue(':nombre',$nombre);
    $sql->bindValue(':descripcion',$descripcion);
    $sql->bindValue(':anio',$anio);
    $sql->bindValue(':precio',$precio);
    $sql->bindValue(':id',$idProduct);
    if( $sql->execute()){
        $errorInsertproductos= true;
        echo   json_encode($response);
    }else{
        $errorInsertproductos=  false;
        echo '{"resultado":"false"}'; 
    }
    
}

?>