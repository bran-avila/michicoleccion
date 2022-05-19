<?php
session_start();
include_once 'php/conexion.php';
$cantidadTotal=0;
$envio =0;
$subtotal=0;
if(!isset($_SESSION['user'])){
   header('Location: login.php');
}
                
               
               
if(isset($_POST["enviar"])){
   
   $sth =connect()->prepare("SELECT precio FROM metodoenvio where id = :id");
   $sth->bindParam(':id',$_POST['envio']);
   if( $sth->execute()){
      $result = $sth->fetch(PDO::FETCH_OBJ);
      $cantidadTotal=$cantidadTotal+ $result->precio;
      $envio =  $result->precio;
 }else{
      
 }

 echo $cantidadTotal;
}



?>



<!DOCTYPE html>
<!-- Created By CodingNepal url:https://www.codingnepalweb.com/multi-step-form-html-css-javascript/-->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Multi Step Form | CodingNepal</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/carrito.css">
    <link rel="stylesheet" href="assets/css/stylecheckout.css">
   </head>
   <body>
   <script src="https://www.paypal.com/sdk/js?client-id=AYmkW-I_J63Cz7gRXzAspoEJzI_Tl0otpRCK2fTPa2JaFOD-Y9G9s5vhTEwmFOPqqxDvytuROEiCJLNu&currency=MXN"></script>
   <?php
        include 'componentes/header.php'
    ?>   
   <div class="containerCheckout">

         <div class="containerc">
            <header>Checkout</header>
            <div class="progress-barc">
               <div class="stepc">
                  <p>
                     Contacto
                  </p>
                  <div class="bulletc">
                     <span>1</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Direccion
                  </p>
                  <div class="bulletc">
                     <span>2</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Envio
                  </p>
                  <div class="bulletc">
                     <span>3</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Pago
                  </p>
                  <div class="bulletc">
                     <span>4</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
            </div>
            <div class="form-outerc">
               <form action="" id="fromCheckout" method="POST">
                  <div class="pagec slide-pagec">
                     <div class="titlec">
                        Informacion de contacto:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Correo
                        </div>
                        <input type="email" required name="correo" <?php if(isset($_POST["enviar"])){ echo 'value="'.$_POST['correo'].'"';}else{echo 'value="'.$_SESSION['user'].'"';} ?>>
                     </div>
      
                     <div class="fieldc">
                        <button class="firstNextc nextc">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec envio" id="sc3">
                     <div class="titlec">
                        Direccion de envio:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Pais
                        </div>
                        <input type="text" required name="pais"  <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['pais'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Nombre
                        </div>
                        <input type="text" required name="nombre" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['nombre'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Apellidos
                        </div>
                        <input type="text" required name="apellidos" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['apellidos'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Calle,numero interior y exterior
                        </div>
                        <input type="text" required name="calle" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['calle'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Colonia
                        </div>
                        <input type="text" required name="colonia" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['colonia'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Codigo postal
                        </div>
                        <input type="text" required name="cp" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['cp'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Ciudad
                        </div>
                        <input type="textc" required name="ciudad" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['ciudad'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Estado
                        </div>
                        <input type="text" required name="estado" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['estado'].'"'; ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Telefono
                        </div>
                        <input type="text" required name="telefono" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['telefono'].'"'; ?>>
                     </div>
                     <div class="fieldc btnsc">
                        <button class="prev-1c prevc">Anterior</button>
                        <button class="next-1c nextc">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec">
                     <div class="titlec">
                        Envio:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Economico (7 a 10 dias) $60
                        </div>
                        <input type="radio" name="envio" value="1"  data-cantidad="60" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 1) {echo 'checked="checked"';}else{ echo 'checked="checked"';} ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Normal (2 a 5 dias) $120
                        </div>
                        <input type="radio" name="envio" value="2" data-cantidad="120" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 2) {echo 'checked="checked"';} ?>>
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Economico (1 a 3 dias) $180
                        </div>
                        <input type="radio" name="envio" value="3" data-cantidad="180" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 3) {echo 'checked="checked"';} ?>>
                     </div>
                     <div class="fieldc btns">
                        <button class="prev-2c prevc">Anterior</button>
                        <button class="next-2c nextc" type="submit" name="enviar">Pagar</button>
                     </div>
                  </div>
                  <div class="pagec">
                     <div class="titlec">
                        Metodo pago:
                     </div>
                     <div id="paypal-button-container"></div>
                     <div class="fieldc btns">
                        <button class="prev-3c prevc">Anterior</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>


         <div class="container tamañolist">
         <ul class="list-group">
         <?php
         
         
   if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])!=0){   
      $subtotal=0;        
      foreach ($_SESSION['carrito'] as $result ) {
         $cantidadTotal+= $result["precio"]*$result["cantidad"]; 
         $subtotal+= $result["precio"]*$result["cantidad"];
         ?>



        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2"><?php echo $result["nombre"] ?></h5>
              <p class="font-italic text-muted mb-0 small">Cantidad: <?php echo $result["cantidad"] ?> </p>
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h6 class="font-weight-bold my-2">$<?php echo $result["precio"]*$result["cantidad"] ?></h6>
              </div>
            </div><img <?php echo 'src="galeria/'.$result["url"].'"'?>alt="Generic placeholder image" width="150" class="ml-lg-5 order-1 order-lg-2">
          </div>
          <!-- End -->
        </li>
        <!-- End -->

       <?php
       
      }
      
   }
       
       
       ?>
        <!-- list group item -->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="200">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-8">
                     <h5 class="mt-0 font-weight-bold mb-2">subtotal</h5>
                  </div>
                  <div class="col-4">
                     <h6 class="font-weight-bold my-2">$<?php echo $subtotal;?></h6>
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <!-- End -->
                 <!-- list group item -->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="200">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-8">
                     <h5 class="mt-0 font-weight-bold mb-2">Envio</h5>
                  </div>
                  <div class="col-4">
                     <h6 class="font-weight-bold my-2">$<?php echo $envio;?></h6>
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
                <!-- list group item -->
                <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3 " width="200">
            <div class="media-body order-2 order-lg-1">
              <div class="row">
                  <div class="col-8">
                     <h5 class="mt-0 font-weight-bold mb-2">total</h5>
                  </div>
                  <div class="col-4">
                     <h6 class="font-weight-bold my-2">$<?php echo $cantidadTotal;?></h6>
                  </div>
              </div>
               </div>
            </div>
          <!-- End -->
        </li>
        <!-- End -->
        <!-- End -->
        <!-- list group item -->
      </ul>
         
         </div>

      </div>

      <?php
        include 'componentes/footer.php'
       ?>

      <script src="assets/js/scriptcheckout.js"></script>
   
      <script>
         let total = <?php echo  $cantidadTotal;?>;

      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {//promesa de si el pago de paypal fue un exitoso

            const data = new FormData(document.getElementById('fromCheckout'));
            let idTransacion = orderData.purchase_units[0].payments.captures[0].id;
            let fecha = orderData.purchase_units[0].payments.captures[0].create_time;
            let status = orderData.purchase_units[0].payments.captures[0].status;
            let total = orderData.purchase_units[0].amount.value;

            console.log(idTransacion,fecha,status,total);


            data.append('idtransancion', idTransacion );
            data.append('fecha', fecha );
            data.append('status', status );
            data.append('total', total );


            fetch('registroCompra.php', {
            method: 'POST',
            body: data
            })
            .then(function(response) {
               console.log(response);
            if(response.ok) {
                return response.json();
            } else {
                throw "Error en la llamada Ajax";
            }

            })
            .then(function(jsonResp) {
            console.log(jsonResp);
            window.location.href="compraexitosa.php";

            
            })
            .catch(function(err) {
            console.log(err);
            });

          });
        }
      }).render('#paypal-button-container');
    </script>

    <?php
      if(isset($_POST['enviar'])){
         echo      '<script> 
                        pagePago();
                  </script>' ;
         
      }

    ?>
   </body>
</html>