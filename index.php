<?php
session_start();
include_once 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>michicoleccion</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    
    
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    
    <link rel="stylesheet" href="assets/css/lightbox.css">
    
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    
    <link rel="stylesheet" href="assets/css/modificaciones.css">

    <link rel="stylesheet" href="assets/css/estilos.css">

    <link rel="stylesheet" href="assets/css/animaciones.css">

    </head>
<body>

    <?php
        include 'componentes/header.php'
    ?>


    <div class="contenedorPrincipal">
            <div class="container-titulo">
                <h2 class="textTitulo focus-in-expand-fwd ">Colecciones</h2>
            </div>
            
        </div>




<div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 bounce-in-left">
                    <div class="left-content taamCG">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>DIGIMON</h4>
                                <span>BANDAI</span>
                                <div class="main-border-button">
                                    <a href="colecciones.php?categoria=digimon">Ver más</a>
                                </div>
                            </div>
                            <img src="assets/images/digimon.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6 bounce-in-right">
                                <div class="right-first-image taamC" >
                                    <div class="thumb">
                                        <div class="inner-content fondoEfect">
                                            <h4>HEROCLIX</h4>
                                            
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Heroclix</h4>
                                                <div class="main-border-button">
                                                    <a href="colecciones.php?categoria=heroclix">Ver productos</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/heroclixlogo.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 bounce-in-right">
                                <div class="right-first-image taamC">
                                    <div class="thumb">
                                        <div class="inner-content fondoEfect">
                                            <h4>VIDEO JUEGOS</h4>   
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Video juegos</h4>
                                                <div class="main-border-button">
                                                    <a href="colecciones.php?categoria=video+juegos">Ver productos</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/videojuegos.jpg">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-12 taamC bounce-in-bottom">

                                <div class="right-first-image tam">
                                    <div class="thumb">
                                        <div class="inner-content fondoEfect">
                                            <h4>COMICS Y REVISTAS</h4>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Comics y revistas</h4>
                                                <div class="main-border-button">
                                                    <a href="colecciones.php?categoria=comics+y+libros">Ver productos</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img  src="assets/images/comics.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="ofertas">
    <h2>Ofertas</h2>
</div>
<div class="bodyslider">

<div class="slider-container">

    <div class="slider-content">

    <?php
                $sql = "SELECT  f.nombre as foto,p.nombre as nombre,p.cantidad as stock FROM producto p, foto f where p.idfoto=f.id limit 5;"; 
                $query = connect() -> prepare($sql);
                $query -> execute();
                $productos=0; 
                $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                if($query -> rowCount() > 0)   { 
                  foreach($results as $result) { 
                  $productos= $result;
                ?>
        <div class="slider-single">
            <img class="slider-single-image" src="galeria/<?php echo $productos -> foto;?>" alt="1" />
            <h1 class="slider-single-title"><?php echo  $productos->nombre;?></h1>
            <a class="slider-single-likes" href="javascript:void(0);">
                <i class="fa fa-heart"></i>
                <p><?php echo  $productos->stock;?></p>
            </a>
        </div>

        <?php  }} 
                     ?>


    </div>
</div>
</div>




    

        <!-- ***** Footer Start ***** -->
        <?php
            include 'componentes/footer.php'
         ?>

    

    <script src="assets/js/eventosvanilla.js"></script>
</body>
</html>