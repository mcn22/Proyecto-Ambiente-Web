
<?php
session_start();
$idProducto = $_GET['id'];
if (empty($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}
array_push($_SESSION['carrito'], $idProducto);
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
<h1 id="h1Centered">Producto agregado a carrito!</h1>
<div class="botones">
<a id="linkCentered" href="http://localhost/Proyecto-Ambiente-Web/carrito.php">Ver Carrito</a>
</div>
</body>
</html>