<?php require_once 'includes/header.php'; ?>


<div class="container">
    <?php

    $id = $_GET['id'];
    require_once 'includes/conexion.php';
    $select = "SELECT * FROM `producto` WHERE idProducto=$id";
    $query = mysqli_query($db, $select);

    while ($row = mysqli_fetch_array($query)) {
        $imagen = $row['imageName'];
        $nombre = $row['nombre'];
        $desc = $row['descripccion'];
        $idProducto = $row['idProducto'];
        $precio = $row['precio'];
        $cant = $row['cantVenta'] ?>



        <div class="vista-producto">
            <div class="vista-img-producto">
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

            <br>
            <?php if (isset($_SESSION['usuario'])) : ?>
                <form action="modelo/agregar_carrito.php" method="get">

                    <input type="number" name="cantidad" placeholder="CANTIDAD" 
                    min="1" max="<?php echo $cant ?>" required="true" value="1">

                    <button class="botones-vista" type="submit" name="id" value="<?php echo $idProducto ?>">COMPRAR</button>
                </form>
            <?php endif; ?>

            <?php if (!isset($_SESSION['usuario'])) : ?>
                <div class="botones-vista">
                    <a id="boton-compra" href="index.php">DEBE LOGEARSE ANTES DE COMPRAR!</a>
                </div>
            <?php endif; ?>
        </div>


    <?php } ?>


</div>
</body>

</html>