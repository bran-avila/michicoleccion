<?php
session_start();
include_once 'php/conexion.php';

$cantidadProductosSesion = 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle producto</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/producto.css">
    <link rel="stylesheet" href="assets/css/migaspan.css">
    <link rel="stylesheet" href="assets/css/animaciones.css">
</head>
<body>
    <?php
        include 'componentes/header.php'
    ?>

    <main class="contendedorProducto">
        <?php
            if(isset($_GET["id"] ) ){
                $sql="select p.cantidad as cantidad, p.id as id,p.nombre as nombre,p.precio as precio, f.nombre as urlfoto,m.marca as marca,c.categoria as categoria, ep.estado as estado from producto p,foto f, categoria c,estado_producto ep,marca m where p.idcategoria =c.id and p.idfoto = f.id and p.idmarca=m.id and p.idestadoproducto =ep.id and p.id = :id order by p.nombre;";
                $query = connect() -> prepare($sql); 
                $query->bindParam(':id',$_GET["id"]);
                $query -> execute(); 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                    foreach($results as $result) { 
                        $idproducto = "c".$result -> id; 
                        if(isset($_SESSION['carrito'][$idproducto])){
                            $cantidadProductosSesion= $_SESSION['carrito'][$idproducto]["cantidad"];
                           }
                    
        ?>


        <div class="container-Breadcrumb ">
            <div>
                <a href="#">Home</a>
                <img src="assets/images/flecha1.png" alt="">
            </div>
            <div>
            <?php 
            $categoriaMinuscula = strtolower($result -> categoria);
            echo '<a href="colecciones.php?categoria='.$categoriaMinuscula.'">'.$categoriaMinuscula. '</a>';?>
            <img src="assets/images/flecha1.png" alt="">
            </div>
            <div>
            <?php 
            $categoriaMinuscula = strtolower($result -> nombre);
            echo '<a href="#">'.$categoriaMinuscula. '</a>';?>
            </div>

        </div>
        <div class="contenedorDetalleProducto " >

            <div class="centerContenido swing-in-left-bck">
                <p>Nombre:<?php echo $result -> nombre?></p>
                <p>Categoria:<?php echo $result -> categoria?></p>
                <p>Marca:<?php echo $result -> marca?></p>
                <p>$<?php echo $result -> precio?></p>
                <p>Estado:<?php echo $result -> estado?></p>
                <form id="number-spinner-horizontal" class="t-neutral" action="carrito.php" method="POST">
                    <fieldset class="spinner spinner--horizontal l-contain--medium">
                    <label for="spinner-input" class="spinner__label">Cantidad: </label>
                    <button class="spinner__button spinner__button--left js-spinner-horizontal-subtract" data-type="subtract" title="Subtract 1" aria-controls="spinner-input">- </button>
                    <input name="cantidad" type="number" class="spinner__input js-spinner-input-horizontal" id="spinner-input" value="0" min="0" <?php echo 'max="'.($result -> cantidad-$cantidadProductosSesion).'"'?> step="1" pattern="[0-9]*" role="alert" aria-live="assertlive" />
                    <button data-type="add" class="spinner__button spinner__button--right js-spinner-horizontal-add" title="Add 1" aria-controls="spinner-input">+ </button>
                    </fieldset>
                    <input type="text" class="inputD" name="id" <?php echo 'value="'. $result -> id.'"'?> >
                    <input type="text" class="inputD" name="categoria" <?php echo 'value="'. $result -> categoria.'"'?> >
                    <input type="text" class="inputD" name="urlfoto" <?php echo 'value="'. $result -> urlfoto.'"'?> >
                    <input type="text" class="inputD" name="nombre" <?php echo 'value="'. $result -> nombre.'"'?> >
                    <input type="text" class="inputD" name="precio" <?php echo 'value="'. $result -> precio.'"'?> >
                    <input type="text" class="inputD" name="stock" <?php echo 'value="'. ($result -> cantidad-$cantidadProductosSesion).'"'?> >
                   
                    <button type="submit" class="btncarrito">
                        Añadir al carrito
                    </button>
                </form>
                
            </div>

            <?php
            }
        }else{

        }
            
            ?>

<?php
            if(isset($_GET["id"] ) ){
                $sql="select f.nombre as urlfoto from producto as p,foto as f,galeria g where g.idproducto= p.id and g.idfoto =f.id and p.id=:id;";
                $query = connect() -> prepare($sql); 
                $query->bindParam(':id',$_GET["id"]);
                $query -> execute(); 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                    foreach($results as $result) { 
                
                    
        ?>
          
                <!-- Swiper -->
                <div class="swiper mySwiper swing-in-right-bck" id="tamañoimg" >
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                    <img <?php echo 'src="galeria/'.$result -> urlfoto.'"'?> />
                    </div>
                    
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
               
                </div>
            
           <?php
               }
            }
        }
           ?>

        </div>
        <?php
         
            }else{



            }
    ?>

    </main>

    <?php
        include 'componentes/footer.php'
    ?>

    
   <script src="assets/js/numberSpinner.js"></script>
    <script>
			NumberSpinner('spinner-input');
	</script>
    <script src="assets/js/eventosvanilla.js"></script>
     <!-- Swiper JS -->
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script>

</body>
</html>