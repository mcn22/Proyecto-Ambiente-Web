<?php
require_once 'includes/conexion.php';

if(isset($_SESSION['usuario'])){
    session_unset();
    session_destroy();
}

header('Location: index.php');

?>