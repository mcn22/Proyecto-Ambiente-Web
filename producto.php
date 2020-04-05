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

    <main>
        <div class="container">
            <div class="vista-producto respuesta">

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
                    <button id="boton-comprar" value="<?php echo $idProducto ?>">COMPRAR</button>
                </div>
            </div>


        </div>
        </div>

    <?php }
mysqli_close($db);
    ?>

    </main>
    <script src="./controladores/carrito.js"></script>
    <?php require_once 'includes/footer.php'; ?>
    </body>

    </html>