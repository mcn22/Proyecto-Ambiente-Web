<?php require_once 'includes/header.php'; ?>

<section class="container">
    <h2 id="h2-nosotros">Sobre Nosotros</h2>

    <div class="informacion-nosotros">
        <div class="icono">
            <img src="../Proyecto-Ambiente-Web/assets/img/bh.jpg" alt="ICONO SEGURIDAD">
        </div>
        <h3>Seguridad</h3>
        <p>Sed posuere vulputate lectus, sit amet volutpat sem ultrices vitae. Nullam et ex at lorem pretium mattis. Cras hendrerit elit eu tempor cursus. Aenean id ultricies massa. Phasellus rhoncus nulla malesuada rutrum tincidunt. Sed scelerisque ultricies semper. Proin.</p>
    </div>

    <div class="informacion-nosotros">
        <div class="icono">
            <img src="../Proyecto-Ambiente-Web/assets/img/bh.jpg" alt="ICONO TIEMPO">
        </div>
        <h3>Entregas a Tiempo</h3>
        <p>Sed posuere vulputate lectus, sit amet volutpat sem ultrices vitae. Nullam et ex at lorem pretium mattis. Cras hendrerit elit eu tempor cursus. Aenean id ultricies massa. Phasellus rhoncus nulla malesuada rutrum tincidunt. Sed scelerisque ultricies semper. Proin.</p>
    </div>

    <div class="informacion-nosotros">
        <div class="icono">
            <img src="../Proyecto-Ambiente-Web/assets/img/bh.jpg" alt="ICONO MEJOR PRECIO">
        </div>
        <h3>Los Mejores Precios</h3>
        <p>Sed posuere vulputate lectus, sit amet volutpat sem ultrices vitae. Nullam et ex at lorem pretium mattis. Cras hendrerit elit eu tempor cursus. Aenean id ultricies massa. Phasellus rhoncus nulla malesuada rutrum tincidunt. Sed scelerisque ultricies semper. Proin.</p>
    </div>
</section>

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

        <main class="container">
    <div class="producto">
        <div class="img-producto">
            <?php echo '<img src="imagenesProductos/'.$imagen.'">';?>
        </div>
        <div class="contenido-producto">
            <h3><?php echo $nombre ?></h3>
            <p><?php echo $desc ?></p>
            <p>$ <?php echo $precio ?></p>
            <a href="producto.php?id=<?php echo $idProducto ?>">VER PRODUCTO</a>
        </div>
    </div>

   <?php }
    mysqli_close($db);
    ?>

</main>
<?php require_once 'includes/footer.php'; ?>
</body>

</html>