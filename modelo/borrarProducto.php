<?php
session_start();
$array = $_SESSION['carrito'];
$idProducto = $_GET['id'];

if (($key = array_search($idProducto, $_SESSION['carrito'])) !== false) {
    unset($_SESSION['carrito'][$key]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <title>Procesando...</title>
</head>
<body>
<div class="centered">
<h1 id="h1Centered">Producto borrado del carrito!</h1>
<div class="botones">
<a id="linkCentered" href="http://localhost/Proyecto-Ambiente-Web/carrito.php">Volver Carrito</a>
</div>
</body>
</html>