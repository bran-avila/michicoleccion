<?php
session_start();


if(isset($_POST['id'])&&isset($_POST['cantidad'])){
    //si mandan un producto al carrito
    $idproducto = "c".$_POST['id'];//creamos una key para agregarlo al arreglo
/*
    en php para crear un arreglo se usa $arreglo = array();
    para agregar un elemento al arreglo usamos $arreglo[]= "primer elemento" si no podemos algo en los corchetes se va inexar automaticamente comenzado en 0,1,2,3 etc.
    si hacemos arreglo["key1"]="segundo elemento" se va agregar un nuevo elemento con una key "key1" mientras el elemento anterior tiene una key ="0"  
*/

    if(isset($_SESSION['carrito'])){
        //si existe una variable de seccion carrito 
        if(!isset($_SESSION['carrito'][$idproducto])){
            //verificamos que no exista el producto que vamos a ingresar al arreglo  
            $_SESSION['carrito'][$idproducto]=[
                "id"=>$_POST['id'],
                "cantidad"=> $_POST['cantidad'],
                "nombre"=>$_POST['nombre'],
                "url"=>$_POST['urlfoto'],
                "precio"=>$_POST['precio'],
                "stock"=>$_POST['stock'],
            ];
        }else{
            //si existe un producto que se encuentra en el carrito se agrega la cantidad que manda del post
            $_SESSION['carrito'][$idproducto]["cantidad"]+=$_POST['cantidad'];
        }
        
    }else{
       
        $_SESSION['carrito']= array();
        $_SESSION['carrito'][$idproducto]=[
            "id"=>$_POST['id'],
            "cantidad"=> $_POST['cantidad'],
            "nombre"=>$_POST['nombre'],
            "url"=>$_POST['urlfoto'],
            "precio"=>$_POST['precio'],
            "stock"=>$_POST['stock'],
        ];
    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/carrito.css">
</head>
<body>
    <?php
        include 'componentes/header.php'
    ?>

    <main class="contnedorCarrito">

    <div class="wrap cf">
  <h1 class="projTitle">Mi carrito de compra</h1>
  <div class="heading cf">
    <h1>Productos</h1>
    <a href="index.php" class="continue">Continuar comprando</a>
  </div>
  <div class="cart">
<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
    </ul>-->
        <ul class="cartWrap" id="contenedorCarrito">

            <?php
            $cantidadTotal=0;
            if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])!=0){
                $cont = 1;
                foreach ($_SESSION['carrito'] as $result ) {
                    $cantidadTotal+= $result["precio"]*$result["cantidad"];
                
            ?>

            <li 
            <?php
            if($cont==1){
                $cont++;
                echo 'class="items odd"';
            }else{
                $cont=1;
                echo 'class="items even"';
            }
            
            ?>
            
            
            <?php echo 'data-id="'.$result["id"].'"'?>>
            
                <div class="infoWrap"> 
                    <div class="cartSection">
                    <img <?php echo 'src="galeria/'.$result["url"].'"'?> alt="" class="itemImg" />
                    <p class="itemNumber"><?php echo '#'.$result["id"]?></p>
                    <h3><?php echo $result["nombre"] ?></h3>
                    
                    <p> <input type="text"  class="qty"  <?php echo 'placeholder="'.$result["cantidad"].'"'?>disabled/> x $<?php echo $result["precio"] ?></p>
                    <?php
                        $disponibleStock =$result["stock"]-$result["cantidad"];
                        if($disponibleStock != 0){
                            echo '<p class="stockStatus"> EN STOCK</p>';
                        }else{

                            echo '<p class="stockStatus out"> AGOTADO</p>';
                        }
                    
                    ?>
                   
                    </div>  
                
                    
                    <div class="prodTotal cartSection">
                    <p>$<?php echo $result["precio"]*$result["cantidad"] ?></p>
                    </div>
                        <div class="cartSection removeWrap">
                        <p class="precioResponsivo">$<?php echo $result["precio"]*$result["cantidad"] ?></p>
                    <div  class="remove" onclick="eliminar(<?php echo $result['id']?>)">x</div>
                    </div>
                </div>
            </li>

            <?php

                }
                 
            ?>
        
        <!--<li class="items even">Item 2</li>-->
    
        </ul>
    </div>
    
   
    
    <div class="subtotal cf" id="subtotal">
        <ul>
                <li class="totalRow final"><span class="label">Total</span><span id="total" class="value">$<?php echo $cantidadTotal?></span></li>
        <li class="totalRow"><a href="#" class="btn continue">Finalizar pedido</a></li>
        </ul>
    </div>
    </div>

    <?php
    } else{
        echo '<h3 class="h3">no hay productos</h3>';
    }      
    ?>
    <h3 id="textproducto">no hay productos</h3>  
    </main>



    <?php
        include 'componentes/footer.php'
    ?>

<script src="assets/js/eventosvanilla.js"></script>
<script>
        let cantidad = document.querySelector("#total");
        let cantidadactual = cantidad.textContent.slice(1);//quitamos la primera letra del span ejemplo si es $1400 solo tenemos 1400.
           function eliminar( id ){

            const data = new FormData();
            data.append('id', id );
            fetch('eliminarproductocarrito.php', {
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
            let cantidadCarrito =document.querySelector("#cart_menu_num");
                if(jsonResp.productoNoDisponible){
                    let contenedorCarrito = document.querySelector("#contenedorCarrito");
                    let textCarritoNoDisponible = document.querySelector("#textproducto");
                    let subtotal = document.querySelector("#subtotal");
                    subtotal.style.animation ="ocultar 1s 1 linear forwards";
                    contenedorCarrito.style.animation ="ocultar 1s 1 linear forwards 1s";
                    textCarritoNoDisponible.style.display ="block";
                    cantidadCarrito.style.display ="none";

                }
                let itemProducto = document.querySelector('[data-id="'+id+'"]');
                itemProducto.style.animation =" ocultar 1s 1 linear forwards";
                cantidadactual = new Number(cantidadactual);
                cantidadactual = cantidadactual - jsonResp.total
                cantidad.textContent =cantidadactual;
                console.log(cantidadactual, jsonResp.total,(cantidadactual - jsonResp.total));
               cantidadCarrito.textContent=cantidadCarrito.textContent - jsonResp.cantidadproductos;
            })
            .catch(function(err) {
            console.log(err);
            });


            
        }
    </script>
    
</body>
</html>