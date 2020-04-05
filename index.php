<?php require_once 'includes/header.php'; ?>

<?php
require_once 'includes/conexion.php';
$select = "SELECT * FROM `producto` ";
$query = mysqli_query($db, $select);
$imagen = "";
while ($row = mysqli_fetch_array($query)) {
    $imagen = $row['imageName'];
    $nombre = $row['nombre'];
    $desc = $row['descripccion'];
    $idProducto = $row['idProducto'];
    $precio = $row['precio']; ?>

    <div class="container">

    <div class="articulo">

        <div class="imagen">
            <?php echo '<img src="imagenesProductos/' . $imagen . '">'; ?>
        </div>

        <div class="titulo">
            <h3><?php echo $nombre ?></h3>
        </div>

        <div class="precio">
            <p>$<?php echo $precio ?></p>
        </div>

        <div class="precio">
            <p><?php echo $desc ?></p>
        </div>

        <div class="botones"><a href="producto.php?id=<?php echo $idProducto ?>">VER PRODUCTO</a></div>

    </div>

    </div>

<?php }
mysqli_close($db);
?>

</main>

</body>

</html>