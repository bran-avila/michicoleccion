<?php 
session_start();
 /* include_once 'conexion.php';

function verificarUserExistente($user){
    $verificacion= false;
    $query = connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
    $query->execute(['user' => $user]);
    if($query->rowCount()){
        $verificacion= true;
    }
    return $verificacion;
}

//tenemos que hacer una  consulta sql primero con el correo para obtener el id del usuario para despues obtener toda su informacion como domicilios

*/
if(!isset($_SESSION['user'])){

  header('Location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuenta</title>
</head>
<body>
  <h1>hola desde la cuenta<?php echo $_SESSION['user']."  ".$_SESSION['rolAdmin']."  ".$_SESSION['id']?></h1>
</body>
</html>