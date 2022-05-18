<?php
session_start();
include_once 'php/conexion.php';

function existeCategoria($categoria){
    $query = connect()->prepare('SELECT * FROM categoria WHERE categoria = :categoria');
    $query->execute(['categoria' => $categoria]);
    $categoriaExiste= false;
    if($query->rowCount()){
       return $categoriaExiste= true;
    }else{
        return $categoriaExiste= false;
    }
}

function numeroProductos($categoria){
    $sql='select count(p.id)  from producto p, categoria c  where p.idcategoria =c.id  and c.categoria = :categoria;';
    $query = connect() -> prepare($sql); 
    $query->bindParam(':categoria',$categoria);
    $query -> execute(); 
    $results = $query ->fetchColumn();
    return $results;
}


$numeroProductos = 0;
$categoria='';

$sql='select p.nombre as nombre,p.precio as precio, f.nombre as urlfoto from producto p,foto f, categoria c  where p.idcategoria =c.id and p.idfoto = f.id and c.categoria = :categoria order by p.nombre;';

if(isset($_GET["categoria"])){
    if(existeCategoria($_GET["categoria"])){
        $str = $_GET["categoria"];
        $str = strtoupper($str);
        $categoria= $str;
        $numeroProductos=numeroProductos($_GET["categoria"]);
    }else{
        $categoria= "COLECCIONES";
    }
    
}else{
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/estilosCatalogo.css">
    <link rel="stylesheet" href="assets/css/footer.css">

</head>
<body>
    <?php
        include 'componentes/header.php'
    ?>

    <main class ="contenedorProductos">
    

        <div class="container-Breadcrumb">
            <div>
                <a href="#">Home</a>
                <img src="assets/images/flecha1.png" alt="">
            </div>
            <div>
            <?php 
            $categoriaMinuscula = strtolower($categoria);
            echo '<a href="colecciones.php?categoria='.$categoriaMinuscula.'">'.$categoriaMinuscula. '</a>';?>
            </div>
        </div>

        <div class="container-titulo Productos">
                <h2 class="textTitulo">
                    <?php
                      echo  $categoria;
                    ?>
                </h2>
        </div>
        <div class="container-filtro">
             <span><?php echo $numeroProductos ?> articulos</span>
             <label class="select" for="slct">
                <select id="slct" required="required">
                    <option value="" disabled="disabled" selected="selected">Select option</option>
                    <option value="#">One</option>
                    <option value="#">Two</option>
                    <option value="#">Three</option>
                    <option value="#">Four</option>
                    <option value="#">Five</option>
                    <option value="#">Six</option>
                    <option value="#">Seven</option>
                </select>
                <svg>
                    <use xlink:href="#select-arrow-down"></use>
                </svg>
            </label>
            <!-- SVG Sprites-->
            <svg class="sprites">
            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                <polyline points="1 1 5 5 9 1"></polyline>
            </symbol>
            </svg>
        </div>
        
        <!-- catalogo de las piezas-->

        <div>
            <div class="container page-wrapper">
                <div class="page-inner">
                    <div class="row">

                    <?php 
                     $sql = "select p.id as id,p.nombre as nombre,p.precio as precio, f.nombre as urlfoto from producto p,foto f, categoria c  where p.idcategoria =c.id and p.idfoto = f.id and c.categoria = :categoria order by p.nombre;"; 
                     $query = connect() -> prepare($sql); 
                     $query->bindParam(':categoria',$_GET["categoria"]);
                     $query -> execute(); 
                     $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                     if($query -> rowCount() > 0)   { 
                       foreach($results as $result) { 
                        echo' <div class="el-wrapper">
                                    <div class="box-up">
                                    <img class="img" src="galeria/'.$result -> urlfoto.'" alt="">
                                    <div class="img-info">
                                        <div class="info-inner">
                                        <span class="p-name">'.$result -> nombre.'</span>
                                        </div>
                                    </div>
                                    </div>
            
                                    <div class="box-down">
                                    <div class="h-bg">
                                        <div class="h-bg-inner"></div>
                                    </div>
            
                                    <a class="cart" href="producto.php?id='.$result -> id.'">
                                        <span class="price">$'.$result -> precio.' </span>
                                        <span class="add-to-cart">
                                        <span class="txt">Comprar</span>
                                        </span>
                                    </a>
                                    </div>
                                </div>';
                       }
                     }else{
                        echo '<h1 class="tituloNoDisponible">No existe productos</h1>';
                    }
                    
                    ?>

                    <!-- template de card producto
                    <div class="el-wrapper">
                        <div class="box-up">
                        <img class="img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlTMOUKVrWIskTKnkARGEOMcAeghwu0QaETg&usqp=CAU" alt="">
                        <div class="img-info">
                            <div class="info-inner">
                            <span class="p-name">I feel like Pablo</span>
                            <span class="p-company">Yeezy</span>
                            </div>
                            <div class="a-size">Available sizes : <span class="size">S , M , L , XL</span></div>
                        </div>
                        </div>

                        <div class="box-down">
                        <div class="h-bg">
                            <div class="h-bg-inner"></div>
                        </div>

                        <a class="cart" href="#">
                            <span class="price">$120</span>
                            <span class="add-to-cart">
                            <span class="txt">Add in cart</span>
                            </span>
                        </a>
                        </div>
                    </div>
                    -->



                    </div>
                </div>
            </div>
        </div>


    </main>
    <?php
        include 'componentes/footer.php'
    ?>
    <script src="assets/js/eventosvanilla.js"></script>
</body>
</html>