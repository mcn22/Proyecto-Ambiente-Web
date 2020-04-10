<?php
//BORRAR DEL ARRAY DE IDS EL ID DEL PRODUCTO QUE SE SELECCIONO
session_start();
$idDetalle = $_GET['id'];
echo $idDetalle;
$idProd = $_GET['idProd'];
$carritoIDS = $_SESSION['carrito_array'];

// foreach (array_keys($carritoIDS, $idProd) as $key) {
//     unset($carritoIDS[$key]);
// }

if (($key = array_search($idProd, $_SESSION['carrito_array'])) !== false) {
    unset($_SESSION['carrito_array'][$key]);
}

var_dump($carritoIDS);
//FIN BORRAR DEL ARRAY DE IDS EL ID DEL PRODUCTO QUE SE SELECCIONO

require_once '../includes/conexion.php';
$select = "DELETE FROM detalleorden WHERE ID_DETALLE = $idDetalle";
$query = mysqli_query($db, $select);

if (!$query) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
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