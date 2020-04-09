<?php require_once 'includes/header.php'; ?>

<h1 style="text-align: center">CARRITO</h1>
<div class="container">
    <?php
    if (!empty($_SESSION['carrito'])) {
        
    require_once 'includes/conexion.php';

    $id = implode(' , ', $_SESSION['carrito']);

    $select = "SELECT * FROM `producto` WHERE idProducto IN ($id) ";

    $query = mysqli_query($db, $select);

    if (!$query) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    while ($row = mysqli_fetch_array($query)) {
        $imagen = $row['imageName'];
        $nombre = $row['nombre'];
        $desc = $row['descripccion'];
        $idProducto = $row['idProducto'];
        $precio = $row['precio']; ?>


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

            <div class="botones"><a href="modelo/borrarProducto.php?id=<?php echo $idProducto ?>">Eliminar</a></div>

        </div>

        <?php } ?>
    <?php } ?>
</div>

</body>

</html>