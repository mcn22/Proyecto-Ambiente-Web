<?php require_once 'includes/header.php'; ?>

<h1 style="text-align: center">CARRITO</h1>
<div class="container">

    <?php
    session_start();
    var_dump($_SESSION['carrito_array']);
    $totalFinal = 0;
    var_dump($_SESSION['carrito_array']);

    if (!empty($_SESSION['carrito_array'])) {

        require_once 'includes/conexion.php';

        //SE ESCOJE EL ARRAY DE IDS Y SE DIVIDE
        $ids = $_SESSION['carrito_array'];
        $id = implode(',', $ids);
        //FIN SE ESCOJE EL ARRAY DE IDS Y SE DIVIDE
        
        var_dump($_SESSION['carrito_array']);

        $select = "SELECT idProducto, ID_DETALLE , nombre, descripccion, imageName, cantidad, costo FROM producto, detalleorden WHERE producto.idProducto IN ($id)";

        $query = mysqli_query($db, $select);

        if (!$query) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        while ($row = mysqli_fetch_array($query)) {
            $ID_DETALLE = $row['ID_DETALLE'];
            $imagen = $row['imageName'];
            $nombre = $row['nombre'];
            $desc = $row['descripccion'];
            $idProducto = $row['idProducto'];
            $precio = $row['costo'];
            $totalFinal += $precio;
            $cantidad = $row['cantidad'];
    ?>


            <div class="articulo">

                <div class="imagen">
                    <?php echo '<img src="imagenesProductos/' . $imagen . '">'; ?>
                </div>

                <div class="titulo">
                    <h3><?php echo $nombre ?></h3>
                </div>

                <div class="precio">
                    <p>PRECIO: $<?php echo $precio ?></p>
                </div>

                <div class="precio">
                    <p>CANTIDAD: <?php echo $cantidad ?></p>
                </div>

                <div class="precio">
                    <p><?php echo $desc ?></p>
                </div>

                <div class="botones"><a href="modelo/borrarProducto.php?id=<?php echo $ID_DETALLE ?>&idProd=<?php echo $idProducto ?>">Eliminar</a></div>

            </div>

        <?php } ?>

       <h1>Total a pagar: $<?php echo $totalFinal ?></h1>

    <?php } ?>
    <?php if (empty($_SESSION['carrito_array'])) { ?>
        <div class="centered">
            <h1 id="h1Centered">Carrito vacio!</h1>
            <div class="botones">
                <a id="linkCentered" href="index.php">Click para Comprar!</a>
            </div>
        <?php } ?>
        </div>