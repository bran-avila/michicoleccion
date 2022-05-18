<?php
  session_start();

  include_once 'php/conexion.php';

  if(isset($_SESSION['user'])){
      
    if(isset($_SESSION['rolAdmin']) && $_SESSION['rolAdmin'] == true){
        header('Location: admin.php');
      }else{
        header('Location: cuenta.php');
      }

  }else if(isset($_POST['correo']) && isset($_POST['contrasenia']) && isset($_POST['ingresar'])){//manda un post ala misma pagina y verifica que existe las variables que mandamos
    
    $userForm = $_POST['correo'];
    $passForm = $_POST['contrasenia'];

    $md5pass = md5($passForm);
    $query = connect()->prepare('SELECT * FROM usuarios WHERE correo = :correo AND contrasenia = :pass');
    $query->execute(['correo' => $userForm , 'pass' => $md5pass]);
    $userExiste= false;
    if($query->rowCount()){
        $userExiste= true;
    }else{
        $userExiste= false;
    }

    if($userExiste){//si existe un usuario entra en el if
        //echo "Existe el usuario";
        //aqui tengo que llenar las variables de seccion que es correo,nombre y rol
        /*tengo igual traer la consulta si es administrador*/
        $id = obtenerID($_POST['correo']);
        $_SESSION['user'] = $_POST['correo'];
        $_SESSION['rolAdmin'] = permisoAdmin($id);
        $_SESSION['id'] =  $id ;

        if(isset($_SESSION['rolAdmin']) && $_SESSION['rolAdmin'] == true){
          header('Location: admin.php');
        }else{
          header('Location: cuenta.php');
        }

      
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
    }
}else if(isset($_POST['btnregistrar'])){

 $registroFinalizado = registrarUsuario($_POST['correoRegistro'],$_POST['nombre'],$_POST['apellidos'],$_POST['contraseniaRegistro']);
  if($registroFinalizado){
    //aqui podemos cuando el usuario se registro correctamente
    //tenemos que guardar las variables de seccion si el usuario se registro correcto para mandarlo a la pagina de cuenta y mostrar su informacion
    $id = obtenerID($_POST['correoRegistro']);
    $registroRol = insertarRol( $id );
    /*
      aqui guardar las variables de seccion como correo,nombre,id y rol
    */
    $_SESSION['user'] = $_POST['correoRegistro'];
    $_SESSION['rolAdmin'] = false;
    $_SESSION['id'] =  $id ;

    header('Location:cuenta.php');
  }else{
    //poder si fallo el registro


  }

}

function registrarUsuario($correo,$nombre,$apellidos,$contrasenia){

  $md5pass = md5($contrasenia);

  $sql="insert into usuarios(nombre,apellidos,correo,contrasenia) values(:nombre,:apellidos,:correo,:contrasenia)";
  $sql= connect()->prepare($sql);
  $sql->bindParam(':nombre',$nombre);
  $sql->bindParam(':apellidos',$apellidos);
  $sql->bindParam(':correo',$correo);
  $sql->bindParam(':contrasenia',$md5pass);



 if( $sql->execute()){
      return true;
 }else{
      return  false;
 }

}
function obtenerID($correo){
  $sql = "SELECT id,nombre FROM usuarios where correo=:correo"; //preparamos la consulta sql
  $query = connect() -> prepare($sql); //ejecutamos prepara la consulta para pasarle la variable correo
  $query->bindParam(':correo',$correo);//aqui llenamos los datos que obtenemos del post o get
  $query -> execute(); //ejecutamos la setencia sql
  $results = $query -> fetchAll(PDO::FETCH_OBJ); //fetchAll retorna un arreglo con todos las filas y PDO::FETCH_OBJ sirve para que regrese cada variable del arreglo como un objecto con el nombre de las columnas
  $id= false;
  if($query -> rowCount() > 0)   { // el metodo rowcount nos ayuda para saber si existe registros en la consulta que hicimos
    foreach($results as $result) { 
      echo "<tr>
      <td>".$result -> id."</td>
      <td>".$result -> nombre."</td>
      </tr>";
      $id=$result -> id;
    }
  }
  return $id;
}
function insertarRol($id){

  $sql="insert into roles_usuarios(idroles,idusuarios) values(1,:id)";
  $sql= connect()->prepare($sql);
  $sql->bindParam(':id',$id);
 if( $sql->execute()){
      return true;
 }else{
      return  false;
 }


}

function permisoAdmin($id){
  $query = connect()->prepare('SELECT * FROM roles_usuarios WHERE idusuarios = :id AND idroles = 2');
    $query->execute(['id' => $id]);
    $admin= false;
    if($query->rowCount()){
       return $admin= true;
    }else{
      return $admin= false;
    }

}

?>

<!DOCTYPE html>
<html>
<head>
<title> LOGIN </title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="assets/css/estilos.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/footer.css">
<link rel="stylesheet" href="assets/css/estilosLogin.css">
</head>
<body>
  <?php
        include 'componentes/header.php'
    ?>


<div class="bg">
<div class="cardL" id="cardL">
<div class="inner-box" id="card">

<div class="card-front">
   	<h2>BIENVENIDO</h2>
     <?php 
        if(isset($errorLogin)){
          
          echo '<div class="alert alert-info" id="hideMe" role="alert">
            '.$errorLogin.'
          </div>';
        }
      ?>
   	<form action="" method="POST">
		<label for="email">Correo eletronico</label>
   	     <input type="email" class="input-box" placeholder="Correo electronico" required autocomplate="off" name="correo">
		<label for="password">Contraseña</label>
   	     <input type="password" class="input-box" placeholder="Contraseña" required autocomplate="on" name="contrasenia">
   	     <button type="submit" class="submit-btn" name="ingresar">Ingresar</button>
   	</form>	
   	<a class="btnLogin" onclick="openRegister()">Registrarme</a>
</div>
<div class="card-back">
	<h2>REGISTRARSE</h2>
   	<form action="" method="POST">
      <label for="nombre">Nombre</label>
        <input type="text" class="input-box" placeholder="Nombre" required name="nombre">
      <label for="apellidos">Apellidos</label>
        <input type="text" class="input-box" placeholder="Nombre" required name="apellidos">
      <label for="emailRegistro">Correo Electronico</label>
          <input type="email" class="input-box" placeholder="Correo electronico" required name="correoRegistro">
          <label for="contraseniaRegistro">contraseña</label>
      <input type="password" class="input-box" placeholder="Contraseña" required name="contraseniaRegistro">
          <button type="submit" class="submit-btn"  name="btnregistrar">Registar</button>
          
   	</form>	
   	<a  class="btnLogin" onclick="openLogin()">Tengo una cuenta</a>
   	
</div>
        </div>
      </div> 
    </div>     
    <script text="text/javascript">

        var card=document.getElementById("card"); 
		var cardPadre=document.getElementById("cardL");
		        
        function openRegister()
            {
            card.style.transform = "rotateY(-180deg)";
            }	
        function openLogin()
            {
                card.style.transform = "rotateY(0deg)";	
            }	

    </script> 
      <?php
            include 'componentes/footer.php'
         ?>
         <script src="assets/js/eventosvanilla.js"></script>
</body>
</html>
