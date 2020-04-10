<?php
session_start();
$idProducto = $_GET['id'];

if (empty($_SESSION['carrito_array'])) {
    $_SESSION['carrito_array'] = array();
}


array_push($_SESSION['carrito_array'], $idProducto);
var_dump($_SESSION['carrito_array']);


$costo = 0;
$cantidad = $_GET['cantidad'];

require_once '../includes/conexion.php';
$select = "SELECT `precio` FROM `producto` WHERE idProducto = $idProducto";
$query = mysqli_query($db, $select);

while ($row = mysqli_fetch_array($query)) {
    $costo = $row['precio'] * $cantidad;
}

$sql = "INSERT INTO `detalleorden`(`id_prod`, `cantidad`, `costo`) VALUES ('$idProducto','$cantidad','$costo')";
$qry = mysqli_query($db, $sql);






















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