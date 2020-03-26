<?php require_once 'includes/header.php'; ?>

<?php
//if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    require_once 'includes/conexion.php'; 
    $select = "SELECT * FROM `producto` WHERE idProducto=$id";
    $query = mysqli_query($db, $select);
    $imagen = "";
    while ($row = mysqli_fetch_array($query)) {
        $imagen = $row['imageName'];
        $nombre = $row['nombre'];
        $desc = $row['descripccion'];
        $idProducto = $row['idProducto'];
        $precio = $row['precio']; ?>

        <main class="container">
    <div class="vista-producto">
        <div class="vista-img-producto">
            <?php echo '<img src="imagenesProductos/'.$imagen.'">';?>
        </div>
        <div class="contenido-producto">
            <h1><?php echo $nombre ?></h1>
            <h3><?php echo $desc ?></h3>
            <h3>$ <?php echo $precio ?></h3>
            <a id="boton-comprar" href="producto.php?id=<?php echo $idProducto ?>">Comprar</a>
        </div>
    </div>


    <?php }
    mysqli_close($db);
    ?>

</main>
<?php require_once 'includes/footer.php'; ?>
</body>

</html>