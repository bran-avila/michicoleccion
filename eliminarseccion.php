<?php
session_start();
session_unset();
session_destroy();

header('Location: login.php');

?>

<h1>
    eliminado la seccion
</h1>