<?php
  session_start();

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
</head>
<body>
<nav class="nav">
   <a href="#first"><i class="far fa-user">a</i></a>
   <a href="#second"><i class="fas fa-briefcase">b</i></a>
   <a href="#third"><i class="far fa-file">c</i></a>
   <a href="#fourth"><i class="far fa-address-card">d</i></a>
 </nav>
  
<div class= 'containerA'> 
  <section id= 'first' class="section">
    <h1>First</h1>
  </section>
  
  <section id= 'second' class="section">
    <h1>Second</h1>
  </section>
  
 <section id= 'third' class="section">
   <h1>Third</h1>
  </section>
  
 <section id= 'fourth' class="section">
   <h1>Fourth</h1>
  </section>
</div>
</body>
</html>