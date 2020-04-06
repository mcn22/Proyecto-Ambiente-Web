<?php require_once 'includes/header.php'; ?>

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
    $precio = $row['precio']; ?>

    <main>
        <div class="container">
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
                <div class="botones-vista">
                    <a id="boton-compra" href="carrito.php?id=<?php echo $idProducto?>">COMPRAR</a>
                </div>
            </div>


        </div>
        </div>

    <?php }
mysqli_close($db);
    ?>

    </main>
    <?php require_once 'includes/footer.php'; ?>
    </body>

    </html>