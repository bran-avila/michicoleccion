<?php
session_start();
include_once 'php/conexion.php';
$result=null;
$titulo = "pedido";
if(!isset($_SESSION['user'])){
  
  header('Location:login.php');
  
  
}else if(isset($_SESSION['idpedido'])){

  $idpedido=$_SESSION['idpedido'];
  $titulo = "Pago exitoso gracias :3";
}else if($_GET["id"]){
  $idpedido=$_GET["id"];

}else{
  header('Location:cuenta.php');
}

$sql="select pe.correo as correo,dic.nombre as nombre,dic.apellidos as apellidos,dic.pais as pais,dic.callenum as calle,dic.colonia as colonia,dic.cp as cp,dic.ciudad as ciudad,dic.estado as estado,dic.telefono as telefono,pe.estatusVenta as estatus,pe.total as cantidad,me.tipoenvio as envio from pedido pe,direccion dic,metodoenvio me,tipopago tp where pe.iddireccion = dic.id and pe.idmetodoenvio = me.id and pe.idtipoPago = tp.id and pe.id = :id;";
$sth =connect()->prepare($sql);
$sth->bindValue(':id',$idpedido);
if( $sth->execute()){
   $result = $sth->fetch(PDO::FETCH_OBJ);
}

?>



<!DOCTYPE html>
<!-- Created By CodingNepal url:https://www.codingnepalweb.com/multi-step-form-html-css-javascript/-->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Compra exitosa</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/carrito.css">
    <link rel="stylesheet" href="assets/css/compraexitosa.css">
    <link rel="stylesheet" href="assets/css/animaciones.css">
   </head>
   <body>
   <?php
        include 'componentes/header.php'
    ?>   
   <div class="containerPagoExitoso">
       <div class="containerTextoGracias">
           <h1 class="focus-in-expand-fwd textTitulo"><?php echo $titulo?></h1>
       </div>
         <div class="container tamañolist">
         <ul class="list-group bounce-in-bottom">
     
        <!-- list group item -->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Tu pedido está confirmado</h5>
                     <p>Para checar el estado de envio de tu pedido o mas informacion sobre la compra realizada lo podras verificar en tu perfil de usuario.</p>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>

        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Informacion del cliente</h5>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Informacion contacto:</h5>
                     <p><?php echo $result->correo ?>.</p>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Direccion de envio:</h5>
                     <div class="row">
                         <div class="col-10">
                             <p><?php echo $result->nombre.' '.$result->apellidos ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->pais ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->estado ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->ciudad ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->colonia ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->calle ?></p>
                         </div>
                         <div class="col-10">
                             <p><?php echo $result->telefono ?></p>
                         </div>
                     </div>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">cantidad de pago:</h5>
                     <p><?php echo $result->cantidad ?>.</p>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Metodos de envio:</h5>
                     <p><?php echo $result->envio ?>.</p>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="500">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">
                     <h5 class="mt-0 font-weight-bold mb-2">Estatus del pedido:</h5>
                     <p><?php echo $result->estatus ?>.</p>
                  </div>
                  <div class="col-1">
                  </div>
              </div>
               </div>
            </div>
          </li>
          <!-- li de productos -->
        <?php
        
          $sql = "select f.nombre as foto,dp.nombre as nombre,dp.cantidad as cantidad,dp.precio as precio,dp.subtotal as total  from detalle_producto dp, producto p, foto f where dp.idproducto = p.id and p.idfoto = f.id and dp.idpedido = :id; "; 
          $query = connect() -> prepare($sql); 
          $query->bindValue(':id',$idpedido);
          $query -> execute(); 
          $results = $query -> fetchAll(PDO::FETCH_OBJ); 
          if($query -> rowCount() > 0)   { 
            foreach($results as $result) { 
            
        ?>

          <!-- list group item-->
          <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2"><?php echo $result->nombre ?></h5>
              <p class="font-italic text-muted mb-0 small">Cantidad: <?php echo$result->cantidad ?> </p>
              <p class="font-italic text-muted mb-0 small">precio: <?php echo$result->precio ?> </p>
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h6 class="font-weight-bold my-2">$<?php echo $result->precio*$result->cantidad ?></h6>
              </div>
            </div><img <?php echo 'src="galeria/'.$result->foto.'"'?>alt="Generic placeholder image" width="150" class="ml-lg-5 order-1 order-lg-2">
          </div>
          <!-- End -->
        </li>
        <!-- End -->

    <?php }  }?>


      </ul>
         
         </div>

    </div>

      <?php
        include 'componentes/footer.php'
       ?>
     <script src="assets/js/eventosvanilla.js"></script>
   </body>
</html>

<?php
  unset($_SESSION['idpedido']);
?>