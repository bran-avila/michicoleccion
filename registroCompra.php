<?php
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
    $envio = $_POST['envio'];
    $idtransancion = $_POST['idtransancion'];
    $fecha = $_POST['fecha'];
    $status = $_POST['status'];
    $total = $_POST['total'];

    $response = array("correo" => $correo, "pais" => $pais,"nombre"=> $nombre,
                        "calle" => $calle, "colonia" => $colonia,"cp"=> $cp,
                        "ciudad" => $ciudad, "estado" => $estado,"telefono"=> $telefono,
                        "envio" => $envio, "idtransancion" => $idtransancion,"fecha"=> $fecha,
                        "status" => $status, "total" => $total,
                        "apellidos"=>$apellidos);
    
    echo  json_encode($response);



?>