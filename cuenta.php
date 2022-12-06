<?php 
session_start();
include_once 'php/conexion.php';
/*
function verificarUserExistente($user){
    $verificacion= false;
    $query = connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
    $query->execute(['user' => $user]);
    if($query->rowCount()){
        $verificacion= true;
    }
    return $verificacion;
}

//tenemos que hacer una  consulta sql primero con el correo para obtener el id del usuario para despues obtener toda su informacion como domicilios

*/
if(!isset($_SESSION['user'])){

  header('Location:login.php');
}


?>

<!DOCTYPE html>
<html>
<head>
<title> Cuenta </title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="assets/css/estilos.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/footer.css">
<link rel="stylesheet" href="assets/css/animaciones.css">
<link rel="stylesheet" href="assets/css/cuenta.css">
</head>
<body>
  <?php
        include 'componentes/header.php'
    ?>
<div class="contenedorCerrarSession">
  <a href="eliminarseccion.php">Cerrar sesion</a>
</div>

<div class="container-btn-pagar ">
  <?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])!=0){?>
  <a href="checkout.php" class=" btncarrito wobble-hor-bottom">
          Finalizar pedido
  </a>
    <?php } ?>
  </div>
  <div class="containerTexto">
         <h1 class="focus-in-expand-fwd textTitulo">pedidos</h1>
     </div>
   <main class="contenedor">

   <div class="container tamañolist">
         <ul class="list-group bounce-in-bottom">
        <?php
        
          $sql = "select p.id as id,p.fecha as fecha, p.total as total,p.estatusVenta as etatus from usuario_pedido up, pedido p where up.idpedido = p.id and up.idusuarios = :id;"; 
          $query = connect() -> prepare($sql); 
          $query->bindValue(':id', $_SESSION['id']);
          $query -> execute(); 
          $results = $query -> fetchAll(PDO::FETCH_OBJ); 
          if($query -> rowCount() > 0)   { 
            foreach($results as $result) { 
            
        ?>

          <!-- list group item-->
          <li class="list-group-item"  width="200">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2">Estatus de venta: <?php echo $result->etatus ?></h5>
              <p class="font-italic text-muted mb-0 small">Id de pedido: <?php echo$result->id ?> </p>
              <p class="font-italic text-muted mb-0 small">fecha pedido: <?php echo$result->fecha ?> </p>
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h6 class="font-weight-bold my-2">total : $<?php echo $result->total ?></h6>
                <a <?php echo  'href="compraexitosa.php?id='.$result->id.'"' ;?>>Ver mas detalles</a>
              </div>
          </div>
          <!-- End -->
        </li>
        <!-- End -->

    <?php } ?>


      </ul>
    <?php  }else{ ?>

      <div class="contenedorProductoNoExistente">
        <p class="focus-in-expand-fwd"> No tiene pedidos</p>

      </div>
      <?php }?>
         </div>


   </main>
  
      <?php
            include 'componentes/footer.php'
         ?>
         <script src="assets/js/eventosvanilla.js"></script>
</body>
</html>
