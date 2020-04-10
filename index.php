<?php require_once 'includes/header.php'; ?>


<div class="busqueda">
    <input type="text" id="nombre" placeholder="Buscar Articulo">
    <input type="submit" id="boton-buscar" value="BUSCAR">
</div>


<div class="container" id="respuesta">
    <?php
    require_once 'includes/conexion.php';
    $select = "SELECT * FROM `producto` ";
    $query = mysqli_query($db, $select);

    while ($row = mysqli_fetch_array($query)) {
        $imagen = $row['imageName'];
        $nombre = $row['nombre'];
        $desc = $row['descripccion'];
        //$idProducto = $row['idProducto']; esta dando problemas
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

            <div class="botones"><a href="producto.php?id=<?php echo $idProducto ?>">VER PRODUCTO</a></div>

        </div>

    <?php } ?>
</div>

<script src="./controladores/buscar.js"></script>
</body>

</html>