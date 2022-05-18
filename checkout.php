<?php
session_start();
include_once 'php/conexion.php';
$cantidadTotal=0;



   if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])!=0){                
      foreach ($_SESSION['carrito'] as $result ) {
         $cantidadTotal+= $result["precio"]*$result["cantidad"];
      }
   }
                
               
               
if(isset($_POST["enviar"])){
   
   $sth =connect()->prepare("SELECT precio FROM metodoenvio where id = :id");
   $sth->bindParam(':id',$_POST['envio']);
   if( $sth->execute()){
      $result = $sth->fetch(PDO::FETCH_OBJ);
      $cantidadTotal=$cantidadTotal+ $result->precio;
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
      <link rel="stylesheet" href="assets/css/stylecheckout.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
   <script src="https://www.paypal.com/sdk/js?client-id=AYmkW-I_J63Cz7gRXzAspoEJzI_Tl0otpRCK2fTPa2JaFOD-Y9G9s5vhTEwmFOPqqxDvytuROEiCJLNu&currency=MXN"></script>
      
   <div class="containerCheckout">



         <div class="container">
            <header>Checkout</header>
            <div class="progress-bar">
               <div class="step">
                  <p>
                     Contacto
                  </p>
                  <div class="bullet">
                     <span>1</span>
                  </div>
                  <div class="check fas fa-check"></div>
               </div>
               <div class="step">
                  <p>
                     Direccion
                  </p>
                  <div class="bullet">
                     <span>2</span>
                  </div>
                  <div class="check fas fa-check"></div>
               </div>
               <div class="step">
                  <p>
                     Envio
                  </p>
                  <div class="bullet">
                     <span>3</span>
                  </div>
                  <div class="check fas fa-check"></div>
               </div>
               <div class="step">
                  <p>
                     Pago
                  </p>
                  <div class="bullet">
                     <span>4</span>
                  </div>
                  <div class="check fas fa-check"></div>
               </div>
            </div>
            <div class="form-outer">
               <form action="" id="fromCheckout" method="POST">
                  <div class="page slide-page">
                     <div class="title">
                        Informacion de contacto:
                     </div>
                     <div class="field">
                        <div class="label">
                           Correo
                        </div>
                        <input type="email" required name="correo" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['correo'].'"'; ?>>
                     </div>
      
                     <div class="field">
                        <button class="firstNext next">Siguiente</button>
                     </div>
                  </div>
                  <div class="page envio" id="sc3">
                     <div class="title">
                        Direccion de envio:
                     </div>
                     <div class="field">
                        <div class="label">
                           Pais
                        </div>
                        <input type="text" required name="pais"  <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['pais'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Nombre
                        </div>
                        <input type="text" required name="nombre" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['nombre'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Apellidos
                        </div>
                        <input type="text" required name="apellidos" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['apellidos'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Calle,numero interior y exterior
                        </div>
                        <input type="text" required name="calle" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['calle'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Colonia
                        </div>
                        <input type="text" required name="colonia" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['colonia'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Codigo postal
                        </div>
                        <input type="text" required name="cp" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['cp'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Ciudad
                        </div>
                        <input type="text" required name="ciudad" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['ciudad'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Estado
                        </div>
                        <input type="text" required name="estado" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['estado'].'"'; ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Telefono
                        </div>
                        <input type="text" required name="telefono" <?php if(isset($_POST["enviar"])) echo 'value="'.$_POST['telefono'].'"'; ?>>
                     </div>
                     <div class="field btns">
                        <button class="prev-1 prev">Anterior</button>
                        <button class="next-1 next">Siguiente</button>
                     </div>
                  </div>
                  <div class="page">
                     <div class="title">
                        Envio:
                     </div>
                     <div class="field">
                        <div class="label">
                           Economico (7 a 10 dias) $60
                        </div>
                        <input type="radio" name="envio" value="1"  data-cantidad="60" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 1) {echo 'checked="checked"';}else{ echo 'checked="checked"';} ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Normal (2 a 5 dias) $120
                        </div>
                        <input type="radio" name="envio" value="2" data-cantidad="120" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 2) {echo 'checked="checked"';} ?>>
                     </div>
                     <div class="field">
                        <div class="label">
                           Economico (1 a 3 dias) $180
                        </div>
                        <input type="radio" name="envio" value="3" data-cantidad="180" <?php if(isset($_POST["enviar"]) && $_POST["envio"] == 3) {echo 'checked="checked"';} ?>>
                     </div>
                     <div class="field btns">
                        <button class="prev-2 prev">Anterior</button>
                        <button class="next-2 next" type="submit" name="enviar">Pagar</button>
                     </div>
                  </div>
                  <div class="page">
                     <div class="title">
                        Metodo pago:
                     </div>
                     <div id="paypal-button-container"></div>
                     <div class="field btns">
                        <button class="prev-3 prev">Anterior</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
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
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');

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
            if(response.ok) {
                return response.json();
            } else {
                throw "Error en la llamada Ajax";
            }

            })
            .then(function(jsonResp) {
            console.log(jsonResp);
            
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