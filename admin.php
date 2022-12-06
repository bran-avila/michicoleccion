<?php
  session_start();
  include_once 'php/conexion.php';
  if(isset($_SESSION['user'])){
      
    if(isset($_SESSION['rolAdmin']) && $_SESSION['rolAdmin'] == false){
        header('Location: cuenta.php');
      }

  }else{

    header('Location: login.php');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="assets/css/estilosAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d75ed9723d.js" crossorigin="anonymous"></script>
    <script src="assets/js/jstable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/jstable.css">
</head>
<body>

<!-- Modal detalle pedido-->
<div class="modal fade" id="modalPedido" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalles del pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <p>
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                Direccion
              </button>
            </p>
            <div>
              <div class="collapse " id="collapseWidthExample">
                <div class="card card-body" style="width: 300px;" id="direccionp">
                  Este es un contenido placeholder para un colapso horizontal. Está oculto de forma predeterminada y se muestra cuando se activa.
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item" id="nombrep">Nombre:</li>
          <li class="list-group-item" id="numeroPagop">Numero pago:</li>
          <li class="list-group-item" id="cantidadp">Cantidad:</li>
          <li class="list-group-item" id="fechapagop">Fecha pago:</li>
          <li class="list-group-item" id="estatusp">Estatus del pago:</li>
          <li class="list-group-item" id="envio">Envio:</li>
          <li class="list-group-item" id="costoenvio">Costo envio:</li>
          <li class="list-group-item"> 
          <form action="estadoPedido.php" method="POST" id='formpedido'>
          <select class="form-select" aria-label="Default select example" id="estadopedido" name="estadopedido">
              <option value="Preparando para envio">Preparando para envio</option>
              <option value="Entregado en la paqueteria">Entregado en la paqueteria</option>
              <option value="En camino">En camino</option>
              <option value="Entregado">Entregado</option>
              <option value="cancelado">cancelado</option>
              <option value="devolucion">devolucion</option>
          </select>

          </form>

          </li>
          <li class="list-group-item" id="estatusp">Productos:</li>
        </ul>
        <ul class="list-group list-group-flush list-group-numbered" id="listaProductos">
        <li class="list-group-item" id="estatusp">Estatus del pago:</li>
          <li class="list-group-item" id="estatusp">Productos:</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-modal-pedido">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--modal de borrar-->

<div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-descripcion">
        va a borrar el producto 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<nav class="nav">
   <a href="#first"><i class="far fa-user"></i></a>
   <a href="#second"><i class="fa-solid fa-barcode"></i></a>
   <a href="#third"><i class="far fa-file"></i></a>
   <a href="#fourth"><i class="far fa-address-card"></i></a>
 </nav>







  <!-- seccion de usuarios -->
<div class= 'containerA'> 
  <section id= 'third' class="section">
    <div class= 'container margenes'>
        <div class="row">
          <div class="col-md-6 col-6">
            <h1>Pedidos</h1>
        </div>
        <div class="col-md-2 .d-sm-none .d-md-block">
        </div>
        
    </div>
    <div class="row">

      <table class="table" id="tablaPedido">
                <thead>
                  <tr>
                    <th scope="col">Numero pedido</th>
                    <th scope="col" >fecha </th>
                    <th scope="col" >Estatus venta</th>
                    <th scope="col" >total</th>
                    <th scope="col">Más detalles</th>
                  </tr>
                  </thead>
                  <tbody id="tablaCuerpo">

      <?php
           $pedidoInfo="";
          $productoPedido="";
          $sql = "select p.id as id,p.fecha as fecha, p.total as total,p.estatusVenta as etatus from usuario_pedido up, pedido p where up.idpedido = p.id"; 
          $query = connect() -> prepare($sql); 
          $query -> execute(); 
          $resultsP = $query -> fetchAll(PDO::FETCH_OBJ); 
          if($query -> rowCount() > 0)   { 
            foreach($resultsP as $resultP) { 
          
        ?>

    <?php
        
        $sql = "select c.categoria as categoria,f.nombre as foto,dp.nombre as nombre,dp.cantidad as cantidad,dp.precio as precio,dp.subtotal as total  from detalle_producto dp, producto p, foto f,categoria c where c.id=p.idcategoria and dp.idproducto = p.id and p.idfoto = f.id and dp.idpedido = :id; "; 
        $query = connect() -> prepare($sql); 
        $query->bindValue(':id',$resultP->id);
        $query -> execute(); 
        $results2 = $query -> fetchAll(PDO::FETCH_OBJ); 
        $productoPedido="";
        if($query -> rowCount() > 0)   { 
          foreach($results2 as $result2) { 
            
          $productoPedido= $result2 -> nombre."-".$result2 -> precio."-".$result2 -> categoria."-".$result2 -> total."-".$result2 -> cantidad."-".$result2 -> foto."_".$productoPedido;
          }
        }
      
      ?>


    <?php
        
        $sql = "select p.id as idpedido,p.estatusVenta as estadopedido, me.tipoenvio as envio,me.precio as precioenvio, p.correo as correo, p.idmetodoenvio as metodoenvio,p.fecha as fecha,d.nombre as nombre, d.apellidos as apellidos, d.pais as pais, d.callenum as calle,
        d.colonia as colonia,d.cp as cp,d.ciudad as ciudad, d.estado as estado,d.telefono as telefono,tp.idtransancion as numpago,tp.cantidad as cantidad,tp.fecha as fechapago,tp.estatus as estadopago from pedido p,
         direccion d, tipopago tp, metodoenvio me where p.idmetodoenvio = me.id and p.iddireccion = d.id and p.idtipoPago = tp.id and p.id= :id; "; 
        $query = connect() -> prepare($sql); 
        $query->bindValue(':id',$resultP->id);
        $query -> execute(); 
        $results3 = $query -> fetchAll(PDO::FETCH_OBJ); 
        if($query -> rowCount() > 0)   { 
          foreach($results3 as $result3) { 
          $pedidoInfo= $result3 -> correo."-_-".$result3 -> metodoenvio."-_-".$result3 -> fecha."-_-".$result3 -> nombre."-_-".$result3 -> apellidos."-_-".$result3 -> pais."-_-".$result3 -> calle."-_-".$result3 -> colonia."-_-".$result3 -> cp."-_-".$result3 -> ciudad.
          "-_-".$result3 -> estado."-_-".$result3 -> telefono."-_-".$result3 -> numpago."-_-".$result3 -> cantidad."-_-".$result3 -> fechapago."-_-".$result3 -> estadopago."-_-".$result3 -> envio."-_-".$result3 -> precioenvio."-_-".$result3 ->estadopedido."-_-".$result3 ->idpedido;
          }
        }
      
      ?>

                                <tr>
                                  <th><?php echo $resultP->id ?></th>
                                  <td><?php echo $resultP->fecha  ?></td>
                                  <td><?php echo $resultP->etatus ?></td>
                                  <td>total : $<?php echo $resultP->total ?></td>
                                  <td><button type="button" class="btn btn-primary" id="btnPedido" data-bs-toggle="modal" data-bs-target="#modalPedido" data-bs-whatever="<?php echo $productoPedido ?>" data-datospedido="<?php echo $pedidoInfo ?>">Mas detalles</button></td>
                                </tr>
                                <?php } } ?>
                              </tbody>
                              </table>
    </div>
  </section>
  






<!-- seccion de productos -->
  <section id= 'second' class="section">
    <div class= 'container margenes'>
      <div class="row">
        <div class="col-md-6 col-6">
          <h1>Productos</h1>
      </div>
      <div class="col-md-2 .d-sm-none .d-md-block">
      </div>
      <div class="col-md-4 col-6"><div class="row"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="agregar">Agregar</button></div></div>
  </div>
    <div class= 'row tamaño'>
    <!---->
    <?php 
                     $sql = "select p.id as id,p.nombre as nombre,p.precio as precio, f.nombre as urlfoto,c.categoria as categoria,p.idcategoria as idcategoria, p.idestadoproducto as idestadoproducto,p.idmarca as idmarca,p.idfoto as idfoto,p.descripcion as descripcion,p.anio as anio,p.cantidad as stock  from producto p,foto f, categoria c where p.idcategoria =c.id and p.idfoto = f.id and p.disponible = true order by p.nombre;"; 
                     $query = connect() -> prepare($sql); 
                     /*$categoria="";
                     $query->bindParam(':categoria',$categoria);*/
                     $query -> execute(); 
                     $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                     echo'  <table class="table" id="example">
                     <thead>
                       <tr>
                         <th scope="col">Nombre</th>
                         <th scope="col">Foto</th>
                         <th scope="col">Categoria</th>
                         <th scope="col">Precio</th>
                         <th scope="col">Stock</th>
                         <th scope="col">Editar</th>
                         <th scope="col">Borrar</th>
                       </tr>
                       </thead>
                       <tbody id="tablaCuerpo">
                     ';

                     if($query -> rowCount() > 0)   { 
                       foreach($results as $result) { 
                        $datosProducto= $result -> id."-".$result -> nombre."-".$result -> precio."-".$result -> idcategoria."-".$result -> idestadoproducto."-".$result -> idmarca."-".$result -> idfoto."-".$result -> descripcion."-".$result -> anio."-".$result -> stock;
                        echo' 
                                <tr>
                                  <th>'.$result -> nombre.'</th>
                                  <td><img src="galeria/'.$result -> urlfoto.'"style=" width: 100px; height: 100px;" alt=""></td>
                                  <td>'.$result -> categoria.'</td>
                                  <td>$'.$result -> precio.'</td>
                                  <td>'.$result -> stock.'</td>
                                  <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="'.$datosProducto.'">Editar</button></td>
                                  <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal12" data-bs-whatever="'.$datosProducto.'">
                                  borrar
                                </button>
                                  </td>
                                </tr>
                                ';
                       }
                       echo '  </tbody>
                                </table>';
                     }else{
                        echo '<h1 class="tituloNoDisponible">No existe productos</h1>';
                    }
                  
                    ?>
                <!---->
    </div>
    
    </div>

  </section>














  <!-- seccion de categorias -->
 <section id= 'first' class="section">
 <div class= 'container margenes'>
        <div class="row">
          <div class="col-md-6 col-6">
          <h1>INICIO</h1>
        </div>
        <div class="col-md-2 .d-sm-none .d-md-block">
        <div class="col-md-6 col-6">
        <a href="eliminarseccion.php">Cerrar sesion</a>
        </div>

        
        </div>
        
    </div>
    
    <div class="container">
      <div class="row">

        <div class="col-md-4 col-8 card text-center">
        <h5 class="card-header">PRODUCTOS</h5>
            <div class="row">
                  <div class="col-12">
                  <h5 class="card-title">
                    TOTAL DE PRODUCTOS
                   </h5>
                     
                  </div>
                  <div class="col-12">
                  <?php
                $sql = "SELECT COUNT(*) as productos FROM producto;"; 
                $query = connect() -> prepare($sql);
                $query -> execute();
                $productos=0; 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  $productos= $result ->productos;
                  }
                }
                
                ?>

                    <?php echo $productos?>
                   </div>
            </div>
            <div class="row">
                    <div class="col-4">
                      <div class="col-12">
                      <h5 class="card-title">
                        EN STOCK
                      </h5>
                      <?php
                $sql = "SELECT COUNT(*) as productos FROM producto where cantidad > 0;"; 
                $query = connect() -> prepare($sql);
                $query -> execute();
                $productos=0; 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  $productos= $result ->productos;
                  }
                }?>
                
                      </div>
                      <div class="col-12">
                      <?php echo $productos?>
                      </div>
                    </div>
                    <div class="col-4">
                    <div class="col-12">
                      <h5 class="card-title">
                        SIN STOCK
                      </h5>
                      <?php
                $sql = "SELECT COUNT(*) as productos FROM producto where cantidad = 0;"; 
                $query = connect() -> prepare($sql);
                $query -> execute();
                $productos=0; 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  $productos= $result ->productos;
                  }
                }?>
                      </div>
                      <div class="col-12">
                      <?php echo $productos?>
                      </div>
                    </div>
                    <div class="col-4">
                    <div class="col-12">
                      <h5 class="card-title">
                      CON MENOS DE 3
                      </h5>
                      <?php
                $sql = "SELECT COUNT(*) as productos FROM producto where cantidad <= 3 and cantidad > 0;"; 
                $query = connect() -> prepare($sql);
                $query -> execute();
                $productos=0; 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  $productos= $result ->productos;
                  }
                }?>
                      </div>
                      <div class="col-12">
                      <?php echo $productos?>
                      </div>
                    </div>
            </div>
        </div>


        <div class="col-md-4 col-8 card text-center">
        <h5 class="card-header">CLIENTES</h5>
        <div class="row">
                  <div class=" col-12 ">
                   <h5 class="card-title">
                   TOTAL DE CLIENTES
                   <?php
                    $sql = "SELECT count(*) as usuarios FROM usuarios;"; 
                    $query = connect() -> prepare($sql);
                    $query -> execute();
                    $usuarios=0; 
                    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                    if($query -> rowCount() > 0)   { 
                      foreach($results as $result) { 
                      $usuarios= $result ->usuarios;
                      }
                }?>

                   </h5>
                  </div>
                  <div class="col-12 card-text">
                  <?php echo $usuarios?>
                   </div>
            </div>
            <div class="row">
                  <div class="col-12">
                  <h5 class="card-title">
                  NUEVOS CLIENTES
                   </h5>
                   <?php
                    $sql = "SELECT count(*) as usuarios FROM usuarios where DATE(NOW()) = DATE(fecha); "; 
                    $query = connect() -> prepare($sql);
                    $query -> execute();
                    $usuarios=0; 
                    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                    if($query -> rowCount() > 0)   { 
                      foreach($results as $result) { 
                      $usuarios= $result ->usuarios;
                      }
                }?>
                  </div>
                  <div class="col-12">
                      <?php echo $usuarios?>
                   </div>
            </div>
        </div>


        
        <div class="col-md-4 col-8 card text-center">
        <h5 class="card-header">PEDIDOS</h5>
            <div class="row">
                  <div class="col-12">
                  <h5 class="card-title">
                  TOTAL DE PEDIDOS
                   </h5>
                   <?php
                    $sql = "SELECT count(*) as pedidos FROM pedido;"; 
                    $query = connect() -> prepare($sql);
                    $query -> execute();
                    $pedidos=0; 
                    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                    if($query -> rowCount() > 0)   { 
                      foreach($results as $result) { 
                      $pedidos= $result ->pedidos;
                      }
                }?>
                  </div>
                  <div class="col-12">
                  <?php echo $pedidos?>
                   </div>
            </div>
            <div class="row">
                    <div class="col-4">
                      <div class="col-12">
                      <h5 class="card-title">
                      NUEVOS PEDIDOS
                      </h5>
                      <?php
                        $sql = "SELECT count(*) as pedidos FROM pedido where DATE(NOW()) = DATE(fecha);"; 
                        $query = connect() -> prepare($sql);
                        $query -> execute();
                        $pedidos=0; 
                        $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                        if($query -> rowCount() > 0)   { 
                          foreach($results as $result) { 
                          $pedidos= $result ->pedidos;
                          }
                      }?>
                      </div>
                      <div class="col-12">
                      <?php echo $pedidos?>
                      </div>
                    </div>
                    <div class="col-4">
                    <div class="col-12">
                        <h5 class="card-title">
                        CANCELADOS
                      </h5>
                      <?php
                        $sql = "SELECT count(*) as pedidos FROM pedido where estatusVenta = 'cancelado';";
                        $query = connect() -> prepare($sql);
                        $query -> execute();
                        $pedidos=0; 
                        $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                        if($query -> rowCount() > 0)   { 
                          foreach($results as $result) { 
                          $pedidos= $result ->pedidos;
                          }
                      }?>
                      </div>
                      <div class="col-12">
                          <?php echo $pedidos?>
                      </div>
                    </div>
                    <div class="col-4">
                    <div class="col-12">
                          
                        <h5 class="card-title">
                        PROCESO ENVIO
                        </h5>
                        <?php
                        $sql = "SELECT count(*) as pedidos FROM pedido where estatusVenta = 'Preparando para envio';";
                        $query = connect() -> prepare($sql);
                        $query -> execute();
                        $pedidos=0; 
                        $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                        if($query -> rowCount() > 0)   { 
                          foreach($results as $result) { 
                          $pedidos= $result ->pedidos;
                          }
                      }?>
                      </div>
                      <div class="col-12">
                        <?php echo $pedidos?>
                      </div>
                    </div>
            </div>
        </div>

      </div>

    </div>




   
  </section>

















  <!-- seccion de pedidos -->
 <section id= 'fourth' class="section">
 <div class= 'container margenes'>
        <div class="row">
          <div class="col-md-6 col-6">
            <h1>Clientes</h1>
        </div>
        <div class="col-md-2 .d-sm-none .d-md-block">
        </div>
        






                  <div class="row">

          <table class="table" id="tablaUsuario">
                    <thead>
                      <tr>
                        <th scope="col">NOmbre</th>
                        <th scope="col" >Correo </th>
                        <th scope="col" >Fecha</th>
                      </tr>
                      </thead>
                      <tbody id="tablaCuerpo">

          <?php
              $sql = "SELECT nombre,apellidos,correo,fecha FROM usuarios"; 
              $query = connect() -> prepare($sql); 
              $query -> execute(); 
              $resultsP = $query -> fetchAll(PDO::FETCH_OBJ); 
              if($query -> rowCount() > 0)   { 
                foreach($resultsP as $resultP) { 
              
            ?>
                                    <tr>
                                      <th><?php echo $resultP->nombre." ".$resultP->apellidos ?></th>
                                      <td><?php echo $resultP->correo ?></td>
                                      <td><?php echo $resultP->fecha ?></td>
                                    </tr>
                                    <?php } } ?>
                                  </tbody>
                                  </table>
          </div>                







    </div>
  </section>
















</div>
</body>
<!--modal editar y agregar-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo mensaje</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="editarProducto.php" method="POST" id='fromAgregarEdit'>
        <div class="input-group mb-3">        
            <label class="input-group-text"  for="nombre">Nombre</label>
            <input  class="form-control" type="text" class="input-box" placeholder="Nombre" required name="nombre" id="nombre">
          </div>
          <div class="input-group mb-3">           
            <label class="input-group-text" for="descripcion">descripcion</label>
            <input   class="form-control" type="text" class="input-box" placeholder="descripcion" required name="descripcion" id="descripcion">
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="anio">año</label>
            <input  class="form-control" type="text" class="input-box" placeholder="anio" required name="anio" id="anio">
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="stock">stock</label>
            <input   class="form-control" type="text" class="input-box" placeholder="stock" required name="stock" id="stock">
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="stock">Agregar Imagen</label>
            <input   class="form-control" type="file" class="input-box" placeholder="foto" required name="foto" id="filefoto">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" aria-label="Cantidad (al dólar más cercano)" name ="precio" id="precio">
            <span class="input-group-text">.00</span>
          </div>
            <div class="input-group mb-3">
              <select class="form-select" aria-label="Default select example" name="categoria" id="categoria">
                <option value="0" selected>categoria</option>
                <?php
                $sql = "select categoria as nombre, id  from categoria;"; 
                $query = connect() -> prepare($sql);
                $query -> execute(); 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  echo'  <option value="'.$result -> id.'">'.$result -> nombre.'  </option>';
                  }
                }
                
                ?>
              </select>
            </div>
            <div class="input-group mb-3">            
                <select class="form-select" aria-label="Default select example" name="Estado" id="Estado" >
                  <option value="0" selected>Estado producto</option>
                  <?php
                   $sql = "SELECT id, estado as nombre FROM estado_producto;"; 
                   $query = connect() -> prepare($sql);
                   $query -> execute(); 
                   $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                   if($query -> rowCount() > 0)   { 
                     foreach($results as $result) { 
                     echo'  <option value="'.$result -> id.'">'.$result -> nombre.'  </option>';
                     }
                   }
                  
                  
                  
                  ?>
              </select>
            </div>
            <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example" name="Marca" id="Marca">
                  <option  value="0" selected>Marca</option>
                  <?php
                    $sql = "SELECT id, marca as nombre FROM marca;"; 
                    $query = connect() -> prepare($sql);
                    $query -> execute(); 
                    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                    if($query -> rowCount() > 0)   { 
                      foreach($results as $result) { 
                      echo'  <option value="'.$result -> id.'">'.$result -> nombre.'  </option>';
                      }
                    }
                    
                    
                    
                    ?>
              </select> 
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGE">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>




  window.onload = function () {
    //INICIANDO LAS TABLAS CON JS
    let myTable = new JSTable("#example");
    let tablaPedido = new JSTable("#tablaPedido");
    let tablaUsuario = new JSTable("#tablaUsuario");    
  };

 
 

         

let datosProducto = "";
let agregarModalFuncion= false;
let objectoProduct= {};

  var modalEditarAgregar = document.getElementById('exampleModal');
  modalEditarAgregar.addEventListener('show.bs.modal', function (event) {
    // Botón que activó el modal
    var button = event.relatedTarget;
    // Extraer información de los atributos data-bs-*
    var recipient = button.getAttribute('data-bs-whatever');
    // Si es necesario, puedes iniciar una solicitud AJAX aquí
    // y luego realiza la actualización en una devolución de llamada.
    //
    // Actualizar el contenido del modal.
    var modalTitle = exampleModal.querySelector('.modal-title');
    var modalBodyInput = exampleModal.querySelector('.modal-body input');
    datosProducto= recipient;
    /*modalTitle.textContent = 'Nuevo mensaje para ' + recipient
    modalBodyInput.value = recipient*/
//$datosProducto= $result -> id."-".$result -> nombre."-".$result -> precio."-".$result -> idcategoria."-".$result -> idestadoproducto."-".$result -> idmarca."-".$result -> idfoto."-".$result -> descripcion."-".$result -> anio."-".$result -> stock;
    let arregloValoresProduct= recipient.split('-');

     objectoProduct ={id:arregloValoresProduct[0],
      nombre:arregloValoresProduct[1],
      precio: arregloValoresProduct[2],
      idcategoria: arregloValoresProduct[3],
      idestadoproducto:arregloValoresProduct[4],
      idmarca:arregloValoresProduct[5],
      idfoto:arregloValoresProduct[6],
      descripcion:arregloValoresProduct[7],
      anio:arregloValoresProduct[8],
      stock:arregloValoresProduct[9]
      };

      console.log(objectoProduct);

      let nombre = document.getElementById('nombre');
      let descripcion = document.getElementById('descripcion');
      let anio = document.getElementById('anio');
      let stock = document.getElementById('stock');
      let categoria = document.getElementById('categoria');
      let estado = document.getElementById('Estado');
      let marca = document.getElementById('Marca');
      let precio = document.getElementById('precio');
      let filefoto = document.getElementById('filefoto');
      if(recipient!="agregar"){
        agregarModalFuncion= false;
        nombre.value=objectoProduct.nombre;
        descripcion.value = objectoProduct.descripcion;
        anio.value = objectoProduct.anio;
        stock.value= objectoProduct.stock;
        categoria.value = objectoProduct.idcategoria;
        estado.value = objectoProduct.idestadoproducto;
        marca.value =objectoProduct.idmarca;
        precio.value = objectoProduct.precio;
        filefoto.value='';
        modalTitle.textContent = "Editar producto "+objectoProduct.nombre;

      }else{
        agregarModalFuncion= true;
        nombre.value="";
        descripcion.value = "";
        anio.value = "";
        stock.value= "";
        categoria.value = 0;
        estado.value = 0;
        marca.value =0;
        precio.value = 0;
        filefoto.value='';
        modalTitle.textContent = "agregar producto";
      }


  });

  var modalborrar = document.getElementById('exampleModal12');
  modalborrar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var recipient = button.getAttribute('data-bs-whatever');
    let arregloValoresProduct= recipient.split('-');
    objectoProduct ={id:arregloValoresProduct[0],
      nombre:arregloValoresProduct[1]
    };
    var descripcionModal = document.querySelector('#modal-descripcion');
    descripcionModal.textContent = 'Va a borrar el producto ' + objectoProduct.nombre;   


  });

  function enviarDatosAgregar(){
    const data = new FormData(document.getElementById('fromAgregarEdit'));
    fetch('guardarProducto.php', {
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
              if (jsonResp.resultado == "ok"){
                console.log("se guardo la imagen");
                location.reload();
              }
            })
            .catch(function(err) {
            console.log(err);
            });
  }
  /*function agregarDatos(){

    let tabla = document.getElementById('tablaCuerpo');
    console.log(tabla.innerHTML+'<tr> <th>brandon</th><td><img src="galeria/Screenshot_2022-11-14-23-28-51-406_com.google.android.gm.jpg" style=" width: 100px; height: 100px;" alt=""></td><td>digimon</td><td>$1100.00</td><td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="7-brandon-1100.00-3-2-3-9-nuevo juwgo-2000-10">Editar</button></td><td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Borrar</button></td> </tr>');
    tabla.innerHTML =tabla.innerHTML+'<tr> <th>brandon</th><td><img src="galeria/Screenshot_2022-11-14-23-28-51-406_com.google.android.gm.jpg" style=" width: 100px; height: 100px;" alt=""></td><td>digimon</td><td>$1100.00</td><td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="7-brandon-1100.00-3-2-3-9-nuevo juwgo-2000-10">Editar</button></td><td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Borrar</button></td> </tr>';
  };*/

  function enviareditarDatos(){
    const data = new FormData(document.getElementById('fromAgregarEdit'));

    data.append('idproduct',  objectoProduct.id );

    data.append('idfotoSinEditar', objectoProduct.idfoto );

    fetch('editarProducto.php', {
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
              if (jsonResp.resultado == "ok"){
                console.log("se guardo la imagen");
                location.reload();
              }
            })
            .catch(function(err) {
            console.log(err);
            });

  }

  function eliminarProducto(){

    const data = new FormData();

    data.append('idproduct',  objectoProduct.id );

console.log(objectoProduct);
fetch('eliminarProducto.php', {
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
          if (jsonResp.resultado == "ok"){
            console.log("se guardo la imagen");
            location.reload();
          }
        })
        .catch(function(err) {
        console.log(err);
        });
  }
let btnGuardarEdit = document.getElementById('btnGE');
btnGuardarEdit.addEventListener("click",function (e){
  console.log(datosProducto);//con datos de productos puedo obtener la informacion necesaria para editar los productos
  const modal = bootstrap.Modal.getInstance(modalEditarAgregar);    
    modal.hide();
  if(agregarModalFuncion== true){
    enviarDatosAgregar();
  }else{
    enviareditarDatos();
  }
});
let btneliminar= document.getElementById('btn-eliminar');
btneliminar.addEventListener("click",function(e){
  eliminarProducto();
});


let idpedido=0;
let modalPedido = document.getElementById('modalPedido');
modalPedido.addEventListener('show.bs.modal', function (event) {
    // Botón que activó el modal
    let button = event.relatedTarget;
    // Extraer información de los atributos data-bs-*
    let datosBoton = button.getAttribute('data-bs-whatever');
    console.log(datosBoton);
    let arregloValoresProduct= datosBoton.split('_');
    arregloValoresProduct= arregloValoresProduct.map(function(producto){
        producto = producto.split('-');
        //$productoPedido= $result2 -> nombre."-".$result2 -> precio."-"
        //.$result2 -> categoria."-".$result2 -> total."-".$result2 -> cantidad."-".$result2 -> foto."_".$productoPedido;
        objPedido={nombre:producto[0],
          precio:producto[1],
          categoria:producto[2],
          total:producto[3],
          cantidad:producto[4],
          foto:producto[5]    
        };
        return objPedido;
    });
console.log(arregloValoresProduct);
arregloValoresProduct.splice(arregloValoresProduct.length - 1);
let cadenaProductos = arregloValoresProduct.reduce(function(valorAnterior,valorActual){
 let valorAc= `<li class="list-group-item" id="estatusp"> 
  <ul class="list-group">
        <li class="list-group-item" id="estatusp"><img src="galeria/${valorActual.foto}"style=" width: 100px; height: 100px;" alt=""></li>
        <li class="list-group-item" id="estatusp">Nombre: ${valorActual.nombre}</li>
        <li class="list-group-item" id="estatusp">precio: ${valorActual.precio} </li>
        <li class="list-group-item" id="estatusp"> Categoria: ${valorActual.categoria}  </li>
        <li class="list-group-item" id="estatusp">Cantidad: ${valorActual.cantidad} </li>
        <li class="list-group-item" id="estatusp">Total: ${valorActual.total}  </li>
  </ul>
 </li>`

console.log(valorActual)

  return valorAnterior+valorAc;
},"");

console.log(cadenaProductos);

/**/

let listaP=document.getElementById('listaProductos');

console.log(listaP.innerHTML);
listaP.innerHTML ="";
console.log(listaP.innerHTML);

listaP.innerHTML =cadenaProductos;




let datosModal = button.getAttribute('data-datospedido');
datosModal= datosModal.split('-_-');
console.log(datosModal);
datosModal={correo:datosModal[0],idmetodoenvio:datosModal[1],
  fecha:datosModal[2],nombre:datosModal[3],
  apellidos:datosModal[4],pais:datosModal[5],
  calle:datosModal[6],colonia:datosModal[7],
  cp:datosModal[8],ciudad:datosModal[9],
  estado:datosModal[10],telefono:datosModal[11],
  numpago:datosModal[12],cantidad:datosModal[13],
  fechapago:datosModal[14],estadopago:datosModal[15],
  envio:datosModal[16],costoenvio:datosModal[17],
  estadopedido:datosModal[18],idpedido:datosModal[19]
};
console.log(datosModal);
idpedido=datosModal.idpedido;

let nombreP= document.getElementById('nombrep');
let direccion=document.getElementById('direccionp');
let numeroPagop=document.getElementById('numeroPagop');
let cantidadp = document.getElementById('cantidadp');
let fechapagop = document.getElementById('fechapagop');
let estatusp = document.getElementById('estatusp');
let envio = document.getElementById('envio');
let costoenvio = document.getElementById('costoenvio');
let estadopedido = document.getElementById('estadopedido');

estadopedido.value=datosModal.estadopedido;

console.log(nombreP.textContent+datosModal.nombre+" "+datosModal.apellidos);
nombreP.textContent="Nombre:"+datosModal.nombre+" "+datosModal.apellidos;
direccion.textContent="Pais:"+datosModal.pais+" Calle:"+datosModal.calle+" Colonia:"+datosModal.colonia+" Codigo Postal:"+datosModal.cp+" Ciudad:"+datosModal.ciudad+" Estado:"+datosModal.estado+
" Telefono:"+datosModal.telefono+".";
cantidadp.textContent="Cantidad:"+" $"+datosModal.cantidad;
fechapagop.textContent="Fecha pago:"+" "+datosModal.fechapago;
estatusp.textContent="Estatus del pago:"+" "+datosModal.estadopago;
numeroPagop.textContent="Numero pago:"+" "+datosModal.numpago;
envio.textContent="Envio:"+" "+datosModal.envio;
costoenvio.textContent="Costo envio:$"+datosModal.costoenvio;
});
//$pedidoInfo= $result3 -> correo."-".$result3 -> metodoenvio."-".$result3 -> fecha."-".$result3 -> nombre."-".$result3 -> apellidos."-".$result3 -> pais."-".$result3 -> calle."-".$result3 -> colonia."-".$result3 -> cp."-".$result3 -> ciudad.
//"-".$result3 -> estado."-".$result3 -> telefono."-".$result3 -> numpago."-".$result3 -> cantidad."-".$result3 -> fechapago."-".$result3 -> estadopago;
          
let btnmodalpedido = document.getElementById('btn-modal-pedido');
btnmodalpedido.addEventListener("click",function (e){
  editarPedido();
});


function editarPedido(){

const data = new FormData(document.getElementById('formpedido'));
data.append('id',  idpedido );
fetch('estadoPedido.php', {
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
      if (jsonResp.resultado == "ok"){
        location.reload();
      }
    })
    .catch(function(err) {
    console.log(err);
    });
}

</script>
</html>

