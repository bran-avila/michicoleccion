<header>
<?php
   if(isset($_SESSION['carrito'])&& count($_SESSION['carrito'])!=0){
    $cantidadProductos = 0;
    foreach ($_SESSION['carrito'] as $key ) {
      $cantidadProductos= $cantidadProductos + $key["cantidad"];
  }
   }

?>

        <nav class="headerE">
        <span class="menuicon active" id="toggle" onclick="menuToggle()"></span>

            <ul class="nav-categoria">
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li class="submenu container-effect">
                    
                        <div class="dots">
                            <div class="contenedorCategoria">
                                Categorias
                                <img src="assets/images/flechaCategoria.png" alt="">
                            </div>

                            <div class="shadow cut"></div>
                            <div id="menulist" class="containerh cut">
                              <div class="drop cut2"></div>
                            </div>
                            <div class="list">
                              <ul>
                                <li class="hoverc">
                                 <a href="colecciones.php?categoria=heroclix">Heroclix</a>
                                </li>
                                <li>
                                  <a href="colecciones.php?categoria=video+juegos">Videojuegos</a>
                                </li>
                                <li>
                                  <a href="colecciones.php?categoria=digimon">Digimon</a>
                                </li>
                                <li>
                                  <a href="colecciones.php?categoria=comics+y+libros">comics y libros</a>
                                </li>
                                <li>
                                  <a href="colecciones.php?categoria=piezas+unicas">piezas unicas</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="cursor" onclick="menulistactive()"></div>
                    
                </li>
                
            </ul>
            
            <a href="index.php"><img id="logo" src="assets/images/logo2.png" alt=""></a>

            <nav class="nav-iconos">
                <ul>
                    <li>
                        <a href="carrito.php" class="carti"><img src="assets/images/carrito.png" alt="icono">

                          <?php
                          if(isset($cantidadProductos)){
                            echo '<span id="cart_menu_num" data-action="cart-can" class="badge rounded-circle">'.$cantidadProductos.'</span>';
                          }
                           ?>
                        </a>
                    </li>
                    <li><a href="buscador.php"><img src="assets/images/buscar.png" alt="icono"></a></li>
                    <li><a href="login.php"><img src="assets/images/usuario.png" alt="icono"></a></li>
                </ul> 
            </nav>

            <a href="carrito.php" class="imgCarrito carti"><img src="assets/images/carrito.png" alt="icono">
                
                        <?php
                          if(isset($cantidadProductos)){
                            echo '<span id="cart_menu_num" data-action="cart-can" class="badge rounded-circle">'.$cantidadProductos.'</span>';
                          }
                           ?>    
           </a>
        
        </nav>

        <!--encabezado movil-->

        <div class="fullPageMenu active" id="nav">
            <div class="nav">
                <ul>
                    <li><a href="#" data-text="Inicio">Inicio</a></li>
                    <li><a href="#" data-text="Usuario">Usuario</a></li>
                    <li id="categoriaH"  onclick="activar()"><a href="#" data-text="Categoria">categoria</a></li>
                    <div class="nav-submenu1" id="nav-submenu">
                      <ul>
                            <li>heroclix</li>
                            <li>digimon</li>
                            <li>comics</li>
                            <li>videojuegos</li>
                            <li>etc</li>
                      </ul>
                    </div>
                    
                    <li><a href="#" data-text="Carrito">carrito</a></li>
                    <li><a href="#" data-text="Nosotros">nosotros</a></li>
                    <li><a href="#" data-text="Buscador">Buscador</a></li>
                </ul>
            </div>
        </div>
    </header>

    <script>
      let cont = 0;
    function activar() {
          cont++;
          if(cont==1){
            document.getElementById("nav-submenu").style.display = "block";
          }else{
            document.getElementById("nav-submenu").style.display = "none";
            cont=0;
          }
    }
    function menulistactive(){
      function efectomenu() {
        document.querySelector('.dots').classList.toggle('active');
        document.querySelector('.headerE').classList.toggle('zindex');

      }

      setTimeout(efectomenu, 10);
       document.querySelector('.shadow').classList.toggle('mostrar1');        
      document.querySelector('#menulist').classList.toggle('mostrar2');      
      document.querySelector('.list').classList.toggle('mostrar1');

    }
</script>