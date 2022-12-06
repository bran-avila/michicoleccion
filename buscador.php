<?php
session_start();
include_once 'php/conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/animaciones.css">
    <link rel="stylesheet" href="assets/css/estilosCatalogo.css">
    <link rel="stylesheet" href="assets/css/EstilosBuscador.css">
    <title>Buscador</title>
</head>
<body>
<?php
        include 'componentes/header.php'
?>

<?php 
$sql = "select p.id as id,p.nombre as nombre,p.precio as precio, f.nombre as urlfoto from producto p,foto f, categoria c  where p.idcategoria =c.id and p.idfoto = f.id and p.cantidad > 0 and disponible=true order by p.nombre;"; 
$query = connect() -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 
if($query -> rowCount() > 0)   { 
  foreach($results as $result) { 
    $productos[]=array("id"=>$result->id,"nombre"=>$result->nombre,"precio"=>$result->precio,"urlfoto"=>$result->urlfoto);
  }
}

$json_string = json_encode($productos);

?>


<main>
    <div class="buscadorEstilos">
                
        <form class="search-box bounce-in-right">
        <input type="text" placeholder=" " id="search" />
        <button type="reset"></button>
        </form>
    </div>


    <div class="container page-wrapper contenedorProductos">
        <div class="page-inner">    
            <div class="row" id="contenedorProductos">
                
                    


            </div>
     </div> 
</div>
    
</main>

<?php
            include 'componentes/footer.php'
         ?>
         <script src="assets/js/eventosvanilla.js"></script>
         <script>
            let contenedorProductos = document.getElementById('contenedorProductos');


            
            let buscador= document.getElementById('search');
            buscador.addEventListener('keyup', function(){
                        console.log(buscador.value);
                        let palabra =buscador.value;//es la palabra que va obtener del input
                        if(palabra==""){
                            palabra ="qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq";
                        } 
                    palabra= palabra.toLowerCase();//la pasamos en minusculas para no tener problemas en buscar la palabra
                    let jsonProductos = <?php echo $json_string ?>;
                    console.log(jsonProductos);
                let productosFlitrados= jsonProductos.filter(function(producto){
                        if(producto.nombre.toLowerCase().indexOf(palabra)>=0){
                            return producto;
                        }
                    });
                    console.log(productosFlitrados);


                    let cadenaProductos = productosFlitrados.reduce(function(valorAnterior,valorActual){
                    let valorAc= `
                    <div class="el-wrapper bounce-in-right">
                                <div class="box-up">
                                <img class="img" src="galeria/${valorActual.urlfoto}" alt="">
                                <div class="img-info">
                                    <div class="info-inner">
                                    <span class="p-name">${valorActual.nombre}</span>
                                    </div>
                                </div>
                                </div>
                            
                                <div class="box-down">
                                <div class="h-bg">
                                    <div class="h-bg-inner"></div>
                                </div>
                            
                                <a class="cart" href="producto.php?id=${valorActual.id}&nombre=${valorActual.nombre}'">
                                    <span class="price">$ ${valorActual.precio}  </span>
                                    <span class="add-to-cart">
                                    <span class="txt">Comprar</span>
                                    </span>
                                </a>
                            </div>           
                        </div>
                                `
                    return valorAnterior+valorAc;
                    },"");
                    contenedorProductos.innerHTML = "";
                    contenedorProductos.innerHTML = cadenaProductos;
            });
         </script>
</body>
</html>