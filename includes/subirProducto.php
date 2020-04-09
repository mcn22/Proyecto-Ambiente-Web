<!-- 1	idProducto	int 11 AUTO_INCREMENT	

	2	nombre	varchar 255 		

	3	descripccion	varchar 255		

	4	precio	decimal 10,0			

	5	imageName	blob -->

<?php
require_once 'conexion.php';

if (isset($_POST['submit'])) {
    $nombre = strtolower($_POST['nombre']);
    $desc = $_POST['descripccion'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];
    $cantidad = $_POST['cantVenta'];
    $imagenTMP = $_FILES['imagen']['tmp_name'];

    $folder = "../imagenesProductos/";
    move_uploaded_file($imagenTMP, $folder . $imagen);

    $sql = "INSERT INTO `producto`(`nombre`, `descripccion`, `precio`, `imageName`,`cantVenta`) VALUES ('$nombre','$desc','$precio','$imagen',$cantidad)";
    $qry = mysqli_query($db, $sql);

    if ($qry) {
        echo "<h1>Datos subidos!</h1>";
    } elseif (!$qry) {
        echo "<h1>ERROR SUBIENDO DATOS!</h1>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Producto</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" id="nombre" placeholder="nombre">
        <br>
        <input type="text" name="descripccion" id="descripccion" placeholder="descripccion">
        <br>
        <input type="number" name="precio" id="precio" placeholder="precio">
        <br>
        <input type="number" name="cantVenta" id="cantVenta" placeholder="cantidad">
        <br>
        <input type="file" name="imagen" id="imagen" placeholder="imagen">
        <br>
        <input type="submit" value="submit" name="submit" id="submit">
    </form>

</body>

</html>