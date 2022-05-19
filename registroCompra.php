<?php
    session_start();
    include_once 'php/conexion.php';

    $correo = $_POST['correo'];
    $pais = $_POST['pais'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $cp = $_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $telefono = $_POST['telefono'];
    $envio = $_POST['envio'];//id de envio para precio del pedido
    $idtransancion = $_POST['idtransancion'];
    $fecha = $_POST['fecha'];
    $status = $_POST['status'];
    $total = $_POST['total'];
$conexion =connect();
$errorInsertDireccion=false;
$idUltimoInsert = array("iddireccion"=>0,"idtipopago"=>0,"idpedido"=>0);
$sql="insert into direccion(nombre,apellidos,pais,callenum,colonia,cp,ciudad,estado,telefono) values(:nombre,:apellidos,:pais,:callenum,:colonia,:cp,:ciudad,:estado,:telefono)";
  $sql= $conexion->prepare($sql);
  $sql->bindParam(':nombre',$nombre);
  $sql->bindParam(':apellidos',$apellidos);
  $sql->bindParam(':pais',$pais);
  $sql->bindParam(':callenum',$calle);
  $sql->bindParam(':colonia',$colonia);
  $sql->bindParam(':cp',$cp);
  $sql->bindParam(':ciudad',$ciudad);
  $sql->bindParam(':estado',$estado);
  $sql->bindParam(':telefono',$telefono);


 if( $sql->execute()){
    $errorInsertDireccion= true;
    $idUltimoInsert["iddireccion"] = $conexion->lastInsertId();//obtenemos el ultimo id del insert que se hizo en la base de datos;
 }else{
    $errorInsertDireccion=  false;
   $idUltimoInsert["iddireccion"] = 0;
 }

 /*sql="insert into direccion(nombre,apellidos,pais,callenum,colonia,cp,ciudad,estado,telefono) values(:nombre,:apellidos,:pais,:callenum,:colonia,:cp,:ciudad,:estado,:telefono)";
  $sql= connect()->prepare($sql);
  $sql->bindParam(':nombre',$nombre);
  $sql->bindParam(':apellidos',$apellidos);
  $sql->bindParam(':pais',$pais);
  $sql->bindParam(':callenum',$calle);
  $sql->bindParam(':colonia',$colonia);
  $sql->bindParam(':cp',$cp);
  $sql->bindParam(':ciudad',$ciudad);
  $sql->bindParam(':estado',$estado);
  $sql->bindParam(':telefono',$telefono);


 if( $sql->execute()){
    $errorInsertDireccion= true;
    $idUltimoInsert["iddireccion"] = connect()->lastInsertId();//obtenemos el ultimo id del insert que se hizo en la base de datos;
 }else{
    $errorInsertDireccion=  false;
   $idUltimoInsert["iddireccion"] = 0;
 }

  */

  $conexion =connect();
 $errorInserttipoPago=false;
 $sql="insert into tipopago(idtransancion,cantidad,fecha,estatus) 
                     values(:idtransancion,:cantidad,:fecha,:estatus)";
   $sql= $conexion->prepare($sql);
   $sql->bindParam(':idtransancion',$idtransancion);
   $sql->bindParam(':cantidad',$total);
   $sql->bindParam(':fecha',$fecha);
   $sql->bindParam(':estatus',$status);
  if( $sql->execute()){
     $errorInserttipoPago= true;
     $idUltimoInsert["idtipopago"] =$conexion->lastInsertId();//obtenemos el ultimo id del insert que se hizo en la base de datos;
  }else{
     $errorInserttipoPago=  false;
     $idUltimoInsert["idtipopago"] = 0;
  }
  $conexion =connect();
  $errorInsertpedido=false;
  $fechapedido = date('Y-m-d H:i:s');
 $sql="insert into pedido(iddireccion,idmetodoenvio,idtipoPago,total,fecha,estatusVenta) 
                     values(:iddireccion,:idmetodoenvio,:idtipopago,:total,:fecha,:estatusVenta)";
  $sql= $conexion->prepare($sql);
   $sql->bindValue(':iddireccion',$idUltimoInsert["iddireccion"]);//nota si usamos un arreglo para pasar informacion en una setencia preparada tenemos que usar bindValue para que funcione el dato
   $sql->bindParam(':idmetodoenvio',$envio);
   $sql->bindValue(':idtipopago',$idUltimoInsert["idtipopago"]);
   $sql->bindValue(':total',$total);
   $sql->bindValue(':fecha',$fechapedido);
   $sql->bindValue(':estatusVenta','Preparando para envio');
  if( $sql->execute()){
     $errorInsertpedido= true;
     $idUltimoInsert["idpedido"] = $conexion->lastInsertId();//obtenemos el ultimo id del insert que se hizo en la base de datos;
  }else{
     $errorInsertpedido=  false;
     $idUltimoInsert["idpedido"] = 0;
  }

  $errorInsertdetalleproductos=false;
  
  foreach ($_SESSION['carrito'] as $result ) {
    $subtotal= $result["precio"]*$result["cantidad"]; 
    $sql="insert into detalle_producto(idpedido,idproducto,cantidad,precio,subtotal,nombre) 
    values(:idpedido,:idproducto,:cantidad,:precio,:subtotal,:nombre)";
    $sql= connect()->prepare($sql);
    $sql->bindValue(':idpedido',$idUltimoInsert["idpedido"]);
    $sql->bindValue(':idproducto',$result["id"]);
    $sql->bindValue(':cantidad',$result["cantidad"]);
    $sql->bindValue(':precio',$result["precio"]);
    $sql->bindValue(':subtotal',$subtotal);
    $sql->bindValue(':nombre',$result["nombre"]);
    if( $sql->execute()){
        $errorInserttipoPago= true;
    }else{
        $errorInserttipoPago=  false;
    }

    $sql="update producto set cantidad=cantidad-:cantidad where id=:id";
    $sql= connect()->prepare($sql);
    $sql->bindValue(':id',$result["id"]);
    $sql->bindValue(':cantidad',$result["cantidad"]);
    if( $sql->execute()){
        $errorInserttipoPago= true;
    }else{
        $errorInserttipoPago=  false;
    }

}
  
unset($_SESSION['carrito']);

    $response = array("correo" => $correo, "pais" => $pais,"nombre"=> $nombre,
                        "calle" => $calle, "colonia" => $colonia,"cp"=> $cp,
                        "ciudad" => $ciudad, "estado" => $estado,"telefono"=> $telefono,
                        "envio" => $envio, "idtransancion" => $idtransancion,"fecha"=> $fecha,
                        "status" => $status, "total" => $total,
                        "apellidos"=>$fechapedido,"iddireccion"=>$idUltimoInsert["iddireccion"],"idpago"=>$idUltimoInsert["idtipopago"],"idpedido"=>$idUltimoInsert["idpedido"]);
    
    echo  json_encode($response);



?>